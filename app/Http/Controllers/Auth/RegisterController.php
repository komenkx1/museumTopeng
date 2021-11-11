<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'phone' => ['required', 'string', 'regex:/^(^\+62|62)(\d{3,4}-?){2}\d{3,4}$/'],
            'file_verification_url' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
         [
        "phone.regex" => "Phone number must start with '62' and have a maximum length of 13 digits"
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $fileContent =  $data['file_verification_url'];
        if ($fileContent) {
        $nama_image = "identityFile/" . md5(now() . "_" . $fileContent->getClientOriginalName()) . '.' . $fileContent->getClientOriginalExtension();
        $fileContent->storeAs('public', $nama_image);
        $data['file_verification_url'] = $nama_image;
        }

        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'file_verification_url' => $data['file_verification_url'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        return redirect('/')->with('success','Welcome '. $user->name . ' you are registered. Please wait for the admin to verify your account within 1x24 hours');
    }

    public function showRegistrationForm()
    {
        return view('front.auth.register');
    }
}
