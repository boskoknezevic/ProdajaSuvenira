@extends('layouts.master')
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-3 bg-secondary">
                <ul class="list-group list-group-flush">
                    @foreach ($categories as $cat)
                    <li class="list-group-item bg-secondary">
                        <a href="{{ route('welcome') }}?cat={{ $cat->name }}" class="text-light">{{ $cat->name }}</a>
                    </li>
                    @endforeach
                    <li class="list-group-item bg-secondary">
                        <form action="{{ route('welcome') }}" method="GET">
                            <select name="type" class="form-control">
                                <option value="lower"{{ (isset(request()->type) && request()->type == 'lower')? 'selected' : '' }}>Растуће</option>
                                <option value="upper"{{ (isset(request()->type) && request()->type == 'upper')? 'selected' : '' }}>Опадајуће</option>
                            </select>
                            <button type="submit" class="btn btn-success form-control mt-1">Sortiraj</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col-9">
            <ul class="list-group">
                    @foreach ($all_ads as $ad)
                    <li class="list-group-item">
                        <img style="max-width: 100px; max-height:200px" src="{{ asset('ad_images/' . $ad->image1) }}" alt="">
                        <a href="{{ route('welcome.singleAd', ['id'=>$ad->id]) }}">{{ $ad->title }}</a>
                        <span class="badge bg-primary float-end">{{ $ad->price }}рсд</span>
                        <img src="{{ $ad->image1 }}" alt="">
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection