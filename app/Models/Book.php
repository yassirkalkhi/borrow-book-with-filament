<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Genre;

class Book extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'author',
        'title',
        'material_type',
        'publishing_place',
        'publisher',
        'publish_date',
        'parts',
        'ratio_count',
        'is_available'
    ];

  
}