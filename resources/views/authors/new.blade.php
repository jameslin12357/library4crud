@extends('layouts.app')

@section('content')

    <div class="container pt-100">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <h3 class="login-heading mb-4 text-center">Create author</h3>
                <form action="/authors" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name" value="{{ old('fname') }}" name="fname" required>
                    </div>
                    @if ($errors->has('fname'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name" value="{{ old('lname') }}" name="lname" required>
                    </div>
                    @if ($errors->has('lname'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Age" value="{{ old('age') }}" name="age" required>
                    </div>
                    @if ($errors->has('age'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                    @endif


                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

                </form>
            </div>
        </div>
    </div>

@endsection