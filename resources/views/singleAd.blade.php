@extends('layouts.master')

@section('main')
<div class="container">
    <div class="row">
        @if(isset($singleAd->image1))
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <img src="/ad_images/{{ $singleAd->image1 }}" class="img-flush">
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12">
            <h1 class="display-4">{{ $singleAd->title }}<span class="btn btn-success">{{ $singleAd->category->name }}</span></h1>
            <p>{{ $singleAd->body }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <form action="{{ route('welcome.sendMessage', ['id'=>$singleAd->id]) }}" method="POST">
            @csrf
            <h2>Да бисте поручили овај артикал попуните следећи образац:</h2>
            <textarea name="msg" class="form-control" placeholder="Име: &#10;Презиме: &#10;Адреса: &#10;Количина: &#10;" cols="30" rows="10"></textarea>
            <button type="submit" class="btn btn-primary control-form mt-2">Наручи</button>
        </form> <br>
        @if (session()->has('message'))
            <div class="alert alert-warning">{{ session()->get('message') }}</div>
        @endif
    </div>
</div>
@endsection
