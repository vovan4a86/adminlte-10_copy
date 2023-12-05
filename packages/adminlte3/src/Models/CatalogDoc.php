<?php namespace Adminlte3\Models;

use App\Traits\HasFile;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CatalogDoc extends Model {

    use HasFile;

    protected $table = 'catalog_docs';

    const UPLOAD_URL = '/uploads/catalog-docs/';
    const DOC_ICON = '/adminlte/doc_icon.png';

    protected $guarded = ['id'];

	public $timestamps = false;

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }
}
