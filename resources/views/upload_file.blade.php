@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-4">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if(count($errors))
                    <div class="col-12">
                        <ul class="alert alert-danger ">
                            @foreach($errors->all() as $error)
                                <li class="ml-4">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('word-to-pdf') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3>Please Upload Word File</h3><br>

                        <div class="input-group-prepend">
                            <input type="file" name="file">
                        </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Upload">
                </form>
                    <br>

                    @if (session('fileName'))
                        <a href="{{ asset('word/'.session('fileName').'.pdf') }}" class="btn btn-success" download>
                          Download
                        </a>
                    @endif
            </div>
        </div>
    </div>
@endsection
