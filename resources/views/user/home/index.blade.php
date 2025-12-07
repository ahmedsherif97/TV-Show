@extends('user.dashboard.layout')

@section('breadcrumb')
    @if(session('alert-danger'))
        <div class="alert alert-warning">{{session('alert-danger')}}</div>
    @endif
    <section
            class="w-full bg-white rounded-[20px] shadow-main-3 p-5 flex justify-between lg:items-end flex-col lg:flex-row gap-6">
        <div class="flex items-center gap-5">
            <!-- Celebration Cone Icon -->
            <div class="hidden">
                <img src="{{asset('front/assets/images/icons/cone.gif')}}" alt="cone"
                     class="size-[36px] max-w-max -mr-2">
            </div>

            <div class="flex flex-col gap-3">
                <h4 class="text-[22px] font-bold">مرحبًا، {{auth()->user()->name}}</h4>
                <p class="text-lg leading-7 font-normal">النجاح لمن يواصل الطريق! استمر في التعلم واقترب خطوة أخرى
                    من
                    تحقيق أهدافك بالحصول على الشهادة!</p>
            </div>
        </div>
        <div class="self-end">
            @if($nextLesson)
                <a href="{{route('student.lesson.show', $nextLesson->id)}}" class="btn-primary">واصل التعلم</a>
            @endif
            @if($nextTest)
                <a href="{{route('student.test.start', $nextTest->id)}}" class="btn-primary">واصل التعلم</a>
            @endif

        </div>
    </section>
@endsection

