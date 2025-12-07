@extends('themes.default.frontend.includes.master')

@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">الرئيسية</a>
                </li>
                <li class="active">الشفافية والحوكمة</li>
            </ol>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <div class="page-content governance-page">
        <div class="pattern">
            <img src="/assets/frontend/images/bg/pattern.svg" />
        </div>
        <div class="container">
            <div class="page-head governance_page-head">
                <h2 class="page-title">مجلس الأمناء</h2>
            </div>
            <div class="board-items">
                <div class="board-member">
                    <div class="member-img">
                        <img src="/assets/frontend/images/governance/1.jpg" class="img-cover" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">الأستاذ/ محمد</h3>
                        <span class="member-job">رئيس</span>
                    </div>
                </div>
                <div class="board-member">
                    <div class="member-img">
                        <img src="/assets/frontend/images/governance/1.jpg" class="img-cover" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">الأستاذ/ محمد</h3>
                        <span class="member-job">رئيس</span>
                    </div>
                </div>
                <div class="board-member">
                    <div class="member-img">
                        <img src="/assets/frontend/images/governance/1.jpg" class="img-cover" />
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">الأستاذ/ محمد</h3>
                        <span class="member-job">رئيس</span>
                    </div>
                </div>
            </div>
            <div class="page-head governance_page-head">
                <h2 class="page-title">تقارير عام 2024</h2>
            </div>
            <div class="reports-items">
                <div class="report-item">
                    <a href="#!" class="report-link"> التقرير السنوي </a>
                </div>
                <div class="report-item">
                    <a href="#!" class="report-link"> التقرير المالي </a>
                </div>
            </div>
        </div>
    </div>
@endsection
