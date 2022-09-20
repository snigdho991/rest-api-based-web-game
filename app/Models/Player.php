<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_name',
        'player_name',
        'user_id',
        'rank_name',
        'shooter_one',
        'shooter_two',
        'shooter_three',
        'found',
        'comment',
    ];
}
