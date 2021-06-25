<?php

namespace Modules\Entity\Model\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoveltyStatus extends Model
{
    use HasFactory;

    protected $table = 'news_statuses';

    protected $fillable = [
        'name_kz',
        'name_ru'
    ];
}
