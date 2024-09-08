<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function client(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class);
    }
}
