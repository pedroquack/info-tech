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
        'client_id',
    ];

    public function client(){
        //Define a relação entre projeto e cliente
        return $this->belongsTo(User::class, 'client_id');
    }

    public function tasks(): HasMany {
        //Define a relação entre projeto e tarefas, e ordena as tarefas pendentes na frente
        return $this->hasMany(Task::class)->orderBy('status','asc')->orderBy('created_at');
    }
}
