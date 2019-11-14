@extends('layout')

@section('title')
    Form Page
@endsection

@section('content')

    <div class="content container">
        <h1>Add Places</h1>
        @if (isset($error_data))
            <div class="alert alert-danger alert-dismissible fade show errorMessage" role="alert">
                {{$error_data}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                @if ($errors->any())
                    <div class="alert alert-danger form_alerts">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="myform" method="POST" action="/add">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="countriesSelect1">Countries</label>
                        <select class="form-control" id="countriesSelect1" name="countriesSelect1">

                            @foreach($countries as $kay => $val )
                                <option value="{{$val}}/{{$kay}}">{{$kay}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Zip_code</label>
                        <input type="text" name="zip_code" class="form-control" id="zip_code" placeholder="zip_code">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.errorMessage .close', function () {
                $('.errorMessage').remove();
                location.replace('/add');
            });
        });
    </script>
    @parent
@stop