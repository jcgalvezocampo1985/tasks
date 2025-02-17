<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistoryFile extends Model
{
    /** @use HasFactory<\Database\Factories\TaskHistoryFactory> */
    use HasFactory;

    protected $table = 'task_histories_files';
    protected $guarded = ['id'];
    protected $fillable = [
        'description','url_file','task_history_id'
    ];
    public $timestamps = true;

    public function task_history()
    {
        return $this->belongsTo(TaskHistory::class, 'task_history_id');
    }
}
