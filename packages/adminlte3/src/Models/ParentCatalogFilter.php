<?php namespace Adminlte3\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParentCatalogFilter extends Model {

	protected $table = 'catalog_parent_filters';

	protected $guarded = ['id'];

	public $timestamps = false;

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }

    public function scopePublic($query) {
        return $query->where('published', 1);
    }
}
