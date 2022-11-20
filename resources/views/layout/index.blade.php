<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Htradexim</title>
    <link rel="shortcut icon" href="upload/favicon/logo.jpg" type="image/x-icon">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <base href="{{asset("")}}">
    <!-- Css Styles -->
    <link rel="stylesheet" href="user_asset/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/style.css" type="text/css">
    <link rel="stylesheet" href="user_asset/css/products.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->

    
    <!-- Humberger End -->

    <!-- Header Section Begin -->
   @include('layout.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
   @include('layout.menu')
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
  
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
   @yield('content')
    <!-- Featured Section End -->
    <!-- Footer Section Begin -->
    @include('layout.footer')
    <!-- Footer Section End -->
    <a href="#" id="toTopBtn" class="cd-top text-replace js-cd-top cd-top--is-visible cd-top--fade-out" data-abc="true"></a>

    <!-- Js Plugins -->
    <script src="user_asset/js/jquery-3.3.1.min.js"></script>
    <script src="user_asset/js/bootstrap.min.js"></script>
    <script src="user_asset/js/jquery.nice-select.min.js"></script>
    <script src="user_asset/js/jquery-ui.min.js"></script>
    <script src="user_asset/js/jquery.slicknav.js"></script>
    <script src="user_asset/js/mixitup.min.js"></script>
    <script src="user_asset/js/owl.carousel.min.js"></script>
    <script src="user_asset/js/main.js"></script>
    <script src="user_asset/js/zoom.js"></script>
    <script>
        $(document).ready(function() {
        $(window).scroll(function() {
        if ($(this).scrollTop() > 20) {
        $('#toTopBtn').fadeIn();
        } else {
        $('#toTopBtn').fadeOut();
        }
        });

        $('#toTopBtn').click(function() {
        $("html, body").animate({
        scrollTop: 0
        }, 1000);
        return false;
        });
        });
    </script>
</body>

</html>