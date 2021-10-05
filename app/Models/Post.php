<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function getTitleAttribute()
    // {
    //     $lang = app()->currentLocale();
    //     $title = "title_$lang";
    //     return $this->$title;
    // }

    // public function getContentAttribute()
    // {
    //     $lang = app()->currentLocale();
    //     $title = "content_$lang";
    //     return $this->$title;
    // }


    public function getTransTitleAttribute()
    {
        $lang = app()->currentLocale();
        return json_decode($this->title)->$lang;
    }

    public function getTransContentAttribute()
    {
        $lang = app()->currentLocale();
        return json_decode($this->content)->$lang;
    }
}
