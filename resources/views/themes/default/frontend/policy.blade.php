@extends('themes.default.frontend.includes.master')

@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">الرئيسية</a>
                </li>
                <li class="active">السياسات واللوائح</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <div class="page-content policies-page">
        <div class="pattern">
            <img src="/assets/frontend/images/bg/pattern.svg" />
        </div>
        <div class="container">
            <div class="page-head policies_page-head">
                <h1 class="page-title">السياسات</h1>
            </div>
            <div class="policies_page-content">
                <div class="policies-grid">
                    <a href="#!" download class="policy-item">
                        <img src="/assets/frontend/images/policies/1.png" class="img-cover" />
                        <div class="item-logo">
                            <img src="/assets/frontend/images/logo.svg" class="img-contain" />
                        </div>
                        <span class="item-title"> دليـــل الحوكمــــة </span>
                        <span class="item-btn">تحميل</span>
                    </a>
                    <a href="#!" download class="policy-item">
                        <img src="/assets/frontend/images/policies/1.png" class="img-cover" />
                        <div class="item-logo">
                            <img src="/assets/frontend/images/logo.svg" class="img-contain" />
                        </div>
                        <span class="item-title"> دليـــل الحوكمــــة </span>
                        <span class="item-btn">تحميل</span>
                    </a>
                    <a href="#!" download class="policy-item">
                        <img src="/assets/frontend/images/policies/1.png" class="img-cover" />
                        <div class="item-logo">
                            <img src="/assets/frontend/images/logo.svg" class="img-contain" />
                        </div>
                        <span class="item-title"> دليـــل الحوكمــــة </span>
                        <span class="item-btn">تحميل</span>
                    </a>
                    <a href="#!" download class="policy-item">
                        <img src="/assets/frontend/images/policies/1.png" class="img-cover" />
                        <div class="item-logo">
                            <img src="/assets/frontend/images/logo.svg" class="img-contain" />
                        </div>
                        <span class="item-title"> دليـــل الحوكمــــة </span>
                        <span class="item-btn">تحميل</span>
                    </a>
                    <a href="#!" download class="policy-item">
                        <img src="/assets/frontend/images/policies/1.png" class="img-cover" />
                        <div class="item-logo">
                            <img src="/assets/frontend/images/logo.svg" class="img-contain" />
                        </div>
                        <span class="item-title"> دليـــل الحوكمــــة </span>
                        <span class="item-btn">تحميل</span>
                    </a>
                    <a href="#!" download class="policy-item">
                        <img src="/assets/frontend/images/policies/1.png" class="img-cover" />
                        <div class="item-logo">
                            <img src="/assets/frontend/images/logo.svg" class="img-contain" />
                        </div>
                        <span class="item-title"> دليـــل الحوكمــــة </span>
                        <span class="item-btn">تحميل</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
