<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dir' => ['required'],
            'telefono' => ['required'],
            'dni' => ['required'],
            'fecha_nac' => ['required'],
            'pago_tipo' => ['required'],
            'pago_numero' => ['required', 'digits:16'],
            'pago_cvv' => ['required', 'digits:3'],
            'pago_vencimiento' => ['required', 'date_format:m/y'],
            'captcha' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'direccion' => $data['dir'],
            'telefono' => $data['telefono'],
            'dni' => $data['dni'],
            'fecha_nac' => $data['fecha_nac'],
            'pago_tipo' => $data['pago_tipo'],
            'pago_numero' => $data['pago_numero'],
            'pago_cvv' => $data['pago_cvv'],
            'pago_vencimiento' => $data['pago_vencimiento'],
            'tipo_de_usuario' => 1,
            'semanas_disp' => 2,
        ]);
    }

     public function showRegistrationForm()
    {
        return view('auth.register',['title'=>'HSH - Registrarse']);
    }

}
