@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-8">
            <div class="form-group">
                <input type="text" class="form-control" onkeyup="filterByName(this)" placeholder="Search for names..">
            </div>
        </div>
    </div>
    <div id="coin_data">
        @include('coins.cripto_table', ['list' => $list])
    </div>

@endsection

@section('scripts')
    <script src="/js/jquery.tablesorter.min.js"></script>
    <script>
        $(function() {
            createSorter();
            setInterval(coinApi, {{config('settings.coinmarketcap_update_time')}} * 1000);

            $('#update_data').on('click', coinApi);
        });

        function createSorter(sort)
        {
            sort = sort == undefined ? [[3, 1]] : sort;

            $( "#cripto_table" ).tablesorter({
                sortList : sort
            });
        }

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

        function coinApi()
        {
            var xhr = new XMLHttpRequest(), btn = document.getElementById('update_data'), sort = [[3, 1]];

            btn.disabled = 'disabled';
            btn.innerText = 'Updateing...';
            xhr.open('GET', '{{url('/coin-api')}}', false);
            xhr.send();
            if (xhr.status == 200) {
                $( "#cripto_table" ).find('th').each(function(){
                    if($(this).hasClass('headerSortUp')) {
                        sort[0][0] = $(this).index();
                        sort[0][1] = 1;
                    } else if($(this).hasClass('headerSortDown')) {
                        sort[0][0] = $(this).index();
                        sort[0][1] = 0;
                    }
                })

                document.getElementById('coin_data').innerHTML =  xhr.responseText;

                createSorter(sort);

                btn.removeAttribute('disabled');
                btn.innerText = 'Update data';
            }
        }
    </script>
@endsection