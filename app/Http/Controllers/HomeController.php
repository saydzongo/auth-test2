<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


/*use App\Models\Stage;*/
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
  /*  public function index()
    {
       return view ('admin.index'); 
    } */
    public function index()
{
    $years = range(Carbon::now()->year - 5, Carbon::now()->year); // Dernières 5 années
    $stats = [];

    foreach ($years as $year) {
        $totalDemandes = DB::table('stages')->whereYear('created_at', $year)->count();
        $totalValides = DB::table('stages')->whereYear('created_at', $year)->where('statut', 'validé')->count();
        
        $stats[] = [
            'année' => $year,
            'demandes' => $totalDemandes,
            'validés' => $totalValides,
        ];
    }

    return view('admin.index', compact('stats'));
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
