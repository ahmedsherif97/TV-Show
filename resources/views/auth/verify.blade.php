@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="'تأكيد البريد الإلكتروني'">
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fw-bold text-primary">تأكيد عنوان البريد الإلكتروني</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني.
                            </div>
                        @endif

                        <p>قبل المتابعة، يرجى التحقق من بريدك الإلكتروني من خلال رابط التحقق.</p>
                        <p>إذا لم تستلم البريد الإلكتروني:</p>
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary align-baseline">
                                اضغط هنا لإعادة إرسال الرابط
                            </button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
