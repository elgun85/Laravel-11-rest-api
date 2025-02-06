<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;




class ApiControlller extends Controller
{
    public function index()
    {







        return    view('test'
            //,compact('photoData')
        );
    }

    public function apiWeather()
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
        return    view('apiWeather',compact('weatherData','cityName'));
    }


    public function apiPost()
    {

        return    view('apiPost');
    }

    public function apiCat()
    {
        $photoApiKey='live_7IkL7jN3Yu8mhqg2356IRQHzwlIbWFKbqyojncZftBtIpxyHHwfCnutVUvm8HQI0';
        $photoUrl="https://api.thecatapi.com/v1/images/search?limit=10";

        $photoData = Http::get($photoUrl)->json();
        return    view('apiCat'
            ,compact('photoData')
        );
    }
}
