<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
/*use App\Models\Stage;*/
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
       return view ('admin.index'); 
    }

    public function home()
    {
        return view('home.index');
    }

    
    public function dashboard()
{
    $user = Auth::user(); // Récupérer l'utilisateur connecté
    return view('dashboard', compact('user'));
}

}
