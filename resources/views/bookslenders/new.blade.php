@extends('layouts.app')

@section('content')

    <div class="container pt-100">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <h3 class="login-heading mb-4 text-center">Create booklender</h3>
                <form action="/bookslenders" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Date returned" value="{{ old('date_returned') }}" name="date_returned" required>
                    </div>
                    @if ($errors->has('date_returned'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_returned') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Due date" value="{{ old('due_date') }}" name="due_date" required>
                    </div>
                    @if ($errors->has('due_date'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fine" value="{{ old('fine') }}" name="fine" required>
                    </div>
                    @if ($errors->has('fine'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fine') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Book_id" value="{{ old('book_id') }}" name="book_id" required>
                    </div>
                    @if ($errors->has('book_id'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('book_id') }}</strong>
                                    </span>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Lender id" value="{{ old('lender_id') }}" name="lender_id" required>
                    </div>
                    @if ($errors->has('lender_id'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lender_id') }}</strong>
                                    </span>
                    @endif


                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

                </form>
            </div>
        </div>
    </div>

@endsection