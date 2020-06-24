<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;
class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to LPDReviews!';
        return view('pages.index', compact('title'));
    }
    public function about() {
        $title = 'About Us';
        return view('pages.about')->with('title',$title);
    }
    public function admin() {
        $title = __('text.adminPage');
        $users = User::all();
        return view('pages.admin')->with('users',$users)->with('title',$title);
    }
}
