<?php


namespace App\Http\Controllers;


class UserHandlingController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }

    public function showUserHandlingPage()
    {
        return view('admin.user-handling');
    }
}
