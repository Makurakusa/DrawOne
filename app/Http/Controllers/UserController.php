<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Picture;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('users.index')->with(['pictures' => $user->getByUser()]);
    }

}
