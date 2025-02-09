<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DeparmentFactory> */
    use HasFactory;
    
    protected $table = 'departments';
    protected $guarded = ['id'];
    protected $fillable = [
        'full_name', 'short_name', 'description', 'register_status', 'institution_id'
    ];
    public $timestamps = true;

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'department_id');
    }
}
