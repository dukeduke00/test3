<?php

namespace App\Http\Controllers;

use App\Models\UserCitiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCitiesController extends Controller
{
    public function favourite(Request $request, $city)
    {
        $user = Auth::user();
        if($user === null)
        {
            return redirect()->back()->with(['error' => 'Morate biti ulogovani da bi ste dodali grad u omiljene!']);
        }

        UserCitiesModel::create([
            'city_id' => $city,
            'user_id' => $user->id,
        ]);

        return redirect()->back();

    }

    public function unfavourite(Request $request, $city)
    {
        $user = Auth::user();
        if($user === null)
        {
            return redirect()->back()->with(['error' => 'Morate biti ulogovani da bi ste dodali grad u omiljene!']);
        }


        $userFavourite = UserCitiesModel::where([
            'city_id' => $city,
            'user_id' => $user->id,
        ])->first();

        if (!$userFavourite) {
            return redirect()->back();
        }

        $userFavourite->delete();

        return redirect()->back();

    }


}
