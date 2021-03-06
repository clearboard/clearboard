<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User\User;

class ProfileController extends Controller
{
    /**
     * View profile
     *
     * @return \Illuminate\Http\Response
     */
    public function view($uid)
    {
        return view('clearboard.profile.viewprofile', ['user' => User::findOrFail($uid)]);
    }
}
