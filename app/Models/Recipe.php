<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name','description', 'content','category_id'];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

}
