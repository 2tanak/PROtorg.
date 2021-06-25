<?php

namespace Modules\Entity\Model\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoveltyPhoto extends Model
{
    use HasFactory;

    protected $table = 'news_photos';

    protected $fillable = [
        'news_id',
        'photo',
        'alt_kz',
        'alt_ru'
    ];
}
