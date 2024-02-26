<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class SearchController extends Controller
{
    public function searchReferralData(Request $request)
    {
        if ($request->ajax()) {
            $query = User::query();

            if (!empty($request->get('username'))) {
                $query->where('referralName', 'like', '%' . $request->get('username') . '%');
            }

            return DataTables::of($query)
                ->addColumn('status', function ($user) {
                    return ($user->status == User::$USER_PENDING) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Activated</p>';
                })
                ->make(true);
        }

        return response()->json(['message' => 'Invalid Request'], 400);
    }

}
