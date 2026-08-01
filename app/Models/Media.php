<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'user_id', 'file_name', 'original_name', 'disk',
        'path', 'mime_type', 'extension', 'size',
        'alt', 'caption',
    ];
}
