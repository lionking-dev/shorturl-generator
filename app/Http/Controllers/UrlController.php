<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoogleSafeBrowsingService;
use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class UrlController extends Controller
{
   // app/Http/Controllers/UrlController.php
    protected $googleSafeBrowsingService;

    public function __construct(GoogleSafeBrowsingService $googleSafeBrowsingService)
    {
        $this->googleSafeBrowsingService = $googleSafeBrowsingService;
    }
    public function checkUrl(Request $request)
    {
        $url = $request->input('originalUrl');

        // Perform Google Safe Browsing check
        $result = $this->googleSafeBrowsingService->checkUrl($url);
        // Handle the result as needed
        return response()->json($result);
        /* $isSafe = true;

        return response()->json(['isSafe' => $isSafe]); */
    }
    public function submit(Request $request) {
        $originalUrl = $request->input('originalUrl');
        $request->validate([
            'originalUrl' => 'required|string|max:255',
        ]);
        $data = $request->all();
        $data['originalUrl'] = $originalUrl;
        $url = explode("/", $originalUrl);
        $data['shortenedUrl'] = $url[0].'//'.$url[2].'/'.(Str::random(6));
        $existingUrl = Url::where('shortenedUrl', $data['shortenedUrl'])->first();

        if ($existingUrl) {
            return $existingUrl;
        }
        $createdUrl = Url::create($data);
        $responseData = array_merge($data, ['id' => $createdUrl->id]);
        return $responseData;
    }
    public function redirectToOriginalUrl($id){
        $result = Url::find($id);
        echo $result;
        if ($result) {
            // Redirect to the original URL
            return Redirect::away($result->originalUrl);
        } else {
            // Handle not found (you can return a 404 view or perform another action)
            abort(404, 'URL not found');
        }
    }
}
