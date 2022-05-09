<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elections extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre', 'datedebut', 'datefin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}