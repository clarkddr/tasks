<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','priority','project'
    ];

    protected $casts =[
        'title' => 'string',
        'priority' => 'integer',
    ];

}
