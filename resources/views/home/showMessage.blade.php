@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
           @include('home.partials.sidebar')
        </div>
            <div class="col-8">
                <h1>Поруџбине</h1>
                <ul class="list-group">
                    @foreach ($messages as $message)
                        <li class="list-group-item">
                            <p><span>{{ $message->created_at->format('d-m-y H:i') }}</span></p>
                            <p>{{ $message->text }}</p>
                            <p><strong>{{ $message->ad->title }}</strong></p>
                        </li>
                    @endforeach
                </ul>
            </div>
    </div>
</div>
@endsection
