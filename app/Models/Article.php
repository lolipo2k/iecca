<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Media;
use App\Models\Raiting;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';

    protected $appends = ['imageUrl', 'attachmentUrl', 'raiting'];

    protected $fillable = ['count'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class, 'article_id', 'id')->orderBy('created_at');
    }

    public function getRaitingAttribute()
    {
        $raiting = new Raiting();
        $raiting = $raiting::where('journal_id', $this->id);
        $count = $raiting->count();
        if ($count != 0) {
            $sum = ceil($raiting->sum('raiting') / $count);
            return [$sum, $count];
        }
        return [0, 0];
    }

    public function getImageUrlAttribute()
    {
        return $this->getMedia($this->image);
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->getMedia($this->attachment);
    }

    private function getMedia($item)
    {
        if ($item) {

            $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
            $server = $_SERVER['SERVER_NAME'];
            $port = $_SERVER['SERVER_PORT'] ? ':' . $_SERVER['SERVER_PORT'] : '';

            $media = new Media();
            $name = $media::find($item);
            $format = explode('.', $name->name);
            $name = $protocol . $server . $port . "/media/articles/{$name->table_id}/" . $name->id . '.' . end($format);

            return $name;
        }

        return '';
    }
}
