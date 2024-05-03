<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ], [
            'current_password.required' => __('Vui lòng nhập mật khẩu hiện tại.'),
            'current_password.current_password' => __('Mật khẩu hiện tại không đúng.'),
            'password.required' => __('Vui lòng nhập mật khẩu mới.'),
            'password.min' => __('Mật khẩu phải chứa ít nhất 8 ký tự.'),
            'password_confirmation.required' => __('Vui lòng nhập xác nhận mật khẩu mới.'),
            'password_confirmation.min' => __('Xác nhận mật khẩu phải chứa ít nhất 8 ký tự.'),
            'password_confirmation.same' => __('Mật khẩu xác nhận không khớp với mật khẩu mới.'),
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
