@extends('welcome')
@section('content')
<div class="grid wide">
    <div class="row app__content">
        <div class="c-3 col">
        </div>
        <div class="c-7 col">
            <div class="post-wrap">
                <h1 class="post-wrap__title">{{$meta_title}}</h1>
                @foreach($post as $key => $p)
                <div class="post-wrap__info">
                    {!!$p->post_content!!}
                </div>
                @endforeach
            </div>
        </div>
        <div class="c-2 col">
        </div>
    </div>
</div>   

@endsection()