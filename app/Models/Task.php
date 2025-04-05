<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'title',
        'description',
        'priority',
        'due_date',
        'completed',
    ];

    public function user() {
        return $this->belongsTo(Users::class);
    }
}
