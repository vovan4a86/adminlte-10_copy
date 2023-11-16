<?php
namespace Adminlte3\Models;

use Adminlte3\SiteHelper;
use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use Database\Factories\NewsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Adminlte3\News
 *
 * @property int $id
 * @property int $published
 * @property string|null $date
 * @property string $name
 * @property string|null $announce
 * @property string|null $text
 * @property string $image
 * @property string $alias
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $image_src
 * @property-read mixed $url
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|News onlyTrashed()
 * @method static Builder|News public ()
 * @method static bool|null restore()
 * @method static Builder|News whereAlias($value)
 * @method static Builder|News whereAnnounce($value)
 * @method static Builder|News whereCreatedAt($value)
 * @method static Builder|News whereDate($value)
 * @method static Builder|News whereDeletedAt($value)
 * @method static Builder|News whereDescription($value)
 * @method static Builder|News whereId($value)
 * @method static Builder|News whereImage($value)
 * @method static Builder|News whereKeywords($value)
 * @method static Builder|News whereName($value)
 * @method static Builder|News wherePublished($value)
 * @method static Builder|News whereText($value)
 * @method static Builder|News whereTitle($value)
 * @method static Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|News withoutTrashed()
 * @mixin Eloquent
 * @property string $h1
 * @property string|null $og_title
 * @property string|null $og_description
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News query()
 * @method static Builder|News whereH1($value)
 * @method static Builder|News whereOgDescription($value)
 * @method static Builder|News whereOgTitle($value)
 */
class News extends Model
{

    use HasImage, HasH1, HasSeo, HasFactory;

    protected static function newFactory()
    {
        return NewsFactory::new();
    }

    protected $table = 'news';

    protected $guarded = ['id'];

    protected $casts = [
        'published' => 'bool'
    ];

    const UPLOAD_URL = '/uploads/news/';

    public static array $thumbs = [
        1 => '100x50', //admin
        2 => '119x119|fit', //top_list
        3 => '285x160|fit', //news_list
    ];

    public function scopePublic($query)
    {
        return $query->where('published', 1);
    }

    public function getUrlAttribute(): string
    {
        return route('news.item', ['alias' => $this->alias]);
    }

    public function dateFormat($format = 'd.m.Y'): array|string|null
    {
        if (!$this->date) {
            return null;
        }
        $date = date($format, strtotime($this->date));
        return str_replace(
            array_keys(SiteHelper::$monthRu),
            SiteHelper::$monthRu,
            $date
        );
    }

    public static function last($count = 2)
    {
        return self::orderBy('date', 'desc')->public()->limit($count)->get();
    }

    public function getLastModify(): ?Carbon
    {
        return $this->updated_at;
    }

}
