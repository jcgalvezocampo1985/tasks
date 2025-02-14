<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $table = 'tasks';
    protected $guarded = ['id'];
    protected $fillable = [
        'name', 'description', 'url_course', 'start_date', 'end_date', 'minutes', 'difficulty_level', 'priority', 'task_status', 'register_status', 'client_id', 'user_id'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function task_history()
    {
        return $this->hasMany(TaskHistory::class, 'task_id');
    }
}
