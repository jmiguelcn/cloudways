<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    public function NomCognoms()
    {
        return $this->nom . ' ' . $this->cognoms;
    }
}
