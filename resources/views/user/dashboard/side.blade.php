<aside class="sidebar-nav">
    <nav class="h-full flex flex-col bg-white">
        <div class="flex justify-between items-center">
            <button type="button" id="toggleSidebarBtn" onclick="toggleSidebar()" class="lg:!hidden max-lg:mr-4">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                     aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="lg:mx-auto">
                <a href="{{ route('student.dashboard') }}" class="p-4 flex justify-center items-center">
                    <img src="{{ asset('front/assets/images/logo/logo.png') }}" alt="logo"
                         class="min-w-[64px] size-[64px]"/>
                </a>
            </div>
        </div>

        <!-- Sidebar links -->
        <div class="sidebar-links custom-scrollbar">

            <a href="{{ route('student.dashboard') }}"
               class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }} group/sidenav"
               title="لوحتي التعليمية">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/home.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/home.svg') }}');"></div>
                </div>
                <span class="link-text">لوحتي التعليمية</span>
            </a>

            <a href="{{ route('student.courses') }}"
               class="group/sidenav {{ request()->routeIs('student.courses') ? 'active' : '' }}" title="المواد">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/book.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/book.svg') }}');"></div>
                </div>
                <span class="link-text">المواد</span>
            </a>

            <a href="{{ route('student.lesson.schedule') }}"
               class="group/sidenav {{ request()->routeIs('student.lesson.schedule') ? 'active' : '' }}"
               title="الجدول الدراسي">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/calendar.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/calendar.svg') }}');"></div>
                </div>
                <span class="link-text">الجدول الدراسي</span>
            </a>

            <a href="{{route('student.tests.index')}}" class="group/sidenav {{ request()->routeIs('student.tests.index') ? 'active' : '' }}" title="الاختبارات">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/clipboard_task.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/clipboard_task.svg') }}');"></div>
                </div>
                <span class="link-text">الاختبارات</span>
            </a>
            {{--            @if(auth('student')->user()->certification || auth('student')->user()->pass_file)--}}
            <a href="{{route('student.certificate.index')}}" class="group/sidenav {{ request()->routeIs('student.certificate.index') ? 'active' : '' }}" title="الاختبارات">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/clipboard_task.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/clipboard_task.svg') }}');"></div>
                </div>
                <span class="link-text">الشهادات</span>
            </a>
            {{--            @endif--}}
            <a href="{{ route('student.bank-question.index') }}"
               class="group/sidenav {{ request()->routeIs('student.bank-question.index') ? 'active' : '' }}"
               title="بنك الأسئلة">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/book_question.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/book_question.svg') }}');"></div>
                </div>
                <span class="link-text">بنك الأسئلة</span>
            </a>

            <a href="{{ route('student.faq.index') }}"
               class="group/sidenav {{ request()->routeIs('student.faq.index') ? 'active' : '' }}"
               title="الدعم والمساعدة">
                <div class="icon-wrapper">
                    <div class="nav-icon"
                         style="mask: url('{{ asset('front/assets/images/icons/sidenav/chat_bubbles.svg') }}'); -webkit-mask: url('{{ asset('front/assets/images/icons/sidenav/chat_bubbles.svg') }}');"></div>
                </div>
                <span class="link-text">الدعم والمساعدة</span>
            </a>

        </div>
    </nav>
</aside>
