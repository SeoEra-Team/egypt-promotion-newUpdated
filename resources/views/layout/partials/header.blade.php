 <nav class="nav-bar main-nav-bar">
     <div class="nav-output">
         <div class="bg-gray" itemscope itemtype="https://schema.org/Organization">
             <div class="container-fluid clearfix">
                 <div class="contact-boxes d-flex align-items-center justify-content-between">

                     <div class="col-lg-6 ">

                         <div class="h-100 d-inline-flex align-items-center me-4 nav_icon ">
                             <i class="fa-solid fa-phone-volume"></i>
                             <a href="tel:{{ nova_get_setting('site_phone') }}" class="text-nav text-dark"
                                 itemprop="telephone">
                                 <span>
                                     {{ nova_get_setting('site_phone') }}
                                 </span>
                             </a>
                         </div>



                         <div class="h-100 d-inline-flex align-items-center me-4 nav_icon">
                             <i class="fa-solid fa-envelope"></i>
                             <a href="mailto:{{ nova_get_setting('site_email') }}" class="text text-nav text-dark"
                                 itemprop="email">
                                 <span>{{ nova_get_setting('site_email') }}</span>
                             </a>
                         </div>



                         <div class="h-100 d-inline-flex align-items-center me-4 nav_icon" itemprop="address" itemscope
                             itemtype="https://schema.org/PostalAddress">
                             <i class="fa-solid fa-location-dot"></i>
                             <a href="{{ nova_get_setting('site_link_address') }}" class="text text-nav text-dark" target="_blank">
                                 <span itemprop="streetAddress">
                                     {{ nova_get_setting_translate('site_address') }}
                                 </span>,
                                 <span itemprop="addressLocality">
                                     {{ nova_get_setting_translate('site_city') }}
                                 </span>,
                                 <span itemprop="addressCountry">
                                     {{ nova_get_setting_translate('site_country') }}
                                 </span>
                             </a>
                         </div>
                     </div>

                     <div class="col-lg-6 ">
                         <div class="upper-navbar-right">

                             <ul class="upper___right">
                                 <li>
                                     <a href="{{ route('wishlist.index') }}">
                                         <span>
                                             <i class="fa-solid fa-heart me-"></i>
                                             {{ __('general.wishlist') }}
                                         </span>
                                     </a>
                                 </li>
                             </ul>

                             <!-- لغة -->
                             <div class="Language-box">
                                 <div class="dropdown" itemprop="availableLanguage" itemscope
                                     itemtype="https://schema.org/Language">
                                     <a class="p-2 dropdown-toggle lang-btn d-flex align-items-center gap-1"
                                         href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                         aria-expanded="false">
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
                                 <img loading="lazy" class="d-block logo-top"
                                     src="{{ Storage::url(nova_get_setting('logo')) }}" alt="TourVista-Logo">
                                 <img loading="lazy" class="d-none logo-scroll"
                                     src="{{ Storage::url(nova_get_setting('logo')) }}" alt="TourVista-Logo">
                             </a>
                         </div>

                     </div>

                     <div class="header-nav navbar-collapse collapse " id="navbarNavDropdown">

                         <ul class="nav navbar-nav navbar">
                             <li class=""><a href="{{ route('home') }}"><span>
                                         {{ __('general.home') }}
                                     </span></a></li>



                             @foreach ($headercategories as $category)
                                 <li>
                                     <a href="{{ route('tour.category', ['categorySlug' => $category->slug]) }}">
                                         <span>
                                             {{ $category->name }}
                                         </span>
                                         <i class="fa fa-chevron-down"></i>
                                     </a>

                                     <!-- dropdown container -->
                                     <div class="sub-menu deals-dropdown">
                                         <!-- left info -->
                                         <div class="ao-header-navigation__dropdown-info">
                                             <div class="ao-header-navigation__dropdown-info-title aa-heading-h4">
                                                 {{ $category->name }}
                                             </div>
                                             <p class="ao-header-navigation__dropdown-info-text">
                                                 {{ $category->short_description }}
                                             </p>
                                             <div class="bottom-area mt-3">

                                                 <a
                                                     href="{{ route('tour.category', ['categorySlug' => $category->slug]) }}">{{ __('general.view_all') }}
                                                     <span>
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                             height="12" viewBox="0 0 14 12" fill="none">
                                                             <path d="M2.07617 8.73272L12.1899 2.89355"
                                                                 stroke-linecap="round">
                                                             </path>
                                                             <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105"
                                                                 stroke-linecap="round"></path>
                                                         </svg>
                                                     </span>
                                                 </a>
                                             </div>
                                         </div>

                                         <!-- right links -->

                                         <div class=" mega__menu">
                                             <div class="menu_column">
                                                 <ul class=" deals-links">

                                                     @foreach ($category->children->where('status', 1) as $subCategory)
                                                         <li><a
                                                                 href="{{ route('tour.index', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}">
                                                                 <img
                                                                     src="{{ $subCategory->getFirstMediaUrlOrDefault('sub-category-sub-img', 'webp')['url'] }}">

                                                                 {{ $subCategory->name }}
                                                             </a>
                                                         </li>
                                                     @endforeach


                                                 </ul>
                                             </div>

                                         </div>
                                     </div>
                                 </li>
                             @endforeach

                             <li>
                                 <a href="{{ route('travel_styles.index') }}"><span>
                                         {{ nova_get_setting_translate('travel_style_title') }} </span><i
                                         class="fa fa-chevron-down"></i>
                                 </a>

                                 <!-- dropdown container -->
                                 <div class="sub-menu deals-dropdown">
                                     <!-- left info -->
                                     <div class="ao-header-navigation__dropdown-info">
                                         <div class="ao-header-navigation__dropdown-info-title aa-heading-h4">
                                             {{ nova_get_setting_translate('travel_style_title') }}
                                         </div>
                                         <p class="ao-header-navigation__dropdown-info-text">
                                             {{ nova_get_setting_translate('travel_style_short_description') }}
                                         </p>
                                         <div class="bottom-area mt-3">

                                             <a href="{{ route('travel_styles.index') }}">
                                                 {{ __('general.view_all') }}
                                                 <span>
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="12" viewBox="0 0 14 12" fill="none">
                                                         <path d="M2.07617 8.73272L12.1899 2.89355"
                                                             stroke-linecap="round">
                                                         </path>
                                                         <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105"
                                                             stroke-linecap="round"></path>
                                                     </svg>
                                                 </span>
                                             </a>
                                         </div>
                                     </div>

                                     <!-- right links -->

                                     <ul class=" deals-links">
                                         @foreach ($travelStyles as $travelStyle)
                                             <li>
                                                 <a
                                                     href="{{ route('travel_styles.travelStyle', $travelStyle->slug) }}">
                                                     <img
                                                         src="{{ $travelStyle->getFirstMediaUrlOrDefault(MediaHelper::TRAVEL_STYLE_ICON_MEDIA_PATH, 'webp')['url'] }}">
                                                     {{ $travelStyle->name }}
                                                 </a>
                                             </li>
                                         @endforeach


                                     </ul>

                                 </div>
                             </li>

                             <li>
                                 <span> {{ __('general.pages') }} <i class="fa fa-chevron-down"></i> </span>
                                 <ul class="sub-menu sub_menu">
                                     <li><a
                                             href="{{ route('about.index', nova_get_setting_translate('about_slug') ?? 'about-us') }}">
                                             <img src="{{ asset('assets/images/icon09.svg') }}">
                                             {{ __('general.about_us') }}
                                         </a></li>
                                     <li><a href="{{ route('blog.index') }}"> <img
                                                 src="{{ asset('assets/images/icon099.svg') }}">
                                             {{ __('general.blogs') }}
                                         </a></li>
                                     <li><a href="{{ route('contactus') }}"><img
                                                 src="{{ asset('assets/images/icon08).svg') }}">
                                             {{ __('general.contact_us') }}
                                         </a></li>
                                     <li>
                                         <a href="#"><img src="{{ asset('assets/images/RentCar.svg') }}">

                                             {{ __('general.rent_car') }}
                                         </a>
                                     </li>
                                 </ul>
                             </li>
                         </ul>
                         <div class="extra-nav  d-none d-sm-block">
                             <a href="{{ route('tailorMade') }}" class="theme-btn"><i
                                     class="fa-solid fa-arrow-right"></i>

                                 {{ __('general.plan_your_trip') }}
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
 {{-- mobile menu --}}
 <div class="side-menu">
     <a href="#" class="close-side-menu">
         <i class="fas fa-times"></i>
     </a>
     <div class="inner-side">
         <div class="menu-mobile">
             <a class="mobile-logo" href="{{ route('home') }}">
                 <img src="{{ Storage::url(nova_get_setting('logo')) }}" alt="logo">
             </a>
             <ul id="mobile-main-menu" class="mobile nav-menu">
                 <li class="mobile nav-item">
                     <a href="{{ route('home') }}" class="nav-link">
                         {{ __('general.home') }}
                     </a>
                 </li>
                 @foreach ($headercategories as $category)
                     <li class="nav-item mobile has-dropdown">
                         <a href="{{ route('tour.category', ['categorySlug' => $category->slug]) }}"
                             class="nav-link">
                             {{ $category->name }}
                             <span class="icon-down icon-down-one">
                                 <i class="fas fa-angle-down"></i>
                             </span>
                         </a>

                         <ul class="mobile sub-menu">
                             @foreach ($category->children as $subCategory)
                                 <li><a
                                         href="{{ route('tour.index', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}">
                                         <img
                                             src="{{ $subCategory->getFirstMediaUrlOrDefault('sub-category-sub-img', 'webp')['url'] }}">
                                         {{ $subCategory->name }}
                                     </a>
                                 </li>
                             @endforeach

                         </ul>
                     </li>
                 @endforeach

                 <li class="nav-item mobile has-dropdown">

                     <a href="{{ route('travel_styles.index') }}" class="nav-link">
                         {{ nova_get_setting_translate('travel_style_title') }}
                         <span class="icon-down icon-down-one">
                             <i class="fas fa-angle-down"></i>
                         </span>
                     </a>

                     <ul class="mobile sub-menu">
                         @foreach ($travelStyles as $travelStyle)
                             <li>

                                 <a href="{{ route('travel_styles.travelStyle', ['travelStyleSlug' => $travelStyle->slug]) }}">
                                    <img src="{{ $travelStyle->getFirstMediaUrlOrDefault(MediaHelper::TRAVEL_STYLE_MEDIA_PATH, 'webp')['url'] }}">
                                    {{ $travelStyle->name }}
                                 </a>
                             </li>
                         @endforeach
                     </ul>
                 </li>





                 <li class="nav-item mobile has-dropdown">
                     <span class="nav-link">
                         {{ __('general.pages') }}
                         <span class="icon-down icon-down-one">
                             <i class="fas fa-angle-down"></i>
                         </span>
                     </span>

                     <ul class="mobile sub-menu">
                         <li><a href=""> <img src="{{ asset('assets/images/icon09.svg') }}">
                                 {{ __('general.about_us') }}
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('blog.index') }}">
                                 <img src="{{ asset('assets/images/icon099.svg') }}">
                                 {{ __('general.blogs') }}
                             </a>
                         </li>

                         <li>
                             <a href="{{ route('contactus') }}"> <img src="{{ asset('assets/images/icon08).svg') }}">
                                 {{ __('general.contact_us') }}
                             </a>
                         </li>

                         <li><a href=""><img src="{{ asset('assets/images/RentCar.svg') }}"> {{ __('general.rent_car') }}</a></li>
                     </ul>
                 </li>

                 <div class="extra-nav mt-5">
                     <a href="" class="theme-btn"><i class="fa-solid fa-arrow-right"></i>

                         {{ __('general.plan_your_trip') }}
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
