<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $table = 'clients';
    protected $guarded = ['id'];
    protected $fillable = [
        'full_name', 'short_name', 'description', 'register_status', 'department_id', 'user_id'
    ];
    public $timestamps = true;

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'client_id');
    }
}
