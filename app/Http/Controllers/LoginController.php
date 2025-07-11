<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    
    public function create()
    {
        return view('login.create');
    }
    
    public function store(RegisterRequest $request)
    {
        $request->validated();
    
        User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.index')->with('success', 'Compte créé !');
    }

 public function authenticate(LoginRequest $request)
{
    
    $credentials = $request->validated();
    
    if (Auth::attempt($credentials)) {
         session([
            'role'=>Auth::user()->role
         ]);
        $request->session()->regenerate();
        return redirect()->route('produits.index');
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect.',
    ])->onlyInput('email');
}

public function destroy(Request $request){
    
   Auth::logout();
    request()->session()->invalidate();
     request()->session()->regenerateToken();
  
    return redirect()->route('login.index')->with('success', 'Déconnecté avec succès.');

}


public function show($id){
    if(Auth::user()->role=='admin'){
    $count1=DB::table('products')->count();
    $count2=DB::table('orders')->count();
    $users=User::all();
   
    return view('login.show',compact('users','count1','count2'));
    }
        return redirect()->route('produits.index');

}
}