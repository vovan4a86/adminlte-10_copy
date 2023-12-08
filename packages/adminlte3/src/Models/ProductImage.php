<?php namespace Adminlte3\Models;

use App\Traits\HasImage;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Adminlte3\Models\ProductImage
 *
 * @property int        $id
 * @property int        $product_id
 * @property string     $image
 * @property int        $order
 * @property-read mixed $src
 * @method static Builder|ProductImage whereId($value)
 * @method static Builder|ProductImage whereImage($value)
 * @method static Builder|ProductImage whereOrder($value)
 * @method static Builder|ProductImage whereProductId($value)
 * @mixin Eloquent
 * @property-read mixed $image_src
 * @method static Builder|ProductImage newModelQuery()
 * @method static Builder|ProductImage newQuery()
 * @method static Builder|ProductImage query()
 */
class ProductImage extends Model {

	use HasImage;
	protected $table = 'product_images';

	protected $fillable = ['product_id', 'image', 'order'];

	public $timestamps = false;

	const UPLOAD_URL = '/uploads/products/';
	const NO_IMAGE = '/vendor/no_image';

	public static array $thumbs = [
		1 => '116x90', //admin product
		2 => '270x210|fit', //catalog list
		3 => '470x366|fit', //product
	];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
