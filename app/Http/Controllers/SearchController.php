<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   

class SearchController extends Controller
{
    //
    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        // dd(request('name'))
        // dd(User::where('username', request('name'))->get());
        $users = [];
        $message = '';
        $all = User::all();
        // dd((request(('name')) == '' or null) and User::where('username', request('name')));
        if (!request(('name')) and !$all->contains('username', request('name'))) {
            $users = User::all();
        }
        else if(!$all->contains('username', request('name'))) {
            $message = 'User Not Found';
            $users = User::all();
        }
        else{
            $users = User::where('username', request('name'))->get();
        }
        return view("search.index", compact('users', 'message'));
    }
}
