@extends('themes.default.frontend.includes.master')

@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">الرئيسية</a>
                </li>
                <li class="active">عن عطاء</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <div class="page-content about-page">
        <div class="pattern">
            <img src="/assets/frontend/images/bg/pattern.svg" />
        </div>
        <div class="container">
            <div class="about-img">
                <img src="/assets/frontend/images/about/1.png" class="img-cover" />
            </div>
            <div class="about-features">
                <div class="about-feature">
                    <div class="page-head about_page-head">
                        <h2 class="page-title">السياسات</h2>
                    </div>
                    <p class="feature-desc">
                        تقديم العطاء بطريقة يسيرة ومباشرة مع متابعة وصوله الى المستفيد
                        المباشر
                    </p>
                </div>
                <div class="about-feature">
                    <div class="page-head about_page-head">
                        <h2 class="page-title">رؤيتنا</h2>
                    </div>
                    <p class="feature-desc">
                        تقديم حلول غير تقليدية لعمليات المنح، وتنمية قدرات الافراد، وتوفير
                        الدعم لمستحقيه من أجل مجتمع أفضل
                    </p>
                </div>
            </div>
            <div class="about-goals">
                <div class="page-head about_page-head">
                    <h2 class="page-title">أهدافنا</h2>
                </div>
                <div class="goals-list">
                    <div class="goal-item">
                        <div class="goal-content">
                            <span class="goal-number"> 1. </span>
                            <p class="goal-desc">
                                المساهمـــــــة في الدعــــــــم العينــــــــــي
                                للأســـــــــر والأفــــــراد والحـــــــــالات المحتاجــــة
                                بالتنسيــــــــق مــــع الجمعيــــــات المرخصـــــــــة
                                مـــــن الــــــــــوزارة
                            </p>
                        </div>
                    </div>
                    <div class="goal-item">
                        <div class="goal-content">
                            <span class="goal-number"> 2. </span>
                            <p class="goal-desc">
                                دعـــــــــم ورعايــــــــــة البرامــــــــــج
                                والمشروعــــــــــات التنمويـــــــــــــــة
                                والاجتماعيــــــــــــــة والتعليميــــــــــــــة
                                والصحيــــــــــة التـــــــــي تنفذهـــــــــــا
                                المؤسســــــــــــة
                            </p>
                        </div>
                    </div>
                    <div class="goal-item">
                        <div class="goal-content">
                            <span class="goal-number"> 3. </span>
                            <p class="goal-desc">
                                المساهمــة فــــي دعـم وتمويــــــل المشاريــــــــــع
                                والبرامـــج لدي الجمعيـــات الأهليــة المرخصــة
                                رسميــــــــــــا مــــن الــــــوزارة
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
