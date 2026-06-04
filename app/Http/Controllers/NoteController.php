<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class NoteController extends Controller
{
//    notes show

    public function dashboard()
    {
        $notes = Auth::user()->notes()->latest()->get();
        return view('dashboard', compact('notes'));
    }
    
    // notes store

    public function dashboardValue(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        
        // activity logs record
         ActivityLog::create([
    'user_id' => Auth::id(),
    'action' => 'note_create',
    'ip_address' => $request->ip(),
    'user_agent' => $request->userAgent(),

    ]);

        return redirect()->back()->with('success', 'Note saved successfully');
    }
  
    // note edit page
    public function notesedit(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        return view('notes.edit', compact('note'));
    }
  
    // note update
    public function notesupdate(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();

    ActivityLog::create([
    'user_id' => Auth::id(),
    'action' => 'note_update',
    'ip_address' => $request->ip(),
    'user_agent' => $request->userAgent(),

    ]);

        return redirect()->route('dashboard')
            ->with('success', 'Note updated successfully');
    }

//   note delete
    public function notesdelete(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }
        $note->delete();
        
        ActivityLog::create([
        'user_id'=>Auth::id(),
        'action'=>'note_delete',
        'ip_address'=>$request->ip(),
        'user_agent'=>$request->userAgent(),
    ]);

        return redirect()->route('dashboard')
            ->with('success', 'Note delete successfully');
    }



    // trash page
    public function showtrash()
    {
          $notes =Note::where('user_id',auth()->id())->onlyTrashed()->latest()->get();
        return view('notes.trash',compact('notes'));
    }
    
    // restore note
    public function restore($id)
    {
        $note = Note::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);
        $note->restore();
        return redirect()->route('notes.trash');

    }
    
    // delete note
    public function forcedelete($id)
    {
        $note = Note::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);
        $note->forceDelete();
        return redirect()->route('notes.trash');

    }

// restore all
public function restoreAll()
{
    $restored = Note::onlyTrashed()
        ->where('user_id', auth()->id())
        ->count();

    Note::onlyTrashed()
        ->where('user_id', auth()->id())
        ->restore();

    return redirect()
        ->route('notes.trash')
        ->with('success', "$restored notes restored successfully.");
}
    
    // delete all
    
     public function forcedeleteall()
    {
        $deleted = Note::onlyTrashed()->where('user_id',auth()->id())->count();
        Note::onlyTrashed()->where('user_id',auth()->id())->forceDelete();
        return redirect()
        ->route('notes.trash')
        ->with('success', "$deleted notes permanently deleted.");

    }



