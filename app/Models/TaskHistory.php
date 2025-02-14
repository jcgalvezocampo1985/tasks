<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    /** @use HasFactory<\Database\Factories\TaskHistoryFactory> */
    use HasFactory;

    protected $table = 'task_histories';
    protected $guarded = ['id'];
    protected $fillable = [
        'start_date','end_date','minutes','description','task_history_status','register_status','task_id','user_id'
    ];
    public $timestamps = true;

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
