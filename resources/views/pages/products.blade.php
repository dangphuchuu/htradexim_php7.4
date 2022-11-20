@extends('layout.index')
@section('content')
<section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">     
                    @if($catname !=NULL)
                    <h2 style="text-align: center; margin-bottom: 25px; text-transform: uppercase;">{!! $catname['name'] !!}</h2>  
                    @endif
                    <div class="row">
                    @foreach($products as $values)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div data-action="zoom">
                                    <img class="img_products " src="upload/products/{!! $values['image'] !!}" alt="">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @foreach($videos as $value)
                        <div class="col-lg-12">
                            <iframe style="height: 700px;" width="100%"  src="@if(isset($value['path'])) 
                                            https://www.youtube.com/embed/{!! $value['path'] !!} 
                                            @endif" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection