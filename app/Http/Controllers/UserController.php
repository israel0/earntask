<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = User::query();

            if (!empty($request->get('email'))) {
                $query->where('email', 'like', '%' . $request->get('email') . '%');
            }

            if (!empty($request->get('search'))) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('email', 'like', '%' . $request->get('search') . '%')
                        ->orWhere('userName', 'like', '%' . $request->get('search') . '%');
                });
            }

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users');
    }

    public function list() {
           $user = User::all();
           return view("lists" , compact("user"));
    }
}
