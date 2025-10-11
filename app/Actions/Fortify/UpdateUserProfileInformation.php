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
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        $this->validateInput($user, $input);

        if (!empty($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $this->updateUserData($user, $input);
    }

    /**
     * Validate the profile update input.
     */
    protected function validateInput(User $user, array $input): void
    {
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');
    }

    /**
     * Handle updating user data and email verification.
     */
    protected function updateUserData(User $user, array $input): void
    {
        $needsEmailVerification =
            $input['email'] !== $user->email && $user instanceof MustVerifyEmail;

        if ($needsEmailVerification) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->update([
                'name'  => $input['name'],
                'email' => $input['email'],
            ]);
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->update([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'email_verified_at' => null,
        ]);

        $user->sendEmailVerificationNotification();
    }
}
