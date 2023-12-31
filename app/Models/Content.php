<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
    use HasFactory;

    protected $table = 'marticle';

    protected $appends = ['attachmentUrl', 'imageUrl', 'categories'];

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

    public function getCategoriesAttribute()
    {
        $tags = Content::rightJoin('tags_to_marticles', 'tags_to_marticles.marticle_id', '=', 'marticle.id')
            ->where("tags_to_marticles.marticle_id", $this->id)
            ->select("tags_to_marticles.*")->get();
        if (isset($tags)) {
            $data = [];
            foreach ($tags as $key => $tag) {
                $data[$key] = Category::find($tag->tag_id);
            }
            return $data;
        }
        return [];
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
