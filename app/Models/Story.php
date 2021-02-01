<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    protected $fillable = [
        'title', 'description', 'user_id', 'total_like'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
