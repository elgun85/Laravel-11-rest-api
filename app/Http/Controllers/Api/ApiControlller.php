<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ApiControlller extends Controller
{
    public function index()
    {


        $apiKey = 'vfkoetrHuDzfRBIK9OsnWWXYPGA3dKkj';
        $locationKey = '27103'; // Bakı üçün Location Key
        $locationUrl = "http://dataservice.accuweather.com/locations/v1/{$locationKey}?apikey={$apiKey}";

        $response = Http::get($locationUrl);
        $locationData = $response->json();
        $cityName = $locationData['LocalizedName'];

        $weatherUrl = "http://dataservice.accuweather.com/currentconditions/v1/{$locationKey}?apikey={$apiKey}";

        $weatherData = Cache::remember('weatherData', 60, function () use ($weatherUrl) {
            return Http::get($weatherUrl)->json();
        });


        return    view('test',compact('weatherData','cityName'));
    }
}
