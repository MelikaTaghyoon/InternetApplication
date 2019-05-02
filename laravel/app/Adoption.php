<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Adoption extends Model
{
    protected $fillable = ['userid', 'animalid', 'status'];
}
