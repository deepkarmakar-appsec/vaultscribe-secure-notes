<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function generate(Request $request)
    {
        // ... (validation और apiKey check)
    
        $apiKey = env('GEMINI_API_KEY');
        
        // अपनी वर्किंग curl कमांड वाला URL यहाँ डालें
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}";
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => "You are a helpful assistant. Title and Summary for: {$request->description}"]
                    ]
                ]
            ]
        ]);
    
        if ($response->failed()) {
            return response()->json(['result' => 'Error: ' . $response->body()], 500);
        }
    
        $aiResponse = $response->json('candidates.0.content.parts.0.text');
    
        return response()->json(['result' => $aiResponse]);
    }
}