<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException; // Import the ValidationException class


class RegisteredUserController extends Controller
{
    // Display Admin registration form
    public function createAdmin()
    {
        
        return view('template.auth.register_admin');
    }

    // Handle storage of Admin
    public function storeAdmin(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        event(new Registered($user));

        

        return redirect()->route('user.admin');
    }

    // Display Manager registration form
    public function createManager()
    {
        
        return view('template.auth.register_manager');
    }

    // Handle storage of Manager
    public function storeManager(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'manager',
        ]);

        event(new Registered($user));

        

        return redirect()->route('user.manager');
    }
    
    // Display Manager registration form
    public function createEmployee()
    {
        
        return view('template.auth.register_employee');
    }

    // Handle storage of Manager
    public function storeEmployee(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
        ]);

        event(new Registered($user));

        

        return redirect()->route('user.employee');
    }

    // Display Customer registration form
    public function createCustomer()
    {
        return view('template.auth.register_customer');
    }
    
    public function clientRegister()
    {
        return view('template.auth.page-register');
    }

    // Handle storage of Customer
    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'business_type' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'business_type' => $request->business_type,
            'business_name' => $request->business_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        event(new Registered($user));

        return redirect()->route('user.client');
    }
    public function storeClient(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'business_type' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'business_type' => $request->business_type,
            'business_name' => $request->business_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        event(new Registered($user));

        return redirect()->route('login');
    }
}
