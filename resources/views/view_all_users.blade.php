<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width:100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }
        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }
        table#t01 th {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<h2>all user</h2>


<table id="t01">

    <tr>
        <th>name</th>
        <th>type</th>
        <th>email</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td><a href="{{route("login_as_user",$user->id)}}" >{{$user->name}}</a></td>
        <td>{{$user->type}}</td>
        <td>{{$user->email}}</td>
    </tr>
@endforeach
</table>
<a href="{{route("logout",$id)}}">logout</a>

</body>
</html>
