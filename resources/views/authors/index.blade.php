@extends('layouts.app')

@section('content')

    @include('success')
    <div class="container pt-100">
        <div class="row">
            <div class="col-md-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"><a href="/">Addresses</a></th>
                        <!--<th scope="col">First</th>-->
                        <!--<th scope="col">Last</th>-->
                        <!--<th scope="col">Handle</th>-->
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <th scope="row" class="active-tab"><a href="/authors">Authors</a></th>
                        <!--<td>Mark</td>-->
                        <!--<td>Otto</td>-->
                        <!--<td>@mdo</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/books">Books</a></th>
                        <!--<td>Jacob</td>-->
                        <!--<td>Thornton</td>-->
                        <!--<td>@fat</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/booklenders">Booklenders</a></th>
                        <!--<td>Larry</td>-->
                        <!--<td>the Bird</td>-->
                        <!--<td>@twitter</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/categories">Categories</a></th>
                        <!--<td>Larry</td>-->
                        <!--<td>the Bird</td>-->
                        <!--<td>@twitter</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/genders">Genders</a></th>
                        <!--<td>Larry</td>-->
                        <!--<td>the Bird</td>-->
                        <!--<td>@twitter</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/lenders">Lenders</a></th>
                        <!--<td>Larry</td>-->
                        <!--<td>the Bird</td>-->
                        <!--<td>@twitter</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/publishers">Publishers</a></th>
                        <!--<td>Larry</td>-->
                        <!--<td>the Bird</td>-->
                        <!--<td>@twitter</td>-->
                    </tr>
                    <tr>
                        <th scope="row"><a href="/staffs">Staffs</a></th>
                        <!--<td>Larry</td>-->
                        <!--<td>the Bird</td>-->
                        <!--<td>@twitter</td>-->
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-9 ofx-s overflow-x">
                <h5>{{ $count }} Rows</h5>
                <table class="table">
                    <!--<thead>-->
                    <!--<tr>-->
                    <!--<th scope="col">#</th>-->
                    <!--<th scope="col">First</th>-->
                    <!--<th scope="col">Last</th>-->
                    <!--<th scope="col">Handle</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Date Created</th>
                        @if (Auth::user()->level === 1)
                            <th scope="col"><a href="/authors/create" class="btn btn-outline-secondary">Create</a></th>
                        @endif

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>{{ $author->fname }}</td>
                            <td>{{ $author->lname }}</td>
                            <td>{{ $author->age }}</td>
                            <td>{{ $author->date_created }}</td>
                            @if (Auth::user()->level === 1)
                                <td>
                                    <a href="/authors/{{ $author->id }}/edit" class="btn btn-outline-secondary">Edit</a>
                                </td>
                                <td>
                                    <form action="/authors/{{ $author->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-secondary">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach



                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
