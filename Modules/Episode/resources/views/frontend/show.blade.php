<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TV Show</title>

    <link rel="stylesheet" href="{{ asset('front/src/output.css') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-white">

{{-- Top Navbar --}}
<div class="navbar border-b bg-white/95 backdrop-blur">
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
                                    <a href="{{ route('user.tv-shows.show', $show->slug) }}"
                                       class="navbar-link text-sm">
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
<main class="pt-32 md:pt-40 pb-10">
    <div class="container space-y-8" style="position: relative; top: 100px">
        {{-- Video + description + reactions --}}
        <section class="mx-auto max-w-4xl space-y-6">
            <div class="rounded-xl overflow-hidden bg-black shadow-md mx-auto max-w-2xl" style="width: 80% !important;">
                <video
                        controls
                        style="
            width: 100% !important;
            height: 360px !important;
            max-height: 360px !important;
            object-fit: contain !important;
            background: #000 !important;
        "
                >
                    <source src="{{ $episode->video }}" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>

            {{-- Description --}}
            @if($episode->description)
                <p class="text-gray-700 leading-relaxed">
                    {{ $episode->description }}
                </p>
            @endif


            {{-- Episode info header --}}
            <section class="space-y-3 border-b pb-4">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="space-y-1">
                        <h1 class="text-2xl md:text-3xl font-bold">
                            {{ $episode->title }}
                        </h1>

                        @if($episode->tvShow)
                            <a
                                    href="{{ route('user.tv-shows.show', $episode->tvShow->slug) }}"
                                    class="text-sm text-primary underline"
                            >
                                {{ $episode->tvShow->title }}
                            </a>
                        @endif
                    </div>

                    <div class="text-sm text-gray-600 text-right md:text-left space-y-1">
                        @if($episode->airing_at)
                            <p>
                                Airing at:
                                {{ \Carbon\Carbon::parse($episode->airing_at)->format('Y-m-d H:i') }}
                            </p>
                        @endif

                        <p>
                            Duration:
                            {{ $episode->duration_seconds ? gmdate('H:i:s', $episode->duration_seconds) : '—' }}
                        </p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 pt-2">
                        <button
                                id="likeBtn"
                                type="button"
                                data-id="{{ $episode->id }}"
                                class="px-5 py-2 rounded-full text-sm border flex items-center gap-2 transition
                           {{ $isLiked ? 'bg-blue-500 border-blue-500 text-white' : 'bg-white border-gray-300 text-gray-700' }}"
                                aria-pressed="{{ $isLiked ? 'true' : 'false' }}"
                        >
                            <span class="text-lg">👍</span>
                            <span>Like</span>
                        </button>

                        <button
                                id="dislikeBtn"
                                type="button"
                                data-id="{{ $episode->id }}"
                                class="px-5 py-2 rounded-full text-sm border flex items-center gap-2 transition
                           {{ $isDisliked ? 'bg-red-500 border-red-500 text-white' : 'bg-white border-gray-300 text-gray-700' }}"
                                aria-pressed="{{ $isDisliked ? 'true' : 'false' }}"
                        >
                            <span class="text-lg">👎</span>
                            <span>Dislike</span>
                        </button>
                    </div>

                </div>
            </section>

        </section>

    </div>
</main>

<script>
    const likeBtn = document.getElementById('likeBtn');
    const dislikeBtn = document.getElementById('dislikeBtn');
    let isProcessingReaction = false;

    function updateButtons(liked, disliked) {
        if (!likeBtn || !dislikeBtn) return;

        // Like button state
        likeBtn.classList.toggle('bg-blue-500', liked);
        likeBtn.classList.toggle('border-blue-500', liked);
        likeBtn.classList.toggle('text-white', liked);
        likeBtn.classList.toggle('bg-white', !liked);
        likeBtn.classList.toggle('border-gray-300', !liked);
        likeBtn.classList.toggle('text-gray-700', !liked);
        likeBtn.setAttribute('aria-pressed', liked ? 'true' : 'false');

        // Dislike button state
        dislikeBtn.classList.toggle('bg-red-500', disliked);
        dislikeBtn.classList.toggle('border-red-500', disliked);
        dislikeBtn.classList.toggle('text-white', disliked);
        dislikeBtn.classList.toggle('bg-white', !disliked);
        dislikeBtn.classList.toggle('border-gray-300', !disliked);
        dislikeBtn.classList.toggle('text-gray-700', !disliked);
        dislikeBtn.setAttribute('aria-pressed', disliked ? 'true' : 'false');
    }

    function sendReaction(epId, type) {
        if (isProcessingReaction) return;
        isProcessingReaction = true;

        let url = '{{ route('user.user.episodes.like-toggle', ':id') }}'.replace(':id', epId);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({type})
        })
            .then((res) => {
                if (!res.ok) {
                    throw new Error('Request failed');
                }
                return res.json();
            })
            .then((data) => {
                if (
                    typeof data.liked !== 'undefined' &&
                    typeof data.disliked !== 'undefined'
                ) {
                    updateButtons(data.liked, data.disliked);
                }
            })
            .catch((error) => {
                console.error('Reaction error:', error);
            })
            .finally(() => {
                isProcessingReaction = false;
            });
    }

    likeBtn?.addEventListener('click', () => {
        const id = likeBtn.dataset.id;
        sendReaction(id, 'like');
    });

    dislikeBtn?.addEventListener('click', () => {
        const id = dislikeBtn.dataset.id;
        sendReaction(id, 'dislike');
    });
</script>

</body>
</html>
