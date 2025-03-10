<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibrarySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'value', 'created_by'
    ];
}