// Import URL (SSRF Protected)
public function importUrl(Request $request)
{
    $request->validate([
        'url' => 'required|url|max:2048'
    ]);

    $url = $request->url;

    /*
    |--------------------------------------------------------------------------
    | 1. SSRF Protection: Scheme & Host Validation
    |--------------------------------------------------------------------------
    */
    $parsedUrl = parse_url($url);
    $scheme = $parsedUrl['scheme'] ?? '';
    $host = $parsedUrl['host'] ?? '';

    if (!in_array($scheme, ['http', 'https'])) {
        return response()->json(['error' => 'Invalid protocol. Only HTTP/HTTPS allowed.'], 403);
    }

    /*
    |--------------------------------------------------------------------------
    | 2. SSRF Protection: IP Resolution & Blocklist Check
    |--------------------------------------------------------------------------
    */
    $ip = gethostbyname($host);
    
    // Agar DNS resolve nahi hua, toh IP wahi domain string hogi
    if ($ip === $host && !filter_var($host, FILTER_VALIDATE_IP)) {
        return response()->json(['error' => 'Could not resolve domain.'], 400);
    }

    // NO_PRIV_RANGE blocks 192.168.x.x, 10.x.x.x, 172.16.x.x
    // NO_RES_RANGE blocks 127.0.0.1, 169.254.169.254 (Cloud metadata)
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'ssrf_attempt_blocked',
            'ip_address' => $request->ip(),
            'user_agent' => $url, // Storing malicious URL in agent column for logs
        ]);
        return response()->json(['error' => 'Security Error: Access to internal/reserved IPs is blocked.'], 403);
    }

   /*
    |--------------------------------------------------------------------------
    | 3. SSRF Protection: Fetch Data Safely (User-Agent Added)
    |--------------------------------------------------------------------------
    */
    try {
        // Yahan 'User-Agent' add kiya gaya hai taaki Wikipedia block na kare
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        ])->timeout(5)->withOptions([
            'allow_redirects' => ['max' => 2, 'strict' => true] // Safe redirects allow kiye hain
        ])->get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch content from the URL. Server returned: ' . $response->status()], 400);
        }
        $html = $response->body();

        /*
        |--------------------------------------------------------------------------
        | Extract Title
        |--------------------------------------------------------------------------
        */
        preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html, $titleMatches);
        
        $title = html_entity_decode(
            trim($titleMatches[1] ?? 'Imported Note')
        );
        
        /*
        |--------------------------------------------------------------------------
        | Smart Content Extraction
        |--------------------------------------------------------------------------
        */
        libxml_use_internal_errors(true);
        
        $dom = new \DOMDocument();
        
        $dom->loadHTML($html);
        
        libxml_clear_errors();
        
        $xpath = new \DOMXPath($dom);
        
        $content = '';
        
        $selectors = [
        
            // Wikipedia
            '//*[@id="mw-content-text"]',
            '//*[contains(@class,"mw-parser-output")]',
        
            // Generic article sites
            '//article',
            '//main',
        
            // Blog content
            '//*[contains(@class,"content")]',
            '//*[contains(@class,"article")]',
            '//*[contains(@class,"post")]',
            '//*[contains(@class,"entry")]'
        
        ];
        
        foreach ($selectors as $selector) {
        
            $nodes = $xpath->query($selector);
        
            if ($nodes && $nodes->length > 0) {
        
                foreach ($nodes as $node) {
        
                    $text = trim($node->textContent);
        
                    if (strlen($text) > 500) {
        
                        $content = $text;
        
                        break 2;
                    }
                }
            }
        }
        
        /*
        |--------------------------------------------------------------------------
        | Fallback
        |--------------------------------------------------------------------------
        */
        if (empty($content)) {
        
            $body = $dom->getElementsByTagName('body')->item(0);
        
            if ($body) {
                $content = $body->textContent;
            }
        }
        
        /*
        |--------------------------------------------------------------------------
        | Cleanup
        |--------------------------------------------------------------------------
        */
        $content = html_entity_decode($content);
        
        $content = preg_replace('/Toggle the table of contents/i', '', $content);
        
        $content = preg_replace('/Edit links/i', '', $content);
        
        $content = preg_replace('/Appearance move to sidebar hide/i', '', $content);
        
        $content = preg_replace('/Navigation menu/i', '', $content);
        
        $content = preg_replace('/Main menu/i', '', $content);
        
        $content = preg_replace('/Donate/i', '', $content);
        
        $content = preg_replace('/Create account/i', '', $content);
        
        $content = preg_replace('/Log in/i', '', $content);
        
        $content = preg_replace('/\s+/', ' ', $content);
        
        $content = trim($content);
        
        $content = substr($content, 0, 2500);

        $apiKey = env('GEMINI_API_KEY');

if (!empty($apiKey)) {

    try {

        $aiResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent',
            [
                'contents' => [[
                    'parts' => [[
                        'text' => "
Extract only the main article.

Remove:
- CSS
- JavaScript
- Menus
- Navigation
- Login buttons
- Sidebars
- Footer

Create a clean note under 500 words.

$content
"
                    ]]
                ]]
            ]
        );

        $cleanContent = $aiResponse->json('candidates.0.content.parts.0.text');

        if (!empty($cleanContent)) {
            $content = $cleanContent;
        }

    } catch (\Exception $e) {
        // fallback to original content
    }
}
        
        return response()->json([
            'title' => $title,
            'content' => $content
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while connecting to the URL. ' . $e->getMessage()], 500);
    }



}
}
