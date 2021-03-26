<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date',
        'start_hour',
        'end_hour',
        'recurrence'
    ];
}
