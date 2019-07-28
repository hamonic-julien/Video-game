<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Videogame;
use App\Models\Platform;
use App\Models\User;
use App\Utils\UserSession;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
    //Méthode pour afficher la page Toto-route
    public function totoAction(Request $request) {
        //si on a un param en GET un chiffre qui vaut 51, alors on retourne
        //name : 'Pastis',
        //type : 'Alcohol',
        //origin : 'Marseille',
        //glacons : 10

        //Je récupère ce qu'à envoyé l'utilisateur en GET
        $get = $request->input();
        //Je vérifie s'il existe un param chiffre et s'il vaut 51
        if(isset($get['chiffre'])) {

            if($get['chiffre'] == 51) {
                //renvoi un objet response encodé en json
                return response()->json([
                    'name' => 'Pastis',
                    'type' => 'Alcohol',
                    'origin' => 'Marseille',
                    'ice-cube' => 10
                ]);
            };

            if($get['chiffre'] == 5) {
                //renvoi vers la route toto
                return redirect()->route('toto');
            };
    };

        return view('mavuetoto', ['name' => 'Toto', 'req' => $request]);
    }

    //Méthode pour afficher la page Admin (formulaire)
    public function admin(Request $request) {
        //Si le visiteur n'est pas connecté
        if(!UserSession::isConnected()){
            //On le redirige vers la page de connexion
            return redirect()->route('login-form');
        }
        //Si le visiteur n'est pas admin
        elseif(!UserSession::isAdmin()) {
            //On le redirige vers la home
            return redirect()->route('home');
        }
        //UserSession::isAdmin();
        $viewVars = [];
        $errorMsgs = [];
        $errors = $request->input('error', 0);
        //je compte mon nombre de paramètre envoyés
        //cas 1 : premier affichage => 0 param
        //cas 2 : erreur de saisi => 3 params
        if ($errors > 0) {
            //ici, on est dans la cas du réaffichage du formulaire suite erreur de saisi
            //On veut prévenir l'utilisateur et remettre les données saisies dans les champs
            $viewVars['formValues'] = $request->input();
            if($errors & Videogame::NO_NAME) {
                $errorMsgs[] = 'Il manque le nom';
            }
            if($errors & Videogame::NO_EDITOR) {
                $errorMsgs[] = 'Il manque l\éditeur';
            }
            if($errors & Videogame::NO_RELEASE_DATE) {
                $errorMsgs[] = 'Il manque la date';
            }
            if($errors & Videogame::NO_PLATFORM) {
                $errorMsgs[] = 'Il manque la console/plateforme';
            }
            $viewVars['errors'] = $errorMsgs;
        }

        $platforms = Platform::all();
        $viewVars['platforms'] = $platforms;
        //dump($platforms);
        return view('admin', $viewVars);
    }

    //Méthode pour envoi du formulaire d'ajout depuis la page admin
    public function adminPost(Request $request) {
        if(!UserSession::isConnected()) {
            return redirect()->route('login-form');
        }
        elseif (!UserSession::isAdmin()) {
            return redirect()->route('home');
        }
        //un param non trouvé via $request->input() renvoi null
        $name = $request->input('name');
        $editor = $request->input('editor');
        $release_date = $request->input('release_date');
        $platform = $request->input('platform', 0);

        //variable erreur initialisée à 0 puis incrémentée de la valeur de la constante du Model (1-2-4-8-...)
        $error = 0;
        if(empty($name)) {
            $error += Videogame::NO_NAME;
        }
        if(empty($editor)) {
            $error += Videogame::NO_EDITOR;
        }
        if(empty($release_date)) {
            $error += Videogame::NO_RELEASE_DATE;
        }
        if($platform == 0) {
            $error += Videogame::NO_PLATFORM;
        }
        //Ensuite $error représente l'ensemble des erreurs détectées dans les données envoyées

        if($error > 0) {
            return redirect()->route('admin', [
                'error' => $error,
                'name' => $name,
                'editor' => $editor,
                'release_date' => $release_date,
                'platform' => $platform
                ]);
        }

        //si la plateforme n'est pas renseignée
        //renvoyer la page admin avec les infos saisies dans les inputs
        /*if ($platform == 0) {
            return redirect()->route('admin', [
                'name' => $name,
                'editor' => $editor,
                'release_date' => $release_date
                ]);
        }*/

        //puisqu'en cas d'erreur on return un redirect, on sait qu'ici tout va bien
        $newVideogame = new Videogame();
        $newVideogame->name = $name;
        $newVideogame->editor = $editor;
        $newVideogame->release_date = $release_date;
        $newVideogame->platform_id = $platform;
        $newVideogame->save();

        return redirect()->route('home', ['add_ok' => 1]);
    }

    //Méthode pour afficher la page admin
    public function home(Request $request) {
        //Je récupère en GET la demande de tri
        $order = $request->input('order', 'id');//input('clé a récupérer', 'valeur par défaut')
        //echo '<h3>$order</h3>';
        //dump($order);
        //la méthode statique all() récupère toutes les lignes de la table du modèle sous forme d'instances de ce modèle
        $videogamesList = Videogame::all()->sortBy($order);//sortBy permet d'effectuer un tri suivant le param donné
        //dump($videogamesList);
        $platformList = Platform::all();

        return view('home', ['videogames' => $videogamesList, 'platforms' => $platformList]);
    }

    //Méthode pour afficher le formulaire de connexion
    public function login () {
        return view('login');
    }

    //Méthode pour gérer la connexion à l'envoi du formulaire
    public function loginPost (Request $request) {
        $viewVars = [];
        //récupérer les données envoyées avec $request
        //créer une variable selon le model User qui sera le champ où l'email (unique) correspond
        $user = User::where('email', $request->input('email'))->first();
        //Vérifier si l'user existe
        if(!is_null($user)) {
            //vérifier le mot de passe
            $match = password_verify($request->input('pass'), $user->pass);
            //Si le mot de passe correspond
            if($match){
                //sauvegarder en session l'utilisteur
                UserSession::connect($user);
                //afficher la page admin
                return redirect()->route('admin');
            }
            //Sinon renvoyer le formulaire avec message d'erreur
            else {
                $viewVars['errors'] = ['Identifiants incorrects'];
                $viewVars['formValues'] = ['email' => $request->input('email')];
                return view('login', $viewVars);
            }
        }
        //Sinon renvoyer le formulaire avec message d'erreur
        else {
            $viewVars['errors'] = ['Identifiants incorrects'];
                $viewVars['formValues'] = ['email' => $request->input('email')];
                return view('login', $viewVars);
        }
    }

    public function logout() {
        UserSession::disconnect();
        return redirect()->route('home');
    }
}
