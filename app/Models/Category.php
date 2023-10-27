<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $appends = ['size'];

    public function getSizeAttribute()
    {
        $max = Category::orderByDesc('hits')->first();
        $this->hits = ($this->hits != null && $this->hits != 0) ? $this->hits : 1;
        $px = ($this->hits * 15) / $max->hits + 15;
        return round($px, 2);
    }
}
