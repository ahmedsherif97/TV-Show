<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TV Show - البحث</title>

    <link rel="stylesheet" href="{{ asset('front/src/output.css') }}"/>
</head>
<body class="bg-white">

<div class="navbar border-b">
    <div class="navbar-wrapper">
        <div class="container z-[999]">
            <div class="relative flex items-center justify-between py-4">
                <div class="text-xl font-bold text-primary">
                    TV Show
                </div>

                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-4">
                        <a href="{{ route('home') }}" class="navbar-link">
                            الرئيسية
                        </a>

                        <form action="{{ route('user.search') }}" method="GET" class="flex items-center gap-2">
                            <input type="text" name="q" placeholder="ابحث عن حلقة أو برنامج"
                                   value="{{ $query }}"
                                   class="input-primary h-9 w-52 text-sm">
                            <button type="submit" class="btn-primary h-9 px-3 text-sm">
                                بحث
                            </button>
                        </form>

                        @if(isset($randomTvShows) && $randomTvShows->isNotEmpty())
                            <div class="flex items-center gap-3">
                                @foreach($randomTvShows as $show)
                                    <a href="{{ route('user.tv-shows.show', $show->slug) }}" class="navbar-link text-sm">
                                        {{ $show->title }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </nav>

                    <div class="hidden md:flex items-center gap-2">
                        @if(!auth('user')->check())
                            <a href="{{ route('user.login') }}"
                               class="btn-primary bg-white text-primary border border-primary hover:bg-primary-light-2">
                                تسجيل الدخول
                            </a>

                            <a href="{{ route('user.register') }}"
                               class="btn-primary hover:bg-primary/90">
                                انضم إلينا
                            </a>
                        @else
                            <a href="{{ route('user.logout') }}"
                               class="btn-primary hover:bg-primary/90">
                                تسجيل الخروج
                            </a>
                        @endif
                    </div>

                    <button id="navbarToggler" class="md:hidden flex flex-col gap-1">
                        <span class="w-6 h-[2px] bg-black"></span>
                        <span class="w-6 h-[2px] bg-black"></span>
                        <span class="w-6 h-[2px] bg-black"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="py-10">
    <div class="container space-y-10">

        <section>
            <h1 class="text-2xl font-bold mb-4">نتائج البحث</h1>

            @if($query === '')
                <p class="text-gray-500 text-sm">اكتب كلمة للبحث عن الحلقات أو البرامج.</p>
            @else
                @if($tvShows->isEmpty() && $episodes->isEmpty())
                    <p class="text-gray-500 text-sm">لا توجد نتائج لـ "{{ $query }}".</p>
                @endif
            @endif
        </section>

        @if($tvShows->isNotEmpty())
            <section class="space-y-3">
                <h2 class="text-xl font-semibold">البرامج / المسلسلات</h2>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($tvShows as $show)
                        <a href="{{ route('user.tv-shows.show', $show->slug) }}"
                           class="block bg-white rounded-xl shadow-sm hover:shadow-md transition p-4">
                            <h3 class="text-lg font-semibold mb-1">
                                {{ $show->title }}
                            </h3>
                            @if($show->description)
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $show->description }}
                                </p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        @if($episodes->isNotEmpty())
            <section class="space-y-3">
                <h2 class="text-xl font-semibold">الحلقات</h2>

                <div class="grid gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($episodes as $episode)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                            <div class="aspect-video bg-gray-200">
                                <img
                                        src="{{ $episode->thumbnail ?? asset('front/assets/images/episode-placeholder.jpg') }}"
                                        alt="{{ $episode->title }}"
                                        class="w-full h-full object-cover">
                            </div>
                            <div class="p-3 flex-1 flex flex-col gap-1">
                                <p class="text-xs text-gray-400">
                                    {{ $episode->tvShow?->title }}
                                </p>
                                <h3 class="text-sm font-semibold line-clamp-2">
                                    {{ $episode->title }}
                                </h3>

                                @if($episode->airing_at)
                                    <p class="text-xs text-gray-500">
                                        موعد العرض: {{ \Carbon\Carbon::parse($episode->airing_at)->format('Y-m-d H:i') }}
                                    </p>
                                @endif

                                <div class="mt-2">
                                    @if(auth('user')->check())
                                        <a href="{{ route('user.episodes.show', $episode->slug) }}"
                                           class="btn-primary w-full text-center text-sm">
                                            مشاهدة الحلقة
                                        </a>
                                    @else
                                        <a href="{{ route('user.login') }}"
                                           class="btn-primary w-full text-center text-sm">
                                            سجل الدخول لمشاهدة الحلقة
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</main>

<script src="{{ asset('front/assets/js/main.js') }}"></script>
</body>
</html>
