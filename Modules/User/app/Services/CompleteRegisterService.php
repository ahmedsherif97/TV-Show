<?php

namespace Modules\User\app\Services;
;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompleteRegisterService
{
    public function accountUpdate($request)
    {
        $user = Auth::user();
        $formType = $request->input('form_type');
        $message = '';

        switch ($formType) {
            case 'update_account':
                $message = $this->updateAccount($user, $request);
                break;
            case 'update_entity':
                $message = $this->updateEntity($user, $request);
                break;
            case 'update_connection':
                $message = $this->updateConnection($user, $request);
                break;
            case 'update_establishment':
                $message = $this->updateEstablishment($user, $request);
                break;
            default:
                // Handle invalid form type
                throw new \InvalidArgumentException('Invalid form type');
        }

        if ($user->partner && $user->partner->active) {
            $user->partner->update(['status' => 'active']);
        }
        return $message;
    }

    private function updateAccount($user, $request)
    {
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Update other fields as needed
        ]);

        return 'تم تحديث بيانات الحساب بنجاح';
    }

    private function updateEntity($user, $request)
    {
        $partner = $user->partner;
        $partner->update([
            'name' => $request->entity_name,
            'category_id' => $request->category_id,
            'country_id' => $request->region_id,
        ]);

        if ($request->permission_file) {
            $partner->clearMediaCollection('permission_file');
            $partner->addMediaFromRequest('permission_file')
                ->usingFileName($request->file('permission_file')->getClientOriginalName())
                ->toMediaCollection('permission_file');
        }

        return __('partner::dashboard.entity_updated_successfully');
    }

    private function updateConnection($user, $request)
    {

        $partner = $user->partner;
        $partner->update([
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'website' => $request->website,
        ]);

        return __('partner::dashboard.connection_updated_successfully');
    }

    private function updateEstablishment($user, $request)
    {

        $partner = $user->partner;
        $partner->update([
            'permission_number' => $request->permission_number,
            'permission_expiration_date' => $request->permission_expiration_date,
            'registration_status' => $request->registration_status,
            'registration_date' => $request->registration_date,
            'establishment_date' => $request->establishment_date,
            'supervision_id' => $request->supervision_id,
            'address' => $request->address,
            'website' => $request->website,
        ]);

        // Handle file upload if needed
        return __('partner::dashboard.establishment_updated_successfully');
    }
}
