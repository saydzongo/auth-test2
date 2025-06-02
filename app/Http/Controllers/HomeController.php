<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Stage;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Partenaire;




/*use App\Models\Stage;*/
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
  /*  public function index()
    {
       return view ('admin.index'); 
    } */
    public function index() {
 
        $user = Auth::user(); // ✅ Récupération de l'utilisateur connecté

        // ✅ Récupération des statistiques des stages et partenaires
        $nombreEnAttente = Stage::where('user_id', $user->id)->where('statut', 'en attente')->count();
        $nombreValides = Stage::where('user_id', $user->id)->where('statut', 'validé')->count();
        $nombreRejetes = Stage::where('user_id', $user->id)->where('statut', 'rejeté')->count();
        $nombreDemandes = Stage::where('user_id', $user->id)->count();
        $nombrePartenaires = Partenaire::count();
        $nombreStages = Stage::count();
        $nombreStagesValides = Stage::where('statut', 'validé')->count();
        $nombreStagesEnAttente = Stage::where('statut', 'en attente')->count();
        $nombreStagesRejetes = Stage::where('statut', 'rejeté')->count();

        // ✅ Récupération des données sur plusieurs années
        $years = range(Carbon::now()->year - 5, Carbon::now()->year);
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

        // ✅ Vérification du rôle utilisateur et récupération des stages
        if ($user->hasRole('admin')) {
            $stages = Stage::all(); // ✅ L’admin voit tous les stages
        } else {
            $stages = Stage::where('user_id', $user->id)->get(); // ✅ L’étudiant voit ses propres stages
        }

        return view('admin.index', compact(
            'user', 'nombrePartenaires', 'nombreStages', 'nombreStagesValides',
            'nombreStagesEnAttente', 'nombreStagesRejetes', 'stages', 'stats', 'nombreDemandes', 'nombreEnAttente', 'nombreValides', 'nombreRejetes'
        
        ));

       
    }




    public function home()
    {
        return view('home.index');
    }

    
    
  




public function updateUserRole($email, $roleName)
{
    $user = User::where('email', $email)->first();
    $role = Role::where('name', $roleName)->first();

    if ($user && $role) {
        $user->syncRoles([$role]); // ✅ Met à jour le rôle
    }

    return redirect()->route('dashboard')->with('success', 'Rôle mis à jour!');
} 


       
    


}






