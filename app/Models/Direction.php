<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Article;

class Direction extends Model
{
    use HasFactory;

    protected $table = 'direction';

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class)->where('status', 1);
    }
}
