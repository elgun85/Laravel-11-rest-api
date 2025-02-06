@extends('leyouts.master')
@section('title', 'Api User Page')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <p>Api User Page</p>


                <form action="{{ route('createuser') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group  mx-sm-3 mb-2 ">
                        <label for="name" class="sr-only mb-2">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="email" class="sr-only mb-2">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="password" class="sr-only mb-2">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group  mx-sm-3 mb-2">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </form>


                <div class="mx-sm-3 mb-2">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark ">
                            <tr class="table-secondary">
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($user as $userItem)
                                <tr>
                                    <th scope="row">{{ $userItem->id }}</th>
                                    <td>{{ $userItem->name }}</td>
                                    <td>{{ $userItem->email }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>





        </div>
    @endsection
