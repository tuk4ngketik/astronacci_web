@extends('layout')

@section('content')

<table class="table table-hover">
 <thead>
    <tr>
        <td>Email</td> <td>Name</td> <td>Created</td> <td></td>
    </tr>
 </thead>
 
 <tbody>
    @foreach($row as $item)
    <tr>
        <td>
           <a href="{{ url('detail-user') }}/{{ $item->id }}">{{ $item->email }}</a>
        </td> 
        <td>{{ $item->name}}</td> <td>{{ $item->created_at}}</td> <td></td>
    </tr>
    @endforeach
</tbody>
 
</table>

@endsection