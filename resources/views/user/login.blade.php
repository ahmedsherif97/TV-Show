<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TV Show</title>

    <link rel="manifest" href="{{ asset('front/assets/images/site.webmanifest') }}">

    <link rel="stylesheet" href="{{ asset('front/src/output.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}"/>

</head>

<body class="relative">
<img class="absolute top-0 left-0 size-full -z-[9]"
     src="{{ asset('front/assets/images/header/islamic-vector-2.png') }}"/>
<img class="absolute top-0 left-0 size-full -z-10" src="{{ asset('front/assets/images/header/gradient.png') }}"/>

<div class="lg:[direction:ltr] lg:h-[100dvh] lg:overflow-y-auto">
    <div class="lg:[direction:rtl] container min-h-[100vh] flex flex-col lg:flex-row lg:gap-20">
        <x-dashboard.alerts/>

        <div class="w-full flex flex-col justify-between gap-10 py-10">
            <div class="w-full max-w-[750px] bg-white rounded-[20px] shadow-main-2 p-5 pt-8 mx-auto">
                <form method="POST" action="{{ route('user.login.submit') }}" class="flex flex-col space-y-5">
                    @csrf

                    <h2 class="text-2xl/[38px] text-primary text-center font-bold">تسجيل الدخول إلى حسابك</h2>
                    <div class="flex flex-col gap-2">
                        <label for="email-username" class="text-base font-normal">البريد الإلكتروني</label>
                        <input type="text" name="email-username" id="email-username" required class="input-primary"
                               value="{{ old('email-username') }}">
                        @error('email-username') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-2 relative">
                        <label for="password" class="text-base font-normal">كلمة المرور</label>
                        <input type="password" name="password" id="password" required
                               class="border border-primary-light-2 rounded-[50px] p-3 pl-12 outline-none focus:border-primary hover:border-primary">
                        <button type="button" class="absolute bottom-[12px] left-[15px] size-5 cursor-pointer"
                                onclick="togglePasswordType(this)">
                            <i class="fas fa-eye text-primary"></i>
                        </button>
                        @error('password') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-between py-4">
                        <label for="remember" class="relative cursor-pointer">
                            <input name="remember" id="remember" type="checkbox" class="invisible peer"/>
                            <span class="absolute top-0.5 right-0 size-[15px] flex justify-center items-center rounded-sm bg-transparent border-2 border-gray-400 peer-checked:bg-primary peer-checked:border-primary peer-checked:text-white">
                                    <i class="fas fa-check text-[8px]"></i>
                                </span>
                            <span class="font-normal ms-2">تذكرني</span>
                        </label>
                        <a href="{{ route('home') }}" class="text-primary font-normal hover:underline">الرئيسية</a>
                    </div>

                    @if(session('error'))
                        <div class="text-error text-center">{{ session('error') }}</div>
                    @endif

                    <button type="submit" class="btn-primary">تسجيل الدخول</button>
                </form>
            </div>

            <div class="text-center">
                <span class="font-normal">مستخدم جديد؟</span>
                <a href="{{ route('user.register') }}" class="text-primary mr-1 hover:underline">إنشاء حساب</a>
            </div>
        </div>
    </div>
</div>

<a href="javascript:void(0)"
   class="back-to-top fixed bottom-4 start-4 z-[997] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-main transition hover:bg-dark">
    <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
</a>
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script>
    function togglePasswordType(btn) {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.querySelector('i').classList.toggle('fa-eye-slash');
    }

    $(document).ready(function () {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    });

</script>

</body>
</html>
