@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
           @include('home.partials.sidebar')
        </div>
            <div class="col-8">
                <h1>Додај нови сувенир</h1>
                <form action="{{ route('home.storeAd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" placeholder="Наслов" class="form-control"><br>
                    <textarea name="body" placeholder="Опис" class="form-control" cols="30" rows="10"></textarea><br>
                    <input type="number" name="price" placeholder="Цена" class="form-control"><br>
                    <input type="file" name="image1" placeholder="Слика" class="form-control"><br>
                    <select name="category" class="form-control">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                         @endforeach
                    </select><br>
                    <button type="submit" class="btn btn-primary form-control">Потврди</button>
                </form>
            </div>
    </div>
</div>
@endsection
