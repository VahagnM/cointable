@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-8">
            <div class="form-group">
                <input type="text" class="form-control" onkeyup="filterByName(this)" placeholder="Search for names..">
            </div>
        </div>
    </div>
    <table id="cripto_table" class="table table-hover">
        <thead>
            <th>#</th>
            <th>Name<span></span></th>
            <th>Price<span></span></th>
            <th>% Change(24h)<span></span></th>
        </thead>
        <tbody>
            @foreach($list as $index => $item)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price_usd}}</td>
                    <td @if($item->percent_change_24h < 0) class="text-danger" @else class="text-success" @endif>{{$item->percent_change_24h}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script src="/js/jquery.tablesorter.min.js"></script>
    <script>
        $(function() {
            $( "#cripto_table" ).tablesorter();
        });

        function filterByName(input) {
            // Declare variables
            var filter, tr, td, i;
            filter = input.value.toUpperCase();
            tr = document.querySelectorAll("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection