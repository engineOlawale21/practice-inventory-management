<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's password.
     *
     * @param  array<string, mixed>  $input
     */
    public function reset(User $user, array $input): void
    {
        $this->validateInput($input);

        $user->update([
            'password' => Hash::make($input['password']),
        ]);
    }

    /**
     * Validate the reset password input.
     */
    protected function validateInput(array $input): void
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();
    }
}
