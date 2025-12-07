<header class="nav-header">
    <div class="nav-header-wrapper">
        <div class="flex gap-4">
            <!-- Sidebar Toggle Button -->
            <div>
                <button type="button" id="toggleSidebarBtn" onclick="toggleSidebar()">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                         aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>

        <div class="flex items-center gap-4">
            <!-- Telegram Channels dropdown -->
            <div class="relative">
                <button onclick="toggleDropdown(this)" class="dropdown activable">
                    <i class="fab fa-telegram-plane text-2xl"></i>
                </button>
                <ul id="telegram" class="dropdown-menu whitespace-nowrap left-2.5 mt-2 space-y-1.5 shadow-main-sm shadow-black/6 hidden">
                    <li>
                        <a href="https://t.me/tlogaui" target="_blank" class="hover:text-primary">
                            <span>قناة البرنامج</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://t.me/tlogaui" target="_blank" class="hover:text-primary">
                            <span>مجموعة الذكور</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Notifications -->
{{--            <div class="dropdown-wrapper relative inline-block flex-grow">--}}
{{--                <button onclick="toggleDropdown(this)" class="dropdown activable" title="الإشعارات">--}}
{{--                    <i class="fas fa-bell fa-lg"></i>--}}
{{--                    <div class="notification-number">--}}
{{--                        <span>3</span>--}}
{{--                    </div>--}}
{{--                </button>--}}
{{--                <ul id="notifications" class="dropdown-menu !w-[280px] overflow-hidden text-sm left-0 max-sm:-left-10 mt-2 !py-0 shadow-main-sm shadow-black/6 divide-y divide-primary-light *:hover:bg-primary-light-4 hidden">--}}
{{--                    <li>--}}
{{--                        <a href="/dashboard/exam-result.html" class="flex-col !items-start gap-1 !pl-8 !pt-3 relative">--}}
{{--                            <h5 class="font-bold whitespace-normal">تهانينا! نتائج الاختبار النهائي متاحة الآن</h5>--}}
{{--                            <span class="font-normal whitespace-normal">هيا تحقق من نتائجك وقم بتنزيل شهادتك</span>--}}
{{--                            <span class="text-xs text-body-gray font-normal">20/6/2024 - 10:00 م</span>--}}
{{--                            <!-- Unread dot -->--}}
{{--                            <span class="size-[8px] rounded-full bg-primary absolute top-4 left-4"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="/dashboard/lessons-exam-start.html" class="flex-col !items-start gap-1 !pl-8 !pt-3 relative">--}}
{{--                            <h5 class="font-bold whitespace-normal">لديك اختبار بانتظارك!</h5>--}}
{{--                            <span class="font-normal whitespace-normal">خذ لحظة لاختبار مستواك واستمر في التقدم الرائع</span>--}}
{{--                            <span class="text-xs text-body-gray font-normal">20/6/2024 - 10:00 م</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="/dashboard/questions-bank-post.html" class="flex-col !items-start gap-1 !pl-8 !pt-3 relative">--}}
{{--                            <h5 class="font-bold whitespace-normal">رد جديد</h5>--}}
{{--                            <span class="font-normal whitespace-normal">قام "اسم الطالب" بالرد على سؤالك</span>--}}
{{--                            <span class="text-xs text-body-gray font-normal">20/6/2024 - 10:00 م</span>--}}
{{--                            <span class="size-[8px] rounded-full bg-primary absolute top-4 left-4"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="/dashboard/questions-bank-post.html" class="flex-col !items-start gap-1 !pl-8 !pt-3 relative">--}}
{{--                            <h5 class="font-bold whitespace-normal">رد جديد</h5>--}}
{{--                            <span class="font-normal whitespace-normal">قام "اسم الطالب" بالرد على سؤالك</span>--}}
{{--                            <span class="text-xs text-body-gray font-normal">20/6/2024 - 10:00 م</span>--}}
{{--                            <span class="size-[8px] rounded-full bg-primary absolute top-4 left-4"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="bg-primary-light hover:!bg-primary-light-2">--}}
{{--                        <a href="/dashboard/notifications.html" class="text-primary text-base justify-center">--}}
{{--                            عرض جميع الإشعارات--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}

            <!-- Profile dropdown -->
            <div class="relative">
                <button onclick="toggleDropdown(this)" class="dropdown activable">
                    <i class="fas fa-user fa-lg"></i>
                    <!--<div class="size-6 [mask:url('/assets/images/icons/person.svg')] bg-gray-300"></div>-->
                </button>
                <ul id="profile" class="dropdown-menu !w-[220px] left-2.5 mt-2 space-y-1.5 shadow-main-sm shadow-black/6 hidden">
                    <li>
                        <a href="{{route('student.profile')}}" class="flex items-center gap-2">
                            <img src="{{asset('front/assets/images/icons/settings.svg')}}" alt="settings">
                            <span>إعدادات الحساب</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('student.logout')}}" class="flex items-center gap-2">
                            <img src="{{asset('front/assets/images/icons/logout.svg')}}" alt="logout">
                            <span>تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
