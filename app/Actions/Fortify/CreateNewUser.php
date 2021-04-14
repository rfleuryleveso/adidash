<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class
CreateNewUser implements CreatesNewUsers
{
	use PasswordValidationRules;

	/**
	 * Validate and create a newly registered user.
	 *
	 * @param  array  $input
	 * @return \App\Models\User
	 */
	public function create(array $input)
	{
		Validator::make($input, [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'email' => [
				'required',
				'string',
				'email',
				'max:255',
				Rule::unique(User::class),
                // 'regex:/(.*)student\.junia\.com$/i',
			],
			'password' => $this->passwordRules(),
		], ['email.regex' => 'Veuillez entrer un email en @student.junia.com'])->validate();
		return User::create([
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'email' => $input['email'],
			'password' => Hash::make($input['password']),
		]);
	}
}
