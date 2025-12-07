<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="التسجيل - برنامج التأهيل اللغوي"/>
    <meta name="keywords" content="keyword 1, keyword 2, keyword 3"/>
    <meta name="language" content="Arabic">
    <title>
        TV Show
    </title>

    <link rel="apple-touch-icon" href="{{asset('front/assets/images/favicon/apple-touch-icon.png')}}"><!-- 180×180 -->
    <link rel="manifest" href="{{asset('front/assets/images/site.webmanifest')}}">

    <link rel="stylesheet" href="{{asset('front/src/output.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>

<body class="relative">
<img class="absolute top-0 left-0 size-full -z-[9]" src="{{asset('front/assets/images/header/islamic-vector-2.png')}}"
     alt="Background Image"/>
<img class="absolute top-0 left-0 size-full -z-10" src="{{asset('front/assets/images/header/gradient.png')}}"
     alt="Background Image"/>
<div class="lg:[direction:ltr] lg:h-[100dvh] lg:overflow-y-auto">
    <div class="lg:[direction:rtl] container min-h-[100vh] flex flex-col lg:flex-row lg:gap-20">
        <div class="w-full lg:w-1/2 flex flex-col justify-between gap-10 py-10 lg:h-[100dvh] lg:sticky lg:top-0">
            <div class="space-y-10">
                <div class="text-lg text-primary">مرحبا بك في</div>
                <h1 class="text-4xl/[60px] text-primary font-bold">
                    TV Show
                </h1>
            </div>

            <div class="flex items-center gap-4 *:size-[40px] *:flex *:justify-center *:items-center *:rounded-full *:text-white *:bg-primary *:transition *:hover:bg-primary-dark">
                <a href="https://www.facebook.com/rekaz22/" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com/" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="https://x.com/" target="_blank" aria-label="Tiktok" class="group">
                    <div style="
    width: 12px;
    height: 12px;
    background-color: white;
    -webkit-mask: url({{asset('front/assets/images/icons/x.svg')}}) center no-repeat;
    mask: url({{asset('front/assets/images/icons/x.svg')}}) center no-repeat;
    -webkit-mask-size: cover;
    mask-size: cover;
"></div>
                </a>
                <a href="https://t.me/tlogaui" target="_blank" aria-label="Telegram">
                    <i class="fab fa-telegram-plane fa-lg"></i>
                </a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-between gap-10 py-10">
            <div class="w-full max-w-[750px] bg-white rounded-[20px] shadow-main-2 p-5 pt-8 mx-auto">
                <form action="{{ route('user.register.submit') }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-5">
                    @csrf
                    <h2 class="text-2xl/[38px] text-primary text-center font-bold">إنشاء حساب جديد</h2>
                    <h6 class="text-lg leading-7 text-center font-normal pb-4">
                        أدخل البيانات الآتية لإتمام إنشاء حسابك
                    </h6>

                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-base font-normal">اسم المستخدم</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name') }}" required
                               class="input-primary">
                        @error('name') <p class="text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-base font-normal">البريد الإلكتروني</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}" required
                               class="input-primary">
                        @error('email') <p class="text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="lg:w-1/2 flex flex-col gap-2">
                            <label for="password" class="text-base font-normal">كلمة المرور</label>
                            <input type="password" name="password" id="password"
                                   required class="input-primary">
                            @error('password') <p class="text-sm text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="lg:w-1/2 flex flex-col gap-2">
                            <label for="password_confirmation" class="text-base font-normal">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   required class="input-primary">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="image" class="text-base font-normal">صورة المستخدم</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               required class="input-primary">
                        @error('image') <p class="text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-primary w-full">إنشاء الحساب</button>
                    </div>
                </form>
            </div>

            <div class="text-center">
                <span class="font-normal">لديك حساب بالفعل؟</span>
                <a href="{{ route('user.login') }}" class="text-primary mr-1 hover:underline">تسجيل الدخول</a>
            </div>
        </div>
    </div>
</div>

<!-- ====== Back To Top Start -->
<a href="javascript:void(0)"
   class="back-to-top fixed bottom-4 end-auto start-4 z-[997] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-main transition duration-300 ease-in-out hover:bg-dark">
    <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
</a>
<!-- ====== Back To Top End -->

<!-- ====== All Scripts -->
<script type="text/javascript" src="{{asset('front/assets/js/countries-ar.js')}}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/form.js')}}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/dropdown.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6Ld8vi0gAAAAAMKvtX-MnuKbj9ksaZ3u_HzpRVHF"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6Ld8vi0gAAAAAMKvtX-MnuKbj9ksaZ3u_HzpRVHF', {action: 'submit'}).then(function (token) {
            let form = document.getElementById('your_form');
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'g-recaptcha-response';
            input.value = token;
            form.appendChild(input);
        });
    });
</script>

<script type="text/javascript">

</script>
</body>
</html>