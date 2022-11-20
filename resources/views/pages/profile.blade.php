@extends('layout.index')
@section('content')
<section class="featured spad">
        <div class="container">
            @foreach($profiles as $value)
               <div class="profile-img ">
                <img src="upload/profiles/{!! $value['image'] !!}" alt="" class="zoom" >
                </div>
            @endforeach
        </div>
    </section>
    {!! $profiles->links() !!}        
@endsection