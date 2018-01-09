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