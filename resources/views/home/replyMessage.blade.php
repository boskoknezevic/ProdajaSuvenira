@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
           @include('home.partials.sidebar')
        </div>
            <div class="col-8">
                <h1>Reply Messages</h1>
                <ul class="list-group">
                    @foreach ($messages as $message)
                        <li class="list-group-item">
                            <p>From: {{ $message->sender->name }} <span>{{ $message->created_at->format('d-m-y') }}</span></p>
                            <p>{{ $message->text }}</p>
                            <p><strong>{{ $message->ad->title }}</strong></p>
                        </li>
                    @endforeach
                    <li class="list-group-item">
                        <form action="{{ route('home.storeReply') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sender_id" value="{{ $sender_id }}">
                            <input type="hidden" name="ad_id" value="{{ $ad_id }}">
                            <textarea name="msg" class="form-control" placeholder="Reply to {{ $message->sender->name }}" cols="30" rows="10"></textarea>
                            <button type="submit" class="btn btn-primary form-control mt-2">Reply</button>
                        </form><br>
                        @if(session()->has('msg'))
                        <div class="alert alert-warning">{{ session()->get('msg') }}</div>
                        @endif
                    </li>
                </ul>
            </div>
    </div>
</div>
@endsection
