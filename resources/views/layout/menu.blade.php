<section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>CATEGORIES</span>
                        </div>
                        <ul>
                            @foreach($categories as $values)
                            <li><a href="/products/{!!$values['id']!!}_{!!$values['name']!!}.html" style="text-transform: uppercase;">{!! $values['name'] !!}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                <div class="hero__search">
                <a href="/charity.html">
                        <div class="hero__search__form" style="display: flex;justify-content: center;align-items: center;">
                        <i class="fa-solid fa-star" style="color: #ffad00;"></i> <p style="font-size: 26px; margin: 0 12px;">SOCIAL ACTIVITES</p> <i class="fa-solid fa-star" style="color: #21ab50;"></i>
                                    <span class="arrow_carrot"></span>
                        </div>
                        </a>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+84 938 932 527</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    @foreach($banners as $values)
                    <div class="hero__item set-bg" data-setbg="upload/banners/{!! $values['image'] !!}">
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>