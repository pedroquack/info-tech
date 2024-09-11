<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    use HasFactory;

    public function responsible() : BelongsTo{
        //Define a relação entre tarefa e responsável
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project() : BelongsTo{
        //Define a relação entre projeto e tarefa
        return $this->belongsTo(Project::class, 'project_id');
    }
}
