<table>
    <thead>
    <tr>
        <th>User</th>
        <th>provider</th>
        <th>package</th>
        <th>service</th>
        <th>offer</th>
        <th>mobile</th>
        <th>order number</th>
        <th>price</th>
        <th>status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orders as $key=>$order)
        <tr>
            <td>{{$key+1}}</td>
            <td>@if(isset($order->user->name)) {{$order->user->name}} @else user not found @endif</td>
            <td>@if(isset($order->provider->name)) {{$order->provider->name}} @else provider not found @endif</td>
            <td>@if(isset($order->package->name)) {{$order->package->name}} @else package not found @endif</td>
            <td>@if(isset($order->service->name)) {{$order->service->name}} @else service not found @endif</td>
            <td>@if(isset($order->offer->name)) {{$order->offer->name}} @else offer not found @endif</td>
            <td>{{$order->mobile}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->price}}</td>
            <td>@if($order->status==0)
                    new
                @elseif($order->status==1)
                    in way
                @elseif($order->status==2)
                    arrived
                @elseif($order->status==3)
                    start processing
                @elseif($order->status==4)
                    finished from user
                @elseif($order->status==5)
                    finished from worker
                @elseif($order->status==6)
                    paid
                @else
                    cancelled
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
