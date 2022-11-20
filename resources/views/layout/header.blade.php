 <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                    @foreach($logos as $value)
                        <a href="/"><img src="upload/logos/{!! $value['image'] !!}" alt=""></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
            <!-- <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div> -->
        </div>
    </header>