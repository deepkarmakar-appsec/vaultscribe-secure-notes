<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function generate(Request $request)
    {
        // 1. Validation
        $request->validate([
            'description' => 'required|string|max:2000'
        ]);
    
        // 2. OpenRouter API Key (Ensure this is in your .env)
        $apiKey = config('services.openrouter.key');
        
        if (empty($apiKey)) {
            return response()->json(['result' => 'Error: OpenRouter API Key is missing.'], 500);
        }
        
        // 3. OpenRouter Endpoint
        $url = "https://openrouter.ai/api/v1/chat/completions";
    
        try {
            // 4. Request to OpenRouter
           // AiController.php mein update karein
$response = Http::withHeaders([
    'Authorization' => 'Bearer ' . $apiKey,
    'HTTP-Referer'  => config('app.url'), // Hardcoded URL ke bajaye .env se lein
    'X-Title'       => 'VaultScribe',
])
->retry(3, 100) // 3 baar retry karega, 100ms ke gap par
->timeout(60)   // Timeout thoda badha dein
->post($url, [
    'model' => 'openai/gpt-oss-120b:free', // Free models kabhi-kabhi busy hote hain
    'messages' => [
        ['role' => 'user', 'content' => "Title and Summary for: {$request->description}"]
    ],
]);
        
            if ($response->failed()) {
                Log::error('OpenRouter API Failed: ' . $response->body());
                return response()->json([
                    'result' => 'Error API', 
                    'details' => $response->json() ?? $response->body()
                ], $response->status());
            }
        
            // 5. OpenRouter Response Path (OpenAI compatible)
            $aiResponse = $response->json('choices.0.message.content');
        
            return response()->json(['result' => $aiResponse]);

        } catch (\Exception $e) {
            return response()->json([
                'result' => 'Exception Caught: ' . $e->getMessage()
            ], 500);
        }
    }
}