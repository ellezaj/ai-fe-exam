<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'title',
        'image',
        'link',
        'date',
        'content',
        'writer',
        'editor',
        'status',
    ];

    public function getImageAttribute($value)
    {
        if(file_exists(public_path('storage/' . $value))){
            return asset('storage/' . $value);
        } else {
            return asset('storage/images/default_image.jpg');
        }
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
