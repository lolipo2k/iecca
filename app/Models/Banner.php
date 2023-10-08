<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';

    protected $appends = ['imageUrl'];

    private $host;

    public function __construct()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
        $server = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] ? ':' . $_SERVER['SERVER_PORT'] : '';

        $this->host = $protocol . $server . $port;
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
            $name = $this->host . "/media/banners/{$name->table_id}/" . $name->id . '.' . end($format);

            return $name;
        }

        return '';
    }
}
