<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'status',
    ];

    public function getLogoAttribute($value)
    {
        if(file_exists(public_path('storage/' . $value))){
            return asset('storage/' . $value);
        } else {
            return asset('storage/logos/default_logo.jpg');
        }
    }
    public function articles()
    {
        return $this->hasMany(Article::class, 'company');

    }

}
