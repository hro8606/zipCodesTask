@extends('../layout')

@section('title')
    Countries
@endsection

@section('content')

    <div class="content container">
        <h1>Countries.blade</h1>
        <div class="searchData row">
            <input type="text" name="search" id="search" value="{{$last_zip_code ?? ""}}" placeholder=" Live Search data" class="form-control">
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>Country</th>
                    <th>Abbrev.</th>
                    <th>Place</th>
                    <th>State</th>
                    <th>longitude</th>
                    <th>latitude</th>
                    <th>Zip_code</th>
                </tr>
                </thead>
                <tbody>
                {{--Adding by js, using Live search --}}
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $lastSearch = $('#search').val();
            fetch_custom_data($lastSearch);
           function fetch_custom_data(query = '') {

               $.ajax({
                    url:"{{ route('live_search.action') }}",
                   method:'GET',
                   data:{query:query},
                   dataType:'json',
                   success:function (data) {
                        $('tbody').html(data.table_data);
                   }
               })
           }
           $(document).on('keyup','#search',function () {
               var query = $(this).val();
                fetch_custom_data(query);
           });
        });
    </script>
    @parent
@stop