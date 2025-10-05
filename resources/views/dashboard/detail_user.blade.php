@extends('layout')

@section('content')

<h3>Detail user</h3>
<div class='row'>
    <div class='col-sm-4'>
        <img class="img-thumbnail" src="data:image/png;base64,{{ $row['profile_image'] }}" />
    </div>
    <div class='col-sm-8'>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                <div class="fw-bold">Name</div>
                {{ $row['email'] }}
                </div>
                <span class="badge text-bg-primary rounded-pill">{{ $row['id'] }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                <div class="fw-bold">Name</div>
                {{ $row['name'] }}
                </div> 
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                <div class="fw-bold">Created</div>
                {{ $row['created_at'] ??     '-' }}
                </div> 
            </li>
        </ul>
    </div>

</div>

@endsection