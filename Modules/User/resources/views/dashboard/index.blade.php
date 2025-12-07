@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">

        <x-dashboard.breadcrumbs-item>
            {{ __('user::dashboard.users-permission') }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center mb-3 me-3">
                <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
            </div>
            <form id="datatablesFilter">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for=""></label>
                        <input type="text" id="username" placeholder="{{ __('user::dashboard.username') }}"
                            name="username" class="form-control" >
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for=""></label>
                        <input type="text" id="name" placeholder="{{ __('user::dashboard.name') }}" name="name"
                            class="form-control" >
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for=""></label>
                        <input type="email" id="email" placeholder="{{ __('user::dashboard.email') }}" name="email"
                            class="form-control" >
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for=""></label>
                        <input type="email" id="email" placeholder="{{ __('user::dashboard.email') }}" name="email"
                            class="form-control" >
                    </div>
    
                    <div class="col-md-2" style="margin-top:23px;">
                        <button type="button" onclick="this.form.submit()" class="btn btn-primary">بحث</button>
                    </div>
                </div>
            </form>


            <div class="card-datatable table-responsive">
                <table class="datatables-basic table border-top table-hover"
                    data-href="{{ route('dashboard.user.datatable') }}" search ="false" export="true">
                    <thead>
                        <tr>
                            {{-- <th data-column="id" data-searchable="false"></th> --}}
                            <th data-column="id" data-orderable="false" data-searchable="false">#</th>
                            <th data-column="name" data-orderable="false" style="width: 150px" class="text-center">
                                {{ __('dashboard.name') }}</th>
                            <th data-column="email" data-orderable="false" class="text-center">{{ __('dashboard.email') }}
                            </th>
                            <th data-column="role" data-orderable="false" class="text-center">الدور
                            </th>
                            <th data-column="actions" data-searchable="false" data-orderable="false" class="text-center">
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Offcanvas to add new user -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                        <div class="mb-3">
                            <label class="form-label" for="add-user-fullname">Full Name</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="userFullname" aria-label="John Doe" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-user-email">Email</label>
                            <input type="text" id="add-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-user-contact">Contact</label>
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-user-company">Company</label>
                            <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer"
                                aria-label="jdoe1" name="companyName" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" class="select2 form-select">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="user-role">User Role</label>
                            <select id="user-role" class="form-select">
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="maintainer">Maintainer</option>
                                <option value="author">Author</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Select Plan</label>
                            <select id="user-plan" class="form-select">
                                <option value="basic">Basic</option>
                                <option value="enterprise">Enterprise</option>
                                <option value="company">Company</option>
                                <option value="team">Team</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                        <button type="reset" class="btn btn-label-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    {{-- <script>
    $(document).ready(function() {
        // تفعيل select2 مع تمكين خاصية "إلغاء الاختيار"
        $('#partner_id').select2({
            allowClear: true,  // تمكين خاصية إلغاء الاختيار
            placeholder: "{{ __('user::dashboard.select_partner') }}"  // تحديد النص عند عدم اختيار قيمة
        });

        // عند تغيير الاختيار، نقوم بتقديم النموذج تلقائيًا
        $('#partner_id').on('change', function() {
            this.form.submit();  // تقديم النموذج بعد التغيير
        });
    });
</script> --}}
