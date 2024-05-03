<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ], [
            'name.required' => __('Vui lòng nhập tên.'),
            'name.max' => __('Tên không được vượt quá :max ký tự.'),
            'email.required' => __('Vui lòng nhập địa chỉ email.'),
            'email.email' => __('Địa chỉ email không hợp lệ.'),
            'email.max' => __('Địa chỉ email không được vượt quá :max ký tự.'),
            'email.unique' => __('Địa chỉ email đã được sử dụng.'),
            'phone.required' => __('Vui lòng nhập số điện thoại.'),
            'phone.max' => __('Số điện thoại không được vượt quá :max ký tự.'),
            'address.required' => __('Vui lòng nhập địa chỉ.'),
            'address.max' => __('Địa chỉ không được vượt quá :max ký tự.'),
            'photo.mimes' => __('Ảnh phải có định dạng jpg, jpeg, hoặc png.'),
            'photo.max' => __('Ảnh không được vượt quá :max KB.'),
        ])->validate();

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'address' => $input['address']
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
