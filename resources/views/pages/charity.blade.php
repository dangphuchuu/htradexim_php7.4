@extends('layout.index')
@section('content')
<section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">     
                    <h2 style="text-align: center; margin-bottom: 25px; text-transform: uppercase;"></h2>  
                    <div class="row">
                    @foreach($charity as $values)
                    @if($values['image'])
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div data-action="zoom">
                                    <img class="img_products " src="upload/charity/{!! $values['image'] !!}" alt="">
                                </div>
                            </div>
                        </div>
                    @endif
                        @endforeach
                    @foreach($charity as $charity)
                    @if($charity['path'])
                        <div class="col-lg-12">
                            <iframe style="height: 700px;" width="100%"  src="https://www.youtube.com/embed/{!! $charity['path'] !!}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection