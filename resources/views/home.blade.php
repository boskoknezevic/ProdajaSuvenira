@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
           @include('home.partials.sidebar')
        </div>
            <div class="col-8">
                <h1>Сви сувенири</h1>
                <ul class="list-group">
                    @foreach ($all_ads as $ad)
                        <li class="list-group-item">
                            <img style="max-width: 100px; max-height:200px" src="{{ asset('ad_images/' . $ad->image1) }}" alt="">
                            <a href="{{ route('home.singleAd', ['id'=>$ad->id]) }}">{{ $ad->title }}</a>
                        </li>
                    @endforeach
                </ul>
                @if (session()->has('message'))
                <p class="alert alert-warning">{{ session()->get('message') }}</p>
                @endif
            </div>
    </div>
</div>
@endsection
