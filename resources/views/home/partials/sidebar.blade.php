<a href="{{ route('home') }}" class="btn btn-secondary form-control m-2">Сви сувенири</a>
<a href="{{ route('home.newAd') }}" class="btn btn-secondary form-control m-2">Додај нови сувенир</a>
<a href="{{ route('home.showMessage') }}" class="btn btn-primary form-control m-2">Поруџбине : {{ Auth::user()->message->count() }}</a>