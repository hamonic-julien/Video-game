<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model{
    //permet de définir le nom de la table s'il ne respect pas la convention Eloquent (ici: platforms)
    protected $table = 'platform';
    //permet d'indiquer à Eloquent qu'il n'y a pas de champ created_at et updated_at
    public $timestamps = false;
}
