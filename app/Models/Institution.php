<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /** @use HasFactory<\Database\Factories\InstitutionFactory> */
    use HasFactory;

    protected $table = 'institutions';
    protected $guarded = ['id'];
    protected $fillable = [
        'full_name', 'short_name', 'description'
    ];
    public $timestamps = true;
}
