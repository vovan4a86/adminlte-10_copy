<?php

namespace Adminlte3\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * SettingGroup
 *
 * @property int $id
 * @property int $page_id
 * @property string $name
 * @property string $description
 * @property int $order
 * @method static Builder|SettingGroup whereDescription($value)
 * @method static Builder|SettingGroup whereId($value)
 * @method static Builder|SettingGroup whereName($value)
 * @method static Builder|SettingGroup whereOrder($value)
 * @method static Builder|SettingGroup wherePageId($value)
 */
class SettingGroup extends Model {

	protected $table = 'settings_groups';

	public $timestamps = false;

	protected $fillable = ['name', 'description', 'order'];

	public function settings(): HasMany
    {
		return $this->hasMany(Setting::class, 'group_id');
	}
}
