<header class="header header-transparent header-sticky d-lg-block d-none">
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <!--Logo Start-->
                    <div class="logo">
                        <a href="/"><img class="front-logo" src="{{ asset( getLogoUrl()) }}" alt=""></a>
                        <h4>{{getAppName()}}</h4>
                    </div>
                    <!--Logo End-->
                </div>
                <div class="col-lg-10">
                    <!--Header Middle Right Start-->
                    <div class="header-middle-right">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="emergncy-contact-area">
                                    <div class="row">
                                        <div class="col-sm-5 col-lg-5 pl-85 pl-md-70">
                                            <div class="single-emergncy-contact">
                                                <div class="icon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <div class="content">
                                                    <h3>{{ getPhone() }}</h3>
                                                    <span>{{ getEmail() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-lg-6">
                                            <div class="single-emergncy-contact">
                                                <div class="icon">
                                                    <i class="fa fa-home"></i>
                                                </div>
                                                <div class="content">
                                                    <h3>{{ getAddress() }}</h3>
                                                    <span>{{ getCity() }}, {{ getState() }},{{ getCountry() }}.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Header Middle Right End-->
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom menu-right">
        <div class="container">
            <div class="row">

                <!--Menu start-->
                <div class="col-12 d-flex">
                    <nav class="main-menu">
                        <ul>
                            <li><a href="{{route('front.home')}}">Home</a>
                            </li>
                            <li><a href="{{route('front.services')}}">Our Services</a>
                            </li>
                            <li><a href="{{ route('front.contact-us') }}">Contact</a>
                            </li>
                            @if(!Auth::user())
                            <li><a href="{{route('login')}}">login</a>
                            </li>
                            <li><a href="#">Register</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('customer.register') }}">Customer</a></li>
                                    <li><a href="{{ route('provider.register') }}">Worker</a></li>
                                </ul>
                            </li>
                            @else
                                <li><a href="{{route('front.user-profile')}}">My Account</a>
                                </li>
                            @if(getLoggedInUser()->role === 'Admin')
                                <li><a href="{{route('users.index')}}">Dashboard</a>
                                </li>
                                @endif
                            <li>
                                <form id="logout-form" action="{{ route('logout.user') }}" method="post">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                    Logout</a>
                            </li>
                            @endif

                        </ul>
                    </nav>
                </div>
                <!--Menu end-->
            </div>

        </div>
    </div>
</header>


<!--  mobile header area -->
<div class="mobile-header-area d-block d-lg-none">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <!-- logo -->
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset('front/assets/images/logo.png')}}" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <div class="mobile-cart">
                    <a href="cart.html"><i class="fa fa-shopping-cart"></i></a>
                </div>
                <!-- mobile menu -->
                <div class="mobile-navigation-icon" id="mobile-menu-trigger">
                    <i></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End of mobile header area -->

