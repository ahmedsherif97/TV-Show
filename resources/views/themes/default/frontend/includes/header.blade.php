<header class="header-section">
    <div class="container">
        <div class="header">
            <a href="{{url('/')}}" class="logo">
                <img src="/assets/frontend/images/logo.svg" alt="logo" class="img-contain" />
            </a>
            <div class="header-content">
                <ul class="header-links">
                    <li>
                        <a href="{{route('partner.registration')}}">حساب جديد</a>
                    </li>
                    <li>
                        <a href="{{route('admin.login')}}">تسجيل الدخول</a>
                    </li>
                </ul>
                <div class="header-tools">
                    <div class="search-form">
                        <input
                                type="search"
                                placeholder="ابحث هنا"
                                class="search-input"
                        />
                        <button class="search-btn">
                            <i class="las la-search"></i>
                        </button>
                    </div>
                    <div class="socials">
                        <a href="tel:+9660505426859">
                            <i class="las la-phone-volume"></i>
                        </a>
                        <a href="#!" target="_blank">
                            <i class="lab la-facebook"></i>
                        </a>
                        <a href="#!" target="_blank">
                            <i class="lab la-twitter"></i>
                        </a>
                        <a href="#!" target="_blank">
                            <i class="lab la-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mobile-tools">
                <button class="header-icon search-trigger">
                    <i class="las la-search"></i>
                </button>
                <button class="header-icon menu-btn">
                    <i class="las la-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<div class="overlay"></div>
<nav class="header-nav">
    <div class="nav-content">
        <div class="nav-head">
            <div class="nav_header-links">
                <ul class="header-links">
                    <li>
                        <a href="{{route('partner.registration')}}">حساب جديد</a>
                    </li>
                    <li>
                        <a href="{{route('admin.login')}}">تسجيل الدخول</a>
                    </li>
                </ul>
            </div>
            <button class="close-btn">
                <i class="las la-times"></i>
            </button>
        </div>
        <ul class="header-list">
            <li>
                <a href="{{url('/')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
            </li>
            <li>
                <a href="{{route('about')}}" class="{{ request()->routeIs('about') ? 'active' : '' }}">عن عطاء</a>
            </li>
            <li>
                <a href="{{route('workflow')}}" class="{{ request()->routeIs('workflow') ? 'active' : '' }}">المسارات</a>
            </li>
            <li>
                <a href="{{route('transparency')}}" class="{{ request()->routeIs('transparency') ? 'active' : '' }}">الشفافية والحوكمة</a>
            </li>
            <li>
                <a href="{{route('policy')}}" class="{{ request()->routeIs('policy') ? 'active' : '' }}">السياسات واللوائح</a>
            </li>
{{--            <li>--}}
{{--                <a href="projects.html" class="{{ request()->routeIs('home') ? 'active' : '' }}">المشاريع</a>--}}
{{--            </li>--}}
            <li>
                <a href="{{route('news')}}" class="{{ request()->routeIs('news') ? 'active' : '' }}">الاخبار</a>
            </li>
            <li>
                <a href="{{route('contactUs')}}" class="{{ request()->routeIs('contactUs') ? 'active' : '' }}">تواصل معنا</a>
            </li>
        </ul>
        <div class="nav-foot">
            <div class="socials">
                <a href="tel:+9660505426859">
                    <i class="las la-phone-volume"></i>
                </a>
                <a href="#!" target="_blank">
                    <i class="lab la-facebook"></i>
                </a>
                <a href="#!" target="_blank">
                    <i class="lab la-twitter"></i>
                </a>
                <a href="#!" target="_blank">
                    <i class="lab la-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</nav>