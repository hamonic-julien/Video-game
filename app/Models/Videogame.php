<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Videogame extends Model{

    const NO_NAME = 1;
    const NO_EDITOR = 2;
    const NO_RELEASE_DATE = 4;
    const NO_PLATFORM = 8;

    //permet de définir le nom de la table s'il ne respect pas la convention Eloquent (ici: videogames)
    protected $table = 'videogame';
    //permet d'indiquer à Eloquent qu'il n'y a pas de champ created_at et updated_at
    public $timestamps = false;
    //permet d'indiquer à Eloquent le format du champ date
    protected $dateFormat = 'Y';
}
