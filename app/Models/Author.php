<?php

namespace App\Models;

use App\Models\Book;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps=true;
    protected $table='authors';
    protected $perPage=12;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [];
    protected $casts = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name']=Str::title($value);
    }

    public function getNameAttribute($value) : string
    {
        return Str::title($value);
    }
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }


}
