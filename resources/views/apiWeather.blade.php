@extends('leyouts.master')
@section('title','Api Weather Page')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="col-3">
                <div class="card-body">
                    <div class="text-center">
                        <img src="..." class="rounded" alt="...">
                    </div>
                    <div class="card text-white" >
                        <div class="bg-image" >
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-weather/draw1.webp"
                                 class="card-img  rounded mx-auto d-block" alt="weather"/>
{{--
                            <div class="mask" style="background-color: rgba(190, 216, 232, .5);"></div>
--}}
                        </div>
                        <div class="card-img-overlay text-dark p-5">
                            @foreach($weatherData as $dataWeather)
                                <h4 class="mb-0">{{ $cityName }}</h4>
                                <p class="display-2 my-3">{{ $dataWeather['Temperature']['Metric']['Value'] }}°C</p>
                                <p class="mb-2">Feels Like: <strong>{{ $dataWeather['Temperature']['Metric']['Value'] }}
                                        °C</strong></p>
                                <h5>{{ $dataWeather['WeatherText'] }}</h5>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
