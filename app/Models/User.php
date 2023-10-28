<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password_hash',
    ];

    protected $appends = ['fullName', 'imageUrl', 'shortDescription', 'comments'];

    protected $table = 'front_user';

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'author_id', 'id')->where('status', 1);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'author_id', 'id');
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class, 'author_id', 'id');
    }

    public function getFullNameAttribute()
    {
        if ($this->last_name_ru || $this->first_name_ru) {
            return $this->last_name_ru . ' ' . $this->first_name_ru . ($this->middle_name_ru ? ' ' . $this->middle_name_ru : '');
        }
        return $this->username;
    }

    public function getShortDescriptionAttribute()
    {
        return mb_strimwidth($this->comment_ru, 0, 100, "...");
    }

    public function getImageUrlAttribute()
    {
        return $this->getMedia($this->image);
    }

    public function getCommentsAttribute()
    {
        $comments = Comment::where('user_id', $this->id)->get();

        return $comments;
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
            $name = $protocol . $server . $port . "/media/users/{$name->table_id}/" . $name->id . '.' . end($format);

            return $name;
        }

        return '';
    }

    public function setPasswordHashAttribute($password)
    {
        $this->attributes['password_hash'] = bcrypt($password);
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
