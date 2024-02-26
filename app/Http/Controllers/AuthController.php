<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\User;
use App\Models\Wallet;
use App\Rules\referralValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware("guest")->except("logout", "register", "registerAction", "validate_referral");
    }

    // The method Get the login Page
    public function login()
    {
        $title = "Login Page";
        return view("auth.login" , compact("title"));
    }

    // This method Login all Users
    public function loginYouIn(Request $request)
    {

        $validate = $request->validate([
            'userName' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
                $request->session()->regenerate();
                return redirect()->intended('user');
        }
        session()->flash("error", "Invalid Username or Password");
        return back()->withInput();
    }


    // Display Registration Page
    public function register(Request $request)
    {
        $title = "Register Page";
        return view("auth.register", compact("title"));
    }

    // This method Registers new Users
    public function registerNewUser(Request $request)
    {
        $validate = $request->validate([
            'referralName' => [
                'required', "exists:users,userName", new referralValidationRule
            ],
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'phoneNumber' => 'required|numeric',
            'email' => 'required|unique:users,email',
            'userName' => 'required|alpha_num|min:3|max:20|unique:users,userName',
            'password' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:password',
            'terms' => "accepted"
        ]);
        $user = User::create($validate);
        $wallet = new Wallet();
        $wallet->userName = $user->userName;
        $wallet->save();
        Helper::activate_user($user);
        Auth::login($user);
        return to_route("dashboard");
    }

    public function validate_referral(Request $request)
    {
        $referralName = strtolower(trim($request->input("referralName")));
        $user = User::where("userName", $referralName)->first();
        $data = [];
        if (!$user) {
            $data["responseCode"] = 0;
            return response()->json($data);
        }
        $data["firstName"] = $user->firstName;
        $data["lastName"] = $user->lastName;
        $data["responseCode"] = 1;
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }

    public function showForgetForm() {
        $data["title"] = "Forget Password";
        $data["activeMenu"] = 7;
        return view("auth.email", $data);
    }

    public function showResetForm(Request $request, $token = null)
    {
        $data["title"] = "Reset Password";
        $data["activeMenu"] = 7;
        return view('auth.reset' , $data)->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route("login")->with('status', __($response))
            : back()->withErrors(['email' => __($response)]);
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function validationErrorMessages()
    {
        return [];
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

}
