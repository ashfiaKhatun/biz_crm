<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class UserController extends Controller
{
    

    public function indexClients()
    {
        $users = User::where('role', 'customer')->get();
        return view('template.home.users.indexClients', compact('users'));
    }
    public function indexManagers()
    {
        $users = User::where('role', 'manager')->get();
        return view('template.home.users.indexManagers', compact('users'));
    }
    public function indexAdmins()
    {
        $users = User::where('role', 'admin')->get();
        return view('template.home.users.indexAdmins', compact('users'));
    }
}
