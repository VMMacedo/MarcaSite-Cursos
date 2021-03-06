<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gateway extends Model
{
    use HasFactory;

    protected $table = 'gateways';
    protected $fillable = ['email', 'token', 'urlnotificacao'];
}
