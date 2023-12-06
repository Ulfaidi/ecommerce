<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('dic') }}/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>
    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="{{ asset('dic') }}/css/linearicons.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/nouislider.min.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="{{ asset('dic') }}/css/ion.rangeSlider.skinFlat.css" />
    <link rel="stylesheet" href="{{ asset('dic') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('dic') }}/css/main.css">
</head>

<body>

    <!-- Start Header Area -->
    @include('web.header')
    <!-- End Header Area -->


    <!-- start banner Area -->
    <section class="banner-area">
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center" style="margin-top: 180px;">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Latest Products</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et
                                dolore
                                magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    @foreach ($barangData as $barang)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="{{ asset('dic') }}/img/product/p1.jpg" alt="">
                                <div class="product-details">
                                    <h6>{{ $barang->nama }}</h6>
                                    <div class="price">
                                        <h6>${{ $barang->harga }}</h6>
                                        {{-- jika diskon --}}
                                        @if ($barang->harga_diskon)
                                            <h6 class="l-through">${{ $barang->harga_diskon }}</h6>
                                        @endif
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="{{ asset('dic') }}/" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="{{ asset('dic') }}/" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="{{ asset('dic') }}/" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="{{ asset('dic') }}/" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <!-- start footer Area -->
    @include('web.footer')
    <!-- End footer Area -->

    <script src="{{ asset('dic') }}/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('dic') }}/https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('dic') }}/js/vendor/bootstrap.min.js"></script>
    <script src="{{ asset('dic') }}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('dic') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('dic') }}/js/jquery.sticky.js"></script>
    <script src="{{ asset('dic') }}/js/nouislider.min.js"></script>
    <script src="{{ asset('dic') }}/js/countdown.js"></script>
    <script src="{{ asset('dic') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('dic') }}/js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="{{ asset('dic') }}/https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE">
    </script>
    <script src="{{ asset('dic') }}/js/gmaps.min.js"></script>
    <script src="{{ asset('dic') }}/js/main.js"></script>
</body>

</html>
