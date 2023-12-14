<?php

namespace Adminlte3\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsTag extends Model
{
    protected $guarded = ['id'];

    protected $table = 'news_tags';

    public $timestamps = false;

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class);
    }

}
