<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    /** @use HasFactory<\Database\Factories\InstitutionFactory> */
    use HasFactory;
    //use SoftDeletes;

    protected $table = 'institutions';
    protected $guarded = ['id'];
    protected $fillable = [
        'full_name', 'short_name', 'description', 'register_status'
    ];
    public $timestamps = true;

    public function deparments()
    {
        return $this->hasMany(Deparment::class, 'institution_id');
    }
}
