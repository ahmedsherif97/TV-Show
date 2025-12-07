@extends('themes.default.frontend.includes.master')

@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">الرئيسية</a>
                </li>
                <li class="active">آخر الأخبار</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <div class="page-content blog-page">
        <div class="pattern">
            <img src="/assets/frontend/images/bg/pattern.svg" />
        </div>
        <div class="container">
            <div class="blog_page-head">
                <div class="page-head">
                    <h1 class="page-title">آخر الأخبار</h1>
                    <p class="page-desc">
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                        هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                        العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                        التطبيق
                    </p>
                </div>
                <div class="blog-search">
                    <form>
                        <div class="search-form">
                            <input type="search" placeholder="بحث في الاخبار" class="search-input" />
                            <button class="search-btn">
                                <i class="las la-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="blog_page-content">
                <div class="blog-list">
                    @foreach ($news as $new)
                        <a href="{{ route('news.show', $new->id) }}" class="blog-item">
                            <div class="blog-img">
                                <img src="{{ $new->image }}" class="img-cover" />
                            </div>
                            <div class="blog-info">
                                <h3 class="blog-name">{{ $new->name }}</h3>
                                <span class="blog-date">
                                    <i class="las la-clock"></i>
                                    {{ \Illuminate\Support\Carbon::parse($new->date)->locale('ar')->dayName }}
                                    {{ $new->date }}
                                </span>
                                <p class="blog-summary">
                                    {{ $new->content }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $news->links('frontend.includes.paginator') }}
            </div>
        </div>
    </div>
@endsection
