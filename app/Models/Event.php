<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Media;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Report;

class Event extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $appends = ['imageUrl', 'galleryList'];

    protected $fillable = ['count'];

    private $host;

    public function __construct()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
        $server = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] ? ':' . $_SERVER['SERVER_PORT'] : '';

        $this->host = $protocol . $server . $port;
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'project_id', 'id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'news_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return $this->getMedia($this->image);
    }

    public function getGalleryListAttribute()
    {
        $gallery = new Gallery();
        $gallery = $gallery->where('item_id', $this->id)->where('item_model', 'News')->get();
        if (!empty($gallery[0])) {
            $media = new Media();
            $media = $media->where('table_id', $gallery[0]->id)->where('table_name', 'gallery')->get();

            foreach ($media as $key => $value) {
                $format = explode('.', $value->name);
                $data[$key] = $name = $this->host . "/media/galleries/{$value->table_id}/" . $value->id . '.' . end($format);
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
