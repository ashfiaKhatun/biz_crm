<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function indexClients()
    {
        $users = User::where('role', 'customer')->get();
        return view('template.home.users.client.index', compact('users'));
    }



    public function indexManagers()
    {
        $users = User::where('role', 'manager')->get();
        return view('template.home.users.manager.index', compact('users'));
    }
    public function editManager($id)
    {
        $manager = User::findOrFail($id);
        return view('template.home.users.manager.edit', compact('manager'));
    }
    public function updateManager(Request $request, $id)
    {

        $manager = User::findOrFail($id);
        $manager->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.manager')->with('success', 'Manager information updated successfully.');
    }




    public function indexAdmins()
    {
        $users = User::where('role', 'admin')->get();
        return view('template.home.users.admin.index', compact('users'));
    }
    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('template.home.users.admin.edit', compact('admin'));
    }
    public function updateAdmin(Request $request, $id)
    {

        $admin = User::findOrFail($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.admin')->with('success', 'Admin information updated successfully.');
    }
}
