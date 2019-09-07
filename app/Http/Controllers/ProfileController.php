<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfileForm()
    {
        $data = [
            "email" => "",
            "name" => ""
        ];

        $data["email"] = Auth::user()->email;
        $data["name"] = Auth::user()->name;

        return view("profile", $data);
    }

    /**
     * Handle a profile request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->update($request->all());

        $request->session()->flash('alert-success', __('User was successful update!'));
        return $this->showProfileForm();
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('current_password',function($attribute, $value, $parameters, $validator){
            return Hash::check($value, auth()->user()->password);
        }, __('The current password is incorrect.'));


        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => Rule::unique('users')->ignore(Auth::user()->id),
            'new_password' => ['string','nullable', 'min:8'],
            'current_password' => ['required', 'current_password']
        ]);
    }

    /**
     * Update a user.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function update(array $data)
    {
        $user = Auth::user();

        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['new_password'] !== null){
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();
    }
}
