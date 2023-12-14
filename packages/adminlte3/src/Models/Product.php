<?php
namespace Adminlte3\Models;

use App\Traits\HasFile;
use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Adminlte3\Nodels\Product
 *
 * @property int $id
 * @property int $catalog_id
 * @property string $name
 * @property string $alias
 * @property string|null $text
 * @property int $price
 * @property int $old_price
 * @property string $image
 * @property int $published
 * @property boolean $on_main
 * @property int $order
 * @property string $title
 * @property string $measure
 * @property string $keywords
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $h1
 * @property string|null $price_name
 * @property string|null $og_title
 * @property string|null $characteristic
 * @property string|null $characteristic2
 * @property string|null $og_description
 * @property-read Catalog $catalog
 * @property-read mixed $image_src
 * @property-read mixed $url
 * @property-read Collection|ProductImage[] $images
 * @property int|mixed in_stock
 * @method static bool|null forceDelete()
 * @method static Builder|Product onMain()
 * @method static Builder|Product public ()
 * @method static bool|null restore()
 * @method static Builder|Product whereAlias($value)
 * @method static Builder|Product whereCatalogId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereKeywords($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereOnMain($value)
 * @method static Builder|Product whereOrder($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product wherePriceUnit($value)
 * @method static Builder|Product wherePublished($value)
 * @method static Builder|Product whereText($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUnit($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBalance($value)
 * @method static Builder|Product whereCharacteristic($value)
 * @method static Builder|Product whereCharacteristic2($value)
 * @method static Builder|Product whereComment($value)
 * @method static Builder|Product whereCutting($value)
 * @method static Builder|Product whereGost($value)
 * @method static Builder|Product whereH1($value)
 * @method static Builder|Product whereLength($value)
 * @method static Builder|Product whereOgDescription($value)
 * @method static Builder|Product whereOgTitle($value)
 * @method static Builder|Product wherePriceName($value)
 * @method static Builder|Product whereSize($value)
 * @method static Builder|Product whereSteel($value)
 * @method static Builder|Product whereWall($value)
 * @method static Builder|Product whereWarehouse($value)
 * @method static Builder|Product whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasSeo, HasH1, HasFile, HasImage, HasFactory;

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    protected array $_parents = [];

    protected $guarded = ['id'];

    const UPLOAD_PATH = '/public/uploads/products/';
    const UPLOAD_URL = '/uploads/products/';

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->orderBy('order');
    }

    public function image(): HasOne
    {
        return $this->hasOne(ProductImage::class, 'product_id')
            ->orderBy('order');
    }

    public function chars(): HasMany
    {
        return $this->hasMany(ProductChar::class)
            ->orderBy('order');
    }

    public function docs(): HasMany
    {
        return $this->hasMany(ProductDoc::class)
            ->orderBy('order');
    }

    public function related(): HasMany
    {
        return $this->hasMany(ProductRelated::class, 'product_id');
//            ->join('products', 'product_related.related_id', '=', 'products.id');
    }

    public function additional_catalogs(): BelongsToMany
    {
        return $this->belongsToMany(Catalog::class);
    }

    public function scopePublic($query)
    {
        return $query->where('published', 1);
    }

    public function scopeIsAction($query)
    {
        return $query->where('is_action', 1);
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', 1);
    }

    public function scopeOnMain($query)
    {
        return $query->where('on_main', 1);
    }

    public function getImageSrcAttribute($value)
    {
        return ($this->image)
            ? $this->image->image_src
            : null;
    }

    public function thumb($thumb)
    {
        return ($this->image)
            ? $this->image->thumb($thumb)
            : null;
    }

    public function getUrlAttribute(): string
    {
        return $this->catalog->url . '/' . $this->alias;
    }

    public function getParents($with_self = false, $reverse = false): array
    {
        $parents = [];
        if ($with_self) {
            $parents[] = $this;
        }
        $parents = array_merge($parents, $this->catalog->getParents(true));
        $parents = array_merge($parents, $this->_parents);
        if ($reverse) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }

    public function delete()
    {
        foreach ($this->images as $image) {
            $image->delete();
        }

        parent::delete();
    }

    public function getBread(): array
    {
        $bread = $this->catalog->getBread();
        $bread[] = [
            'url' => $this->url,
            'name' => $this->name
        ];

        return $bread;
    }

    public function showAnyImage(): ?string
    {
        $cat_image = Catalog::whereId($this->catalog_id)->first();
        return $cat_image->image ? Catalog::UPLOAD_URL . $cat_image->image : null;
    }

    private function replaceTemplateVariable($template): array|string
    {
        $replace = [
            '{name}' => $this->name,
            '{lower_name}' => Str::lower($this->name),
            '{price}' => $this->price ?: 'не указана',
            '{article}' => $this->article,
            '{sides}' => $this->sides,
            '{format}' => $this->format,
            '{montage}' => $this->montage,
            '{power}' => $this->power,
        ];

        return str_replace(array_keys($replace), array_values($replace), $template);
    }

    public function getTitleTemplate($catalog_id = null)
    {
        if (!$catalog_id) {
            $catalog_id = $this->catalog_id;
        }
        $catalog = Catalog::find($catalog_id);
        if (!$catalog) {
            return null;
        }
        if (!empty($catalog->product_title_template)) {
            return $catalog->product_title_template;
        }
        if ($catalog->parent_id) {
            return $this->getTitleTemplate($catalog->parent_id);
        }

        return self::$defaultTitleTemplate;
    }

    public static string $defaultTitleTemplate = '{name} купить';

    public function generateTitle()
    {
        if (!($template = $this->getTitleTemplate())) {
            if ($this->title && $this->title != $this->name) {
                $template = $this->title;
            } else {
                $template = self::$defaultTitleTemplate;
            }
        }

//        if (strpos($template, '{city}') === false) { //если кода city нет - добавляем
//            $template .= '{city}';
//        }
        $this->title = $this->replaceTemplateVariable($template);
    }

    public function getDescriptionTemplate($catalog_id = null)
    {
        if (!$catalog_id) {
            $catalog_id = $this->catalog_id;
        }
        $catalog = Catalog::find($catalog_id);
        if (!$catalog) {
            return null;
        }
        if (!empty($catalog->product_description_template)) {
            return $catalog->product_description_template;
        }
        if ($catalog->parent_id) {
            return $this->getDescriptionTemplate($catalog->parent_id);
        }

        return self::$defaultDescriptionTemplate;
    }

    public function getTextTemplate($catalog_id = null)
    {
        if (!$catalog_id) {
            $catalog_id = $this->catalog_id;
        }
        $catalog = Catalog::find($catalog_id);
        if (!$catalog) {
            return null;
        }
        if (!empty($catalog->product_text_template)) {
            return $catalog->product_text_template;
        }
        if ($catalog->parent_id) {
            return $this->getTextTemplate($catalog->parent_id);
        }

        return null;
    }

    public static $defaultDescriptionTemplate = '{name} купить по выгодной цене';

    public function generateDescription()
    {
        if (!($template = $this->getDescriptionTemplate())) {
            if (!$template && $this->description) {
                $template = $this->description;
            } else {
                $template = self::$defaultDescriptionTemplate;
            }
        }

//        if (strpos($template, '{city}') === false) { //если кода city нет - добавляем
//            $template .= '{city}';
//        }

        $this->description = $this->replaceTemplateVariable($template);;
    }

    public function generateText()
    {
        $template = $this->getTextTemplate();
        if (!$template) {
            $template = $this->text;
        }

        $this->text = $this->replaceTemplateVariable($template);
    }

    public function generateKeywords()
    {
        if (!$this->keywords) {
            $this->keywords = mb_strtolower($this->name . ' цена, ' . $this->name . ' купить, ' . $this->name . '');
        }
    }

    public function getProductOrderView(): ?string
    {
        if ($this->price) {
            return 'catalog.blocks.product_order_t';
        } elseif ($this->price_per_item) {
            return 'catalog.blocks.product_order_item';
//        } elseif($this->price_per_kilo) {
//            return number_format($this->price_per_kilo, '0', '',' ');
//        } elseif($this->price_per_metr) {
//            return number_format($this->price_per_metr, '0', '',' ');
//        } elseif($this->price_per_m2) {
//            return number_format($this->price_per_m2, '0', '',' ');
        } else {
            return 'catalog.blocks.product_order_other';
        }
    }

    public function makeArticle($id): string
    {
        return str_pad($id, 6, '0', STR_PAD_LEFT);
    }

    public static function isPdf($file_name): bool
    {
        $end = explode('.', $file_name);
        return array_pop($end) == 'pdf';
    }

    public function getCharByName($name)
    {
        $ch = $this->chars()->where('name', $name)->first('value');
        if ($ch) {
            return $ch->value;
        }
        return null;
    }

    public function getImage($thumb_size = 2): string
    {
        if ($img = $this->images()->first()) {
            return $img->thumb($thumb_size, $this->catalog->alias);
        }

        return ProductImage::NO_IMAGE;
    }

}
