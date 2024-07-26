@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
           @include('home.partials.sidebar')
        </div>
            <div class="col-8">
                <h1>{{ $singleAd->title }}</h1>
                <div class="row">
                    <div class="col-6 offser-3">
                        @if (isset($singleAd->image1))
                            <img src="/ad_images/{{ $singleAd->image1 }}" id="main-img" class="img-fluid">
                        @endif
                    </div>
                </div>
                <h3>{{ $singleAd->body }}</h3>
                @if(session()->has('message'))
                <button class="alert alert-warning">{{ session()->get('message') }}</button>
                @endif
            </div>
    </div>
</div>
@endsection

