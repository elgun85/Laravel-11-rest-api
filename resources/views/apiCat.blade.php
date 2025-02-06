@extends('leyouts.master')
@section('title','Api Cat Page')
@section('content')


    <div class="container-fluid">
        <div class="card">
            <div class="col-12">
                <div class="card-body">
                    <div class="row">
                        @foreach($photoData as $photo)
                            <div class="col-md-auto mt-3">
                                <img src="{{$photo['url']}}" class="rounded mx-auto d-block" alt="..." width="250px" height="250px">
                            </div>
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
