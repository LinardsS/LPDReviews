<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DemoController extends Controller
{
    public function adminDemo() {
        $user_id =auth()->user()->id;
        return($user_id);
    }
    public function userDemo() {
        $user_id =auth()->user()->id;
        return($user_id);
    }
}
