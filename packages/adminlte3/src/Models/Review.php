<?php namespace Adminlte3\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Adminlte3\Review
 *
 * @property int $id
 * @property string $name
 * @property string|null $text
 * @property int $on_main
 * @property int published
 * @property int $order
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|Review onMain()
 * @method static Builder|Review public()
 * @method static Builder|Review whereCreatedAt($value)
 * @method static Builder|Review whereId($value)
 * @method static Builder|Review whereOnMain($value)
 * @method static Builder|Review whereOrder($value)
 * @method static Builder|Review whereText($value)
 * @method static Builder|Review whereType($value)
 * @method static Builder|Review whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|Review newModelQuery()
 * @method static Builder|Review newQuery()
 * @method static Builder|Review query()
 */
class Review extends Model {

	protected $table = 'reviews';

	protected $guarded = ['id'];

	public function scopeOnMain($query)
	{
		return $query->where('on_main', 1);
	}

    public function scopePublic($query)
    {
        return $query->where('published', 1);
    }
}
