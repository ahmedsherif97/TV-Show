<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $tvShow->title }} - TV Show</title>

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
                                   value="{{ request('q') }}"
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
        <section class="space-y-4">
            <h2 class="text-2xl font-semibold">الحلقات</h2>

            @if($episodes->isEmpty())
                <p class="text-gray-500 text-sm">لا توجد حلقات لهذا البرنامج حتى الآن.</p>
            @else
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
                                <h3 class="text-sm font-semibold line-clamp-2">
                                    {{ $episode->title }}
                                </h3>

                                @if($episode->airing_at)
                                    <p class="text-xs text-gray-500">
                                        موعد العرض: {{ \Carbon\Carbon::parse($episode->airing_at)->format('Y-m-d H:i') }}
                                    </p>
                                @endif

                                <p class="text-xs text-gray-500">
                                    المدة: {{ gmdate('H:i:s', $episode->duration_seconds) }}
                                </p>

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
            @endif
        </section>
        <section class="flex flex-col md:flex-row justify-between gap-6">
            <div class="space-y-3">
                <h1 class="text-3xl font-bold">{{ $tvShow->title }}</h1>

                @if($tvShow->description)
                    <p class="text-sm text-gray-700 leading-relaxed">
                        {{ $tvShow->description }}
                    </p>
                @endif
            </div>

            <div class="flex flex-col items-start gap-3">
                @if(auth('user')->check())
                    <button id="followToggleBtn"
                            data-show-id="{{ $tvShow->id }}"
                            class="btn-primary px-5 py-2 text-sm"
                            type="button">
                        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                    </button>
                @else
                    <a href="{{ route('user.login') }}"
                       class="btn-primary px-5 py-2 text-sm">
                        Login to follow
                    </a>
                @endif
            </div>
        </section>

    </div>
</main>

<script>
    document.getElementById('followToggleBtn')?.addEventListener('click', function () {
        const btn = this
        const tvShowId = btn.dataset.showId
        const url = '{{route('user.user.tv-shows.follow-toggle', ':id')}}'.replace(':id', tvShowId)
        const originalText = btn.textContent.trim()

        btn.disabled = true
        btn.textContent = 'Loading...'

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
            .then(res => res.json())
            .then(data => {
                btn.textContent = data.following ? 'Unfollow' : 'Follow'
            })
            .catch(() => {
                btn.textContent = originalText
            })
            .finally(() => {
                btn.disabled = false
            });
    });
</script>

<script src="{{ asset('front/assets/js/main.js') }}"></script>
</body>
</html>
