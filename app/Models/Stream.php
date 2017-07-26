<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $dates = [
       'item_created_at',
       'created_at',
       'updated_at',
    ];

    protected $casts = [
       'id' => 'uuid',
       'is_pinned' => 'boolean',
       'content' => 'json',
       'meta_content' => 'json',
    ];
}
