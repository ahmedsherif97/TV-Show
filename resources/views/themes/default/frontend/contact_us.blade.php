@extends('themes.default.frontend.includes.master')

@section('content')
    <div class="page-content contact-page">
        <div class="pattern">
            <img src="/assets/frontend/images/bg/pattern.svg" />
        </div>
        <div class="container">
            <div class="contact-map">
                <iframe
                    src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0"></iframe>
            </div>
            <div class="contact-row">
                <div class="contact-info">
                    <div class="page-head contact_page-head">
                        <h2 class="page-title">اتصل بنا</h2>
                        <p class="page-desc">
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                            هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                            العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                            التطبيق
                        </p>
                    </div>
                    <h4 class="contacts-title">عنواننا</h4>
                    <ul class="contacts-methods">
                        <li>
                            <span>
                                <i><img src="/assets/frontend/images/icons/address.svg" class="img-contain"></i>
                                الرياض - المملكة العربية السعودية
                            </span>
                        </li>
                        <li>
                            <a href="mailto:contact@ataa.net">
                                <i><img src="/assets/frontend/images/icons/mail.svg" class="img-contain"></i>
                                <span class="en">contact@ataa.net</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+9660505426859">
                                <i><img src="/assets/frontend/images/icons/phone.svg" class="img-contain"></i>
                                <span class="en">+966 050-542-6859</span>
                            </a>
                        </li>
                    </ul>
                    <div class="socials contact-socials">
                        <a href="#!" target="_blank">
                            <i class="lab la-facebook"></i>
                        </a>
                        <a href="#!" target="_blank">
                            <i class="lab la-twitter"></i>
                        </a>
                        <a href="#!" target="_blank">
                            <i class="lab la-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="contact-form">
                    <div class="page-head contact_page-head">
                        <h2 class="page-title">راسلنا الان</h2>
                    </div>
                    <form>
                        <div class="form-content">
                            <div class="form-group">
                                <label class="form-label"> الاسم </label>
                                <input type="text" class="form-control" placeholder="الاسم" />
                            </div>
                            <div class="form-group">
                                <label class="form-label"> البريد الالكتروني </label>
                                <input type="email" class="form-control" placeholder="example@gmail.com" />
                            </div>
                            <div class="form-group full-w">
                                <label class="form-label"> رقم الجوال </label>
                                <input type="tel" class="form-control" placeholder="مثال : +966 000 000 0055" />
                            </div>
                            <div class="form-group full-w">
                                <label class="form-label"> عنوان الرسالة </label>
                                <input type="text" class="form-control" placeholder="مثال: خاص بالتبرعات" />
                            </div>
                            <div class="form-group full-w">
                                <label class="form-label"> الرسالة </label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- <button type="submit" class="submit-btn default-btn">ارسال</button> -->
                        <button class="submit-btn default-btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#successModal">
                            ارسال
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
