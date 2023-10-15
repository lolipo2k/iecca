<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends Model
{
    use HasFactory;

    protected $table = 'type';

    protected $appends = ['attachmentUrl'];

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

    public function getAttachmentUrlAttribute()
    {
        return $this->getMedia($this->attachment);
    }

    private function getMedia($item)
    {
        if ($item) {
            $media = new Media();
            $name = $media::find($item);
            $format = explode('.', $name->name);
            $name = $this->host . "/media/type/{$name->table_id}/" . $name->id . '.' . end($format);

            return $name;
        }

        return '';
    }
}
