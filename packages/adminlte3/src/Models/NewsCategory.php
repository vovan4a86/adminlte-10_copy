<?php

namespace Adminlte3\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsCategory extends Model
{
    protected $guarded = ['id'];

    protected $table = 'news_categories';

    public $timestamps = false;

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

}
