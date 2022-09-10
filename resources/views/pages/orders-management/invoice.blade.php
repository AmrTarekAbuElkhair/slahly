<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/main.css') }}">
    <title>فاتورة</title>
</head>
<body>
<div class="row">
    <div class="container">
        <h1 style='text-align: center'>فاتورة</h1>
        <h5>اسم الشركة <span>صلحلي وشطبلي</span></h5>
        <h5>اسم الفني <span>@if($order->provider_id!=null){{$order->provider->name}}@else provider not found @endif</span></h5>
        <h5>اسم العميل <span>{{$order->user->name}}</span></h5>
        <h5>رقم العملية <span>{{$order->order_number}}</span></h5>
        <h5>الساعة والتاريخ <span>{{$order->created_at}}</span></h5>
    </div>
</div>
<div class="row">
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">بيان الأعمال</th>
                <th scope="col">سعر الدقيقة</th>
                <th scope="col">الإجمالي</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <!-- مسلسل -->
                <th scope="row">{{$order->id}}</th>
                <!-- بيان الأعمال -->
                <td>{{$order->service->name}}</td>
                <!-- سعر الساعة -->
                <td>@if($order->provider_id!=null){{\App\Models\WorkerPrice::where('worker_id',$order->provider_id)->first()->price}}@else 0 @endif<span id='carrancy'>جنيهات</span></td>
                <!-- الإجمالي الخاص بكل عملية -->
                <td>{{$order->price}} <span id='carrancy'>جنيهات</span></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
</body>

</html>
