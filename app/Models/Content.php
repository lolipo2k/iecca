<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
    use HasFactory;

    protected $table = 'marticle';

    protected $appends = ['attachmentUrl', 'imageUrl'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->getMedia($this->pdf);
    }

    public function getImageUrlAttribute()
    {
        return $this->getMedia($this->image);
    }

    private function getMedia($item)
    {
        if ($item) {
            $media = new Media();
            $name = $media::find($item);
            $format = explode('.', $name->name);
            $name = $this->host . "/media/monitorings/{$name->table_id}/" . $name->id . '.' . end($format);

            return $name;
        }

        return '';
    }
}
