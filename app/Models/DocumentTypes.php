<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTypes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'docType',
        'template',
        'price',
    ];

}
