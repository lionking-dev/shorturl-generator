<?php
// app/Services/GoogleSafeBrowsingService.php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleSafeBrowsingService
{
    protected $apiUrl = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=AIzaSyDcGt4NSzZcB9sQ8tb80Ddhm6WFvp7HoYM';

    public function checkUrl($url)
    {
        $client = new Client();

        $response = $client->post($this->apiUrl, [
            'json' => [
                'client' => [
                    'clientId' => 'blackstar-safebrowsing',
                    'clientVersion' => '1.5.2',
                ],
                'threatInfo' => [
                    'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                    'platformTypes' => ['ANY_PLATFORM'],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [
                        ['url' => $url],
                    ],
                ],
            ],
        ]);
        return json_decode($response->getBody(), true);
    }
}
