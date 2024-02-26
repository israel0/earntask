<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\ActivationCode;
use App\Models\plan;
use App\Models\Stage;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function __construct()
    {
    }

    public function policy()
    {
        $data = [];
        $data["title"] = "Policy";
        $data["activeMenu"] = 5;
        return view("policy", $data);
    }

    public function index()
    {
        $data = [];
        $data["title"] = "Home";
        $data["activeMenu"] = 1;
        $testimonials = [];
        $data["testimonials"] = $testimonials;
        return view("home", $data);
    }

    public function about()
    {
        $data = [];
        $data["title"] = "About Us";
        $data["activeMenu"] = 2;
        return view("about", $data);
    }

    public function invest()
    {
        $data = [];
        $data["title"] = "Invest";
        $data["activeMenu"] = 2;
        return view("invest", $data);
    }

    public function help()
    {
        $data = [];
        $data["title"] = "Contact Us";
        $data["activeMenu"] = 4;
        return view("help", $data);
    }

    public function compensation_plan()
    {
        $data = [];
        $data["title"] = "Compensation";
        $data["activeMenu"] = 2;
        return view("compensation", $data);
    }

    public function UpdateContactUs(Request $request)
    {

        // validate incoming request (wip)
        //  $contact = new Contact();
        //  $contact->name = $request->name;
        //  $contact->title = $request->title;
        //  $contact->content = $request->content;
        //  $contact->save();
        // redirect and alert (wip)
    }

    public function auto($start, $limit)
    {
        $data = [];
        $data["title"] = "Auto Registration";
        $data["activeMenu"] = 1;
        $data["start"] = $start;
        $data["limit"] = $limit;
        return view("auto", $data);
    }

    public function auto_reg($referralName,$index)
    {
        $userName = "akinsola$index";
        $firstName = "akinsola";
        $lastName = "akinsola";
        $phoneNumber = "0810000000";
        $email = "akinsola@yahoo.com";
        $password = Hash::make("11111111");
        $referralName = "akinsol";
        $plan = 1;
        $user = new User();
        $user->referralName = $referralName;
        $user->plan = $plan;
        $user->userName = $userName;
        $user->password = $password;
        $user->firstName = $firstName;
        $user->email = $email;
        $user->lastName = $lastName;
        $user->phoneNumber = $phoneNumber;
        $user->save();
        $wallet = new Wallet();
        $wallet->userName = $user->userName;
        $wallet->save();
        echo "Finished Creating New User: $userName \n";
    }
}
