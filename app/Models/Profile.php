<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'program',
        'email',
        'gender',
        'hobbies',
        'biography',
    ];

    protected function casts(): array
    {
        return [
            'hobbies' => 'array',
        ];
    }
}
