<?php namespace Adminlte3\Models;

use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDoc extends Model {

    use HasFile;

    protected $table = 'product_docs';

    const UPLOAD_URL = '/uploads/products-docs/';
    const DOC_ICON = '/adminlte/doc_icon.png';

    protected $guarded = ['id'];

	public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
