<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPhoto extends Model
{
    use HasFactory;

    protected $table = 'news_photos';

    protected $primaryKey = 'id';

    public $timestamps = 'true';

    protected $fillable = [
        'path',
        'newsId',
       
    ];
}
