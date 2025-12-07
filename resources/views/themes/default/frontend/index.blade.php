@extends('themes.default.frontend.includes.master')

@section('content')
    <!-- Start Main -->
    <main class="main-section">
        <div class="container">
            <div class="main-content">
                <div class="main-slider">
                    <div class="slider-content">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($sliders as $slider)
                                    <div class="swiper-slide">
                                        <div class="main-slide">
                                            <img src="{{ $slider->image }}" class="img-cover" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-btn-prev swiper-btn">
                            <i class="las la-angle-left"></i>
                        </div>
                        <div class="swiper-btn-next swiper-btn">
                            <i class="las la-angle-right"></i>
                        </div>
                    </div>
                    <div class="slider-pagination"></div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->

    <section class="statistics-section">
        <div class="container">
            <div class="statistics-content">
                <div class="section-head">
                    <h2 class="section-title">عطاء بالأرقام</h2>
                </div>
                <div class="statistics-items">
                    <div class="statistics-item">
                        <span class="item-icon">
                            <i class="las la-users"></i>
                        </span>
                        <strong class="item-value">
                            <span data-count="4.52">452</span>
                        </strong>
                        <span class="item-title">مليون مستفيد</span>
                    </div>
                    <div class="statistics-item">
                        <span class="item-icon">
                            <i class="las la-users"></i>
                        </span>
                        <strong class="item-value">
                            <span data-count="4.52">452</span>
                        </strong>
                        <span class="item-title">مليون مستفيد</span>
                    </div>
                    <div class="statistics-item">
                        <span class="item-icon">
                            <i class="las la-users"></i>
                        </span>
                        <strong class="item-value">
                            <span data-count="4.52">452</span>
                        </strong>
                        <span class="item-title">مليون مستفيد</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Blog -->
    <section class="blog-section">
        <div class="container">
            <div class="blog-content">
                <div class="section-head">
                    <h2 class="section-title">اخر الاخبار</h2>
                </div>
                <div class="blog-slider">
                    <div class="slider-content">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($news as $new)
                                    <div class="swiper-slide">
                                        <a href="{{ route('news.show', $new->id) }}" class="blog-item">
                                            <div class="blog-img">
                                                <img src="{{ $new->image }}" class="img-cover" />
                                            </div>
                                            <div class="blog-info">
                                                <h3 class="blog-name">{{ $new->name }}</h3>
                                                <span class="blog-date">
                                                    <i class="las la-clock"></i>
                                                    {{ $new->date . ' ' . \Carbon\Carbon::parse($new->date)->locale('ar')->dayName }}
                                                </span>
                                                <p class="blog-summary">
                                                    {{ $new->content }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-btn-prev swiper-btn">
                            <i class="las la-angle-left"></i>
                        </div>
                        <div class="swiper-btn-next swiper-btn">
                            <i class="las la-angle-right"></i>
                        </div>
                    </div>
                    <div class="slider-pagination"></div>
                </div>
                <a href="{{ route('news') }}" class="section-btn default-btn second-btn">
                    جميع الاخبار
                </a>
            </div>
        </div>
    </section>

    <!-- End Blog -->

    <!-- Start Contact -->
    <section class="contact-section">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">راسلنا الان</h2>
            </div>
            <div class="contact-form">
                <form>
                    <div class="form-content">
                        <div class="form-group">
                            <label class="form-label"> الاسم </label>
                            <input type="text" class="form-control" placeholder="الاسم" />
                        </div>
                        <div class="form-group">
                            <label class="form-label"> البريد الالكتروني </label>
                            <input type="email" class="form-control" placeholder="example@gmail.com" />
                        </div>
                        <div class="form-group full-w">
                            <label class="form-label"> رقم الجوال </label>
                            <input type="tel" class="form-control" placeholder="مثال : +966 000 000 0055" />
                        </div>
                        <div class="form-group full-w">
                            <label class="form-label"> عنوان الرسالة </label>
                            <input type="text" class="form-control" placeholder="مثال: خاص بالتبرعات" />
                        </div>
                        <div class="form-group full-w">
                            <label class="form-label"> الرسالة </label>
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                    <!-- <button type="submit" class="submit-btn default-btn">ارسال</button> -->
                    <button class="submit-btn default-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#successModal">
                        ارسال
                    </button>
                </form>
            </div>
        </div>
    </section>
    <!-- End Contact -->
@endsection