<!-- offcanvas mobile menu -->
<div class="offcanvas-mobile-menu d-block d-lg-none" id="mobile-menu-overlay">
    <a href="javascript:void(0)" class="offcanvas-menu-close" id="mobile-menu-close-trigger">
        <i class="fa fa-times"></i>
    </a>

    <div class="offcanvas-wrapper">

        <div class="offcanvas-inner-content">
            <div class="offcanvas-mobile-search-area">
                <form action="#">
                    <input type="search" placeholder="Search ...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <nav class="offcanvas-navigation">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="#">Home</a>
                        <ul class="submenu2">
                            <li><a href="index.html">Homepage – 01</a></li>
                            <li><a href="index-2.html">Homepage – 02</a></li>
                            <li><a href="index-3.html">Homepage – 03</a></li>
                            <li><a href="index-4.html">Homepage – 04</a></li>
                            <li><a href="index-5.html">Homepage – 05</a></li>
                            <li><a href="index-6.html">Homepage – 06</a></li>
                            <li><a href="index-7.html">Homepage – 07</a></li>
                            <li><a href="index-8.html">Homepage – 08</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Our Services</a>
                        <ul class="submenu2">
                            <li class="menu-item-has-children"><a href="service.html">Grid Layout 1</a>
                                <ul class="submenu2">
                                    <li><a href="service-renovation.html">Renovation</a></li>
                                    <li><a href="service-plumbing.html">Plumbing</a></li>
                                    <li><a href="service-dry-wall.html">Dry Wall</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="services-layout-2.html">Grid Layout 2</a>
                                <ul class="submenu2">
                                    <li><a href="service-electrical.html">Electrical</a></li>
                                    <li><a href="service-heating.html">Heating</a></li>
                                    <li><a href="service-bathroom.html">Bathroom</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="services-layout-3.html">Grid Layout 3</a>
                                <ul class="submenu2">
                                    <li><a href="service-painting.html">Painting</a></li>
                                    <li><a href="service-roofing.html">Roofing</a></li>
                                    <li><a href="service-interior.html">Interior</a></li>
                                </ul>
                            </li>
                            <li class="tag-new"><a href="services-layout-4.html">Grid Layout 4</a></li>
                            <li><a href="services-layout-list.html">List Layout</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="submenu2">
                            <li><a href="cost-calculator.html">Cost Calculator</a></li>
                            <li class="menu-item-has-children"><a href="about.html">About Us</a>
                                <ul class="submenu2">
                                    <li><a href="about.html">Layout 1</a></li>
                                    <li><a href="about-2.html">Layout 2</a></li>
                                </ul>
                            </li>
                            <li><a href="team.html">Our Team</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="site-maintenance.html">Site Maintenance</a></li>
                            <li class="menu-item-has-children"><a href="#">Page TiItle Variants</a>
                                <ul class="submenu2">
                                    <li><a href="single-color-background.html">Single Color Background</a></li>
                                    <li><a href="image-background.html">Image Background</a></li>
                                    <li><a href="big-image-background.html">Big Image Background</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children">
                        <a href="#">Blog</a>
                        <ul class="submenu2">
                            <li><a href="blog.html">List Layout</a></li>
                            <li><a href="blog-grid-layout.html">Grid Layout</a></li>
                            <li><a href="blog-simple-layout.html">Simple Layout</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Shop</a>
                        <ul class="submenu2">
                            <li><a href="shop.html">Shop</a></li>
                            <li><a href="full-width-shop.html">Full Width Shop Layout</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                            <li><a href="product-details.html">Product Details</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Contact</a>
                        <ul class="submenu2">
                            <li><a href="contact.html">Layout 1</a></li>
                            <li><a href="contact-2.html">Layout 2</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="offcanvas-settings">
                <nav class="offcanvas-navigation">
                    <ul>
                        <li><a href="#">Information </a></li>
                        <li class="menu-item-has-children"><a href="#">Extras </a>
                            <ul class="submenu2">
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="site-maintenance.html">Site Maintenance</a></li>
                                <li><a href="404.html">404</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Alternative Pages </a></li>
                    </ul>
                </nav>
            </div>

            <div class="offcanvas-widget-area">
                <div class="off-canvas-contact-widget">
                    <div class="header-contact-info">
                        <ul class="header-contact-info__list">
                            <li><i class="ion-android-phone-portrait"></i> <a href="tel://12452456012">1-775-97-377 </a></li>
                            <li><i class="ion-android-mail"></i> <a href="#">14 Tottenham Court Road</a></li>
                        </ul>
                    </div>
                </div>
                <!--Off Canvas Widget Social Start-->
                <div class="off-canvas-widget-social">
                    <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" title="Twitter"><i class="fa fa-google-plus"></i></a>
                    <a href="#" title="LinkedIn"><i class="fa fa-twitter"></i></a>
                    <a href="#" title="Youtube"><i class="fa fa-youtube-play"></i></a>
                </div>
                <!--Off Canvas Widget Social End-->
            </div>
        </div>
    </div>

</div>
<!-- End of offcanvas mobile menu -->