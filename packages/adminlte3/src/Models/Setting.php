<?php namespace Adminlte3\Models;;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Setting
 *
 * @property int $id
 * @property int $group_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $params
 * @property string $value
 * @property int $type
 * @property int $order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read SettingGroup $group
 * @method static Builder|Setting whereCode($value)
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereDescription($value)
 * @method static Builder|Setting whereGroupId($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereName($value)
 * @method static Builder|Setting whereOrder($value)
 * @method static Builder|Setting whereParams($value)
 * @method static Builder|Setting whereType($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 */
class Setting extends Model {

	protected $table = 'settings';

	protected $fillable = ['group_id', 'code', 'name', 'description', 'params', 'value', 'type', 'order'];

	protected $casts = [
		'params' => 'array',
	];

	const UPLOAD_PATH = '/public/uploads/settings/';
	const UPLOAD_URL = '/uploads/settings/';

    public static array $extensions = [
        'jpg', 'jpeg', 'png', 'gif', 'ico', 'svg'
    ];

	public static array $types = [
    	0 => 'Одна строка', // input type=text
    	1 => 'Много строк', // textarea
    	2 => 'Визивик', // Визивик
        3 => 'Файл', // Файл
        4 => 'Несколько полей', // Ассоциативный массив
        5 => 'Простой список', // Массив строк
        6 => 'Настраиваемый список', // Массив с параметрами
        7 => 'Галерея изображений',
    ];

	public function group(): BelongsTo
    {
		return $this->belongsTo(SettingGroup::class, 'group_id');
	}

	public function getValueAttribute($value)
	{
		switch ($this->type) {
            case 4:
            case 5:
            case 6:
            case 7:
                $json = json_decode($value, true);
                return is_array($json) ? $json : [];
                break;

            default:
                return $value;
                break;
        }
	}
}
