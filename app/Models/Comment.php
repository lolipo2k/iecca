<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Article;
use App\Models\Event;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $appends = ['object'];

    public function getObjectAttribute()
    {
        if ($this->article_id) {
            return Article::where('id', $this->article_id)->first();
        } else {
            return Event::where('id', $this->material_id)->first();
        }
    }
}