@section('content')
    <section class="w-full bg-white rounded-[20px] shadow-main-3">
        <div class="grid md:grid-cols-3 max-md:px-3 md:py-5 max-md:*:py-4 *:px-5 divide-y md:divide-y-0 divide-x-0 md:divide-x divide-primary-light">
            <div class="flex items-center gap-5">
                <div>
                    <div class="size-[50px] rounded-full bg-primary-light flex justify-center items-center">
                        <img src="{{asset('front/assets/images/icons/video_clip_2.svg')}}" alt="lecture">
                    </div>
                </div>
                <div class="flex flex-col gap-1.5">
                    <div class="flex items-baseline gap-1">
                        <p class="text-2xl leading-6">{{$finishedLessonsCount}}</p>
                        <span class="text-body-gray font-normal text-base">/ {{$allLessonsCount}}</span>
                    </div>
                    <div class="text-base font-normal">محاضرات مكتملة</div>
                </div>
            </div>

            <div class="flex items-center gap-5">
                <div>
                    <div class="size-[50px] rounded-full bg-primary-light flex justify-center items-center">
                        <img src="{{asset('front/assets/images/icons/table.svg')}}" alt="lecture">
                    </div>
                </div>
                <div class="flex flex-col gap-1.5">
                    <div class="flex items-baseline gap-1">
                        <p class="text-2xl leading-6">{{$finishedTestsCount}}</p>
                        <span class="text-body-gray font-normal text-base">/ {{$allTestsCount}}</span>
                    </div>
                    <div class="text-base font-normal">اختبارات مكتملة</div>
                </div>
            </div>

            <div class="flex items-center gap-5">
                <div>
                    <div class="size-[50px] rounded-full bg-primary-light flex justify-center items-center">
                        <img src="{{asset('front/assets/images/icons/book.svg')}}" alt="lecture">
                    </div>
                </div>
                <div class="flex flex-col gap-1.5">
                    <div class="flex items-baseline gap-1">
                        <p class="text-2xl leading-6">{{$finishedCoursesCount}}</p>
                        <span class="text-body-gray font-normal text-base">/ {{$allCoursesCount}}</span>
                    </div>
                    <div class="text-base font-normal">مواد مكتملة</div>
                </div>
            </div>
        </div>
    </section>

    <div class="flex flex-col items-start gap-5 xl:flex-row">
        <!-- Today's Lectures Section -->
        <section class="w-full xl:w-8/12 flex flex-col gap-6">
            <div class="w-full rounded-[20px] bg-white shadow-main-3">
                <div class="w-full flex justify-between gap-2 px-6 py-5 border-b border-b-primary-light">
                    <div class="text-xl">محاضرات اليوم</div>
                </div>
                <div class="flex flex-col gap-4 max-h-[360px] !p-5 overflow-auto custom-scrollbar">
                    <p class="text-body-gray font-normal text-center self-center m-auto hidden">لا يمكنك الوصول إلى
                        المحاضرات حتى يتم تفعيل حسابك. ترقب تواصل فريق الدعم قريبًا!</p>

                    <div class="w-full flex flex-col gap-4">
                        @foreach($groupedTodayLessons as $course)
                            <div>
                                <div class="badge-primary">{{$course['course']->name}}</div>
                            </div>
                            @foreach($course['lessons'] as $lesson)
                                <a href="#"
                                   class="flex justify-between gap-4 py-3 px-5 rounded-[20px] border border-primary-light transition hover:bg-primary-light-4">
                                    <div class="flex items-center gap-2 self-center">
                                        <img src="{{asset('front/assets/images/icons/check_circle.svg')}}"
                                             alt="check_circle" class="size-6">
                                        <div class="space-y-1.5">
                                            <h5 class="text-base">{{$lesson->name}}</h5>
                                            <h5 class="text-body-gray font-normal">{{$lesson->unit->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="size-4 min-w-4 [mask:url('/assets/images/icons/chevron_down.svg')_center_1rem] rotate-90 bg-body-color self-center"></div>
                                </a>

                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

        <!-- Achievements Section -->
        <section class="w-full xl:w-8/12 flex flex-col gap-6 hidden">
            <div class="w-full rounded-[20px] bg-white shadow-main-3">
                <div class="w-full flex justify-between gap-2 px-6 py-5 border-b border-b-primary-light">
                    <div class="text-xl">إنجازاتك</div>
                </div>
                <ul class="grid gap-x-5 gap-y-10 p-5 md:grid-cols-2 *:flex *:flex-col *:items-center *:gap-5 *:text-center">
                    <li>
                        <div>
                            <div class="badge-primary">الشهادة</div>
                        </div>
                        <div class="w-full rounded-[5px] bg-gray-200 overflow-hidden border border-primary-light">
                            <img src="{{asset('front/assets/images/certificate-preview.jpg')}}" alt="certificate"
                                 class="mx-auto">
                        </div>
                        <div>
                            <a href="#" class="btn-primary">
                                <img src="{{asset('front/assets/images/icons/arrow_download.svg')}}" alt="download"
                                     class="size-4">
                                <span>تحميل</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div class="badge-primary">الإجازة</div>
                        </div>
                        <div class="w-full rounded-[5px] bg-gray-200 overflow-hidden border border-primary-light">
                            <img src="{{asset('front/assets/images/certificate-preview.jpg')}}" alt="certificate"
                                 class="mx-auto">
                        </div>
                        <div>
                            <a href="#" class="btn-primary">
                                <img src="{{asset('front/assets/images/icons/arrow_download.svg')}}" alt="download"
                                     class="size-4">
                                <span>تحميل</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Leaderboard Section -->
        <section class="w-full xl:w-4/12 md:w-8/12 rounded-[20px] bg-white shadow-main-3 overflow-hidden">
            <div class="w-full flex justify-between gap-2 px-6 py-5 border-b border-b-primary-light">
                <div class="text-xl">أعلى 10 طلاب</div>
            </div>
            <div class="relative">
                <div class="h-[306px] flex items-center justify-center p-5 hidden">
                    <p class="text-body-gray font-normal text-center">لا يمكنك الوصول إلى قائمة الطلاب حتى يتم تفعيل
                        حسابك</p>
                </div>
                <div class="
                            flex flex-col gap-4 max-h-[306px] !p-5 overflow-y-auto custom-scrollbar *:py-2.5 *:px-5 *:rounded-[50px]
                            *:shadow-[0_0_0_1.5px_inset] *:shadow-primary-light
                            *:first:shadow-[#FEB957] *:first:bg-[#FEB957]/10
                            *:nth-[2]:shadow-[#9E9E9E] *:nth-[2]:bg-[#9E9E9E]/10
                            *:nth-[3]:shadow-[#CD7430] *:nth-[3]:bg-[#CD7430]/10">
                    <!-- Item -->

                    @foreach($students as $key => $student)
                        <div class="w-full flex justify-between items-center gap-4">
                            <div class="flex items-center gap-6">
                                <h6 class="text-lg">{{$key + 1}}</h6>
                                <div class="size-8 min-w-8 rounded-full overflow-hidden bg-gray-300">
                                    <img src="{{asset('assets/img/avatar.jpg')}}" alt="student first" class="">
                                </div>
                                <h6 class="text-base">{{$student['user']->name}}</h6>
                            </div>
                            <div class="text-primary font-bold">{{$student['percentage']}}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- User ranking -->
            <div class="w-full bg-white py-2.5 px-9 border-t border-t-primary-light">
                <div class="w-full flex justify-between items-center gap-4">
                    <div class="flex items-center gap-6">
                        <h6 class="text-lg">{{$currentStudent['rank']}}</h6>
                        <div class="size-8 min-w-8 rounded-full overflow-hidden bg-gray-300">
                            <img src="{{asset('assets/img/avatar.jpg')}}" alt="student first" class="">
                        </div>
                        <h6 class="text-base">أنت</h6>
                    </div>
                    <div class="text-primary font-bold">{{$currentStudent['percentage']}}</div>
                </div>
            </div>
        </section>
    </div>
@endsection