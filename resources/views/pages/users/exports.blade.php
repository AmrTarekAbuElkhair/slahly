<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>email</th>
        <th>phone</th>
        <th>country</th>
        <th>city</th>
        <th>created at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key=>$user)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->mobile}}</td>
            <td>{{$user->country->name}}</td>
            <td>{{$user->city}}</td>
            <td>{{$user->created_at}}</td>
        </tr>
    @endforeach
    </tbody>

</table>
