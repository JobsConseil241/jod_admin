<?php

namespace App\Http\Controllers\Auth;

use App\Console\Commands\ClearTempFolder;
use App\Http\Controllers\API\V1\FileS3Controller;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DocumentList;
use App\Models\Provider;
use App\Models\ProviderDocumentList;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

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

    use RegistersUsers {
        register as registration;
    }

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
        //$this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        //les rules de l'utilisateur
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'email' => ['required', 'email', 'unique:users,email', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('users')->where(function ($query) use ($data) {
                    return $query->where('phone', $data['phone'])
                        ->where('phone_code', $data['phone_code']);
                }),
            ],
            'phone_code' => ['required', 'string', 'max:5'],
        ];

        //les rules du provider
        $rules_company = [
            'company_name' => ['required', 'string', 'max:100', 'unique:companies,company_name'],
            'country' => ['required', 'string', 'max:100'],
            'localisation' => ['required', 'string', 'max:254'],
            'bp' => ['required', 'string', 'max:254'],
            'rccm' => ['required', 'string', 'max:25'],
            'nif' => ['required', 'string', 'max:20'],
            'legal_status' => ['required'],
            'taxe_ca' => ['required'],
            'date_create' => ['required'],
            'date_end_exercice' => ['required'],
            'contact' => [
                'required',
                'string',
                'max:15',
                Rule::unique('companies')->where(function ($query) use ($data) {
                    return $query->where('contact', $data['contact'])
                        ->where('contact_code', $data['contact_code']);
                }),
            ]
        ];

        return Validator::make($data, array_merge($rules, $rules_company));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        $user =  User::create([
            'last_name' => $data['last_name'],
            'first_name' => array_key_exists('first_name', $data) ? $data['first_name'] : null,
            'phone' => $data['phone'],
            'phone_code' => $data['phone_code'],
            'user_type_id' => $data['user_type_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $company = Company::create(
            [
                'company_name' => $data['company_name'],
                'contact_code' => $data['contact_code'],
                'contact' => $data['contact'],
                'taxe_ca' => $data['taxe_ca'],
                'localisation' => $data['localisation'],
                'bp' => $data['bp'],
                'rccm' => $data['rccm'],
                'nif' => $data['nif'],
                'country' => $data['country'],
                'legal_status' => $data['legal_status'],
                'date_create' => $data['date_create'],
                'date_end_exercice' => $data['date_end_exercice']
            ]
        );

        return $user;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register(Request $request)
    {
        $request['user_type_id'] = 2;

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // $google2fa = app('pragmarx.google2fa');
        // $registration_data = $request->all();
        // $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        // $request->merge($registration_data);

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        // $QR_Image = $google2fa->getQRCodeInline(
        //     config('app.name'),
        //     $registration_data['email'],
        //     $registration_data['google2fa_secret']
        // );

        //return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret'], 'registered' => $user]);

        return redirect()->route('home')->with('sucess', "Bienvenu sur OD Compta");
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function completeRegistration(Request $request)
    {
        return redirect()->route('home')->with('sucess', "Bienvenu sur Cette Plateforme");
    }
}
