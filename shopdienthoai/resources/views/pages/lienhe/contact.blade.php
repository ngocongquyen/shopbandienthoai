@extends('welcome')
@section('content')
<div class="grid wide">
    <div class="row app__content">
    @foreach($contact as $key => $val)
        <div class="c-3 col">
            <div class="contact-form">
                {!!$val->info_contact!!}
            </div>
        </div>
        <div class="c-9 col">
            {!!$val->info_map!!}
        </div>
    </div>
    @endforeach
</div>   

@endsection()