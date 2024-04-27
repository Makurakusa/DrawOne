<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EtcController extends Controller
{
    public function explain(User $user)
    {
        $user = Auth::user();
        return view('etc.explanation')->with(['user' => $user]);
    }
}
