    <nav class="nav-bar main-nav-bar">
        <div class="nav-output">
            <div class="bg-gray" itemscope itemtype="https://schema.org/Organization">
                <div class="container-fluid clearfix">
                    <div class="contact-boxes d-flex align-items-center justify-content-between">

                        <div class="col-lg-6 d">
                            <div class="upper-navbar-left">
                                <div class="h-100 d-inline-flex align-items-center me-4 nav_icon ">
                                    <i class="fa-solid fa-phone-volume"></i>
                                    <a href="tel: {{ nova_get_setting('site_phone') }}" class="text-nav text-dark"
                                        itemprop="telephone">
                                        <span> {{ nova_get_setting('site_phone') }}</span>
                                    </a>
                                </div>

                                <div class="h-100 d-inline-flex align-items-center me-4 nav_icon">
                                    <i class="fa-solid fa-envelope"></i>
                                    <a href=" mailto:{{ nova_get_setting('site_email') }} "
                                        class="text text-nav text-dark" itemprop="email">
                                        <span>{{ nova_get_setting('site_email') }}</span>
                                    </a>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6 ">
                            <div class="upper-navbar-right">
                                <!-- لغة -->
                                <div class="Language-box">
                                    <div class="dropdown" itemprop="availableLanguage" itemscope
                                        itemtype="https://schema.org/Language">
                                        <a class="p-2 dropdown-toggle lang-btn d-flex align-items-center gap-1"
                                            href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-globe"></i> <span itemprop="name">
                                                {{ LaravelLocalization::getCurrentLocaleNative() ?? 'English' }}
                                            </span>
                                        </a>


                                        <ul class="dropdown-menu lang-dropdown" aria-labelledby="dropdownMenuLink">
                                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                        <span itemprop="name">
                                                            {{ $properties['native'] }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                <!-- عملات -->
                                <div itemscope itemtype="https://schema.org/LocalBusiness">
                                    <div class="Language-box">
                                        <div class="dropdown">
                                            <a class="p-2 dropdown-toggle lang-btn d-flex align-items-center gap-1"
                                                href="#" role="button" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-coins"></i>
                                                <span itemprop="currenciesAccepted">
                                                    {{ session()->has('currency') ? \App\Models\Currency::where('id', session()->get('currency')->id)->first()->code . ' ' . session()->get('currency')->symbol : __('navbar.currency') }}
                                                </span>
                                            </a>

                                            <ul class="dropdown-menu lang-dropdown" aria-labelledby="dropdownMenuLink">
                                                @foreach ($currencies as $currency)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            onclick="event.preventDefault(); document.getElementById('switchCurrency-{{ $currency->id }}').submit();">
                                                            {{ $currency->symbol }}
                                                            <span itemprop="currenciesAccepted">
                                                                {{ $currency->code }}
                                                            </span>
                                                        </a>
                                                        <form id="switchCurrency-{{ $currency->id }}"
                                                            action="{{ route('currency.switch', ['id' => $currency->id]) }}"
                                                            method="POST" style="display: none;">@csrf</form>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <header class="site-header header mo-left header-transparent text-black">
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix ">
                    <div class="container-fluid clearfix">

                        <div class="logo-header  logo-dark">
                            <div itemscope itemtype="http://schema.org/Organization">
                                <a href="{{ route('home') }}">
                                    <img loading="lazy" class="d-block logo-top" src="./assets/images/logo.png"
                                        alt="TourVista-Logo">
                                    <img loading="lazy" class="d-none logo-scroll" src="./assets/images/logo.png"
                                        alt="TourVista-Logo">
                                </a>
                            </div>

                        </div>

                        <div class="header-nav navbar-collapse collapse " id="navbarNavDropdown">

                            <ul class="nav navbar-nav navbar">
                                <li class=""><a href="{{ route('home') }}"><span>
                                            {{ __('navbar.home') }}
                                        </span>
                                    </a>
                                </li>
                                @foreach ($headercategories as $headercategory)
                                    <li>
                                        <a href="#"><span>
                                                {{ $headercategory->name }}
                                            </span>
                                            <i class="fa fa-chevron-down"></i>
                                        </a>

                                        <!-- dropdown container -->
                                        <div class="sub-menu deals-dropdown">

                                            <!-- right links -->

                                            <ul class=" deals-links">
                                                @foreach ($headercategory->children as $subCategory)
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{ $subCategory->getFirstMediaUrlOrDefault(MediaHelper::SUB_CATEGORY_SUBIMG_MEDIA_PATH, 'webp')['url'] }}">
                                                            {{ $subCategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>

                                        </div>
                                    </li>
                                @endforeach

                                @if ($DahabiyaCategories)
                                    <li>
                                        <a href="./SubCategory.html">
                                            <span>
                                                {{ $DahabiyaCategories->name }}
                                            </span>
                                            <i class="fa fa-chevron-down"></i>
                                        </a>

                                        <!-- dropdown container -->
                                        <div class="sub-menu deals-dropdown">

                                            <!-- right links -->

                                            <ul class=" deals-links">
                                                @foreach ($DahabiyaCategories->children->first()->tours as $tour)
                                                    <li>
                                                        <a href="./Tour.html">
                                                            <img src="./assets/images/icon.(3).svg">
                                                            {{ $tour->name }}
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>

                                        </div>
                                    </li>
                                @endif

                                <li>
                                    <span> Pages <i class="fa fa-chevron-down"></i> </span>
                                    <div class="sub-menu deals-dropdown">
                                        <!-- left info -->


                                        <!-- right links -->

                                        <div class=" mega__menu">
                                            <div class="menu_column">
                                                <ul class=" deals-links">

                                                    <li><a href="./freepage.html">
                                                            <img src="./assets/images/tag.png">
                                                            Tags
                                                        </a>
                                                    </li>
                                                    <li><a href="./freepage.html"> <img
                                                                src="./assets/images/Testimonials.svg">
                                                            About Us
                                                        </a>
                                                    </li>
                                                    <li><a href="./freepage.html"> <img
                                                                src="./assets/images/Terms and Conditions.svg">
                                                            Terms & Condition
                                                        </a>
                                                    </li>
                                                    <li><a href="./freepage.html"> <img
                                                                src="./assets/images/schedule.webp">
                                                            Payment & Cancelation Policy
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="menu_column">
                                                <ul class=" deals-links">

                                                    <li>
                                                        <a href="./freepage.html">
                                                            <img src="./assets/images/icon09 (1).svg">

                                                            our Mission
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="./freepage.html">
                                                            <img src="./assets/images/purpose.png">

                                                            Policy and privacy
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="./article_Category.html">
                                                            <img src="./assets/images/Blogs2.svg">

                                                            Blog
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="./contact-us.html">
                                                            <img src="./assets/images/communicate.png">

                                                            Contact Us
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <ul class="sub-menu sub_menu">
                                        <li><a href="./aboutUs.html"> <img src="./assets/images/icon09.svg"> About
                                                Us</a></li>
                                        <li><a href="./Blog.html"> <img src="./assets/images/icon099.svg">
                                                Blogs</a></li>
                                        <li><a href="./contact-us.html"><img src="./assets/images/icon08).svg"> Contact
                                                Us</a></li>
                                        <li>
                                            <a href="./transfer.html"><img src="./assets/images/Rent Car.svg">

                                                Rent Car
                                            </a>
                                        </li>

                                        <li><a href="./aboutUs.html"> <img src="./assets/images/icon09.svg"> About
                                                Us</a></li>
                                        <li><a href="./Blog.html"> <img src="./assets/images/icon099.svg">
                                                Blogs</a></li>
                                        <li><a href="./contact-us.html"><img src="./assets/images/icon08).svg"> Contact
                                                Us</a></li>
                                        <li>
                                            <a href="./transfer.html"><img src="./assets/images/Rent Car.svg">

                                                Rent Car
                                            </a>
                                        </li>


                                    </ul> -->
                                </li>
                            </ul>
                            <div class="extra-nav  d-none d-sm-block">
                                <a href="tailorMade.html" class="theme-btn"><i class="fa-solid fa-arrow-right"></i>

                                    Plan Your Trip
                                </a>

                            </div>
                        </div>
                    </div>

                    <button class="navbar-toggler collapsed d-block d-lg-none d-xl-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon" id="navbarIcon">
                            <span class="bar1"></span>
                            <span class="bar2"></span>
                            <span class="bar3"></span>
                        </span>
                    </button>
                </div>
            </div>
        </header>
    </nav>

    <div class="side-menu">
        <a href="#" class="close-side-menu">
            <i class="fas fa-times"></i>
        </a>
        <div class="inner-side">
            <div class="menu-mobile">
                <a class="mobile-logo" href="{{ route('home') }}">
                    <img src="./assets/images/logo.png" alt="logo">
                </a>
                <ul id="mobile-main-menu" class="mobile nav-menu">
                    <li class="mobile nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>

                    <li class="nav-item mobile has-dropdown">
                        <a href="./SubCategory.html" class="nav-link">
                            Day Tours
                            <span class="icon-down icon-down-one">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="mobile sub-menu">
                            <li><a href="./Tour.html"> <img src="./assets/images/icon.svg (3).svg">Cairo Day Tours</a>
                            </li>
                            <li><a href="./Tour.html"> <img src="./assets/images/icon.svg (2).svg"> ⁠Luxor Day
                                    Tours</a>
                            </li>
                            <li><a href="./Tour.html"><img src="./assets/images/icon.svg(22).svg">⁠Hurghada Day
                                    Tours</a></li>
                            <li><a href="./Tour.html"><img src="./assets/images/icon01.svg"> Dahab Day Tours</a></li>
                            <li><a href="./Tour.html"><img src="./assets/images/icon.svg.svg">⁠Aswan Day Tours</a>
                            </li>
                            <li><a href="./Tour.html"> <img src="./assets/images/icon02.svg"> Alexandria Day Tours</a>
                            </li>
                            <li><a href="./Tour.html"><img src="./assets/images/icon03.svg"> Makadi Bay Excursions</a>
                            </li>
                            <li><a href="./Tour.html"><img src="./assets/images/icon0.svg"> El Gouna Day Tours</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item mobile has-dropdown">
                        <a href="./SubCategory.html" class="nav-link">
                            Travel Packages
                            <span class="icon-down icon-down-one">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="mobile sub-menu">

                            <li><a href="./Tour.html"><img src="./assets/images/cruise-svgrepo-com.svg"> Egypt Nile
                                    Cruise
                                    Tours </a></li>
                            <li><a href="./Tour.html"> <img src="./assets/images/icon.svg3.svg">⁠Egypt
                                    Classical Tours</a></li>
                            <li><a href="./Tour.html"> <img src="./assets/images/Family.svg.svg"> ⁠Egypt
                                    Family Tours</a></li>
                            <li><a href="./Tour.html"> <img src="./assets/images/saicon.svg.svg"> Egypt Budget
                                    Packages
                                </a></li>
                        </ul>
                    </li>

                    <li class="nav-item mobile has-dropdown">
                        <a href="./SubCategory.html" class="nav-link">
                            Nile Cruises
                            <span class="icon-down icon-down-one">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="mobile sub-menu">
                            <li><a href="./Tour.html"><img src="./assets/images/icon.(3).svg"> Dahabiya Nile
                                    Cruise</a>
                            </li>
                            <li><a href="./Tour.html"> <img src="./assets/images/icon9.svg"> Luxor and Aswan Nile
                                    cruise</a></li>
                        </ul>
                    </li>

                    <li class="nav-item mobile has-dropdown">
                        <a href="./TravelStyle.html" class="nav-link">
                            Travel Style
                            <span class="icon-down icon-down-one">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="mobile sub-menu">
                            <li><a href="./Tour.html"><img src="./assets/images/icon12.svg">
                                    Family
                                    Tours</a></li>
                            <li><a href="./Tour.html"><img src="./assets/images/icon5.svg">
                                    Adventure
                                    Tours</a></li>
                        </ul>
                    </li>





                    <li class="nav-item mobile has-dropdown">
                        <span class="nav-link">
                            Pages
                            <span class="icon-down icon-down-one">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </span>

                        <ul class="mobile sub-menu">
                            <li><a href="./aboutUs.html"> <img src="./assets/images/icon09.svg">About Us</a></li>
                            <li><a href="./Blog.html"><img src="./assets/images/icon099.svg">Blogs</a></li>
                            <li><a href="./contact-us.html"> <img src="./assets/images/icon08).svg">Contact Us</a>
                            </li>
                            <li><a href="./transfer.html"><img src="./assets/images/Rent Car.svg">Rent Car</a></li>
                        </ul>
                    </li>

                    <div class="extra-nav mt-5">
                        <a href="tailorMade.html" class="theme-btn"><i class="fa-solid fa-arrow-right"></i>

                            Plan Your Trip
                        </a>

                    </div>
                </ul>
                <div class="extra-nav">
                    <div class="extra-cell">
                    </div>
                </div>
            </div>
            <div class="contact-side">
            </div>
        </div>
    </div>

    <div class="close-menu-sidebar backInUp"></div>
