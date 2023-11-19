<?php namespace Adminlte3\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Adminlte3\Models\AdminLog
 *
 * @property int $id
 * @property string $user
 * @property string $msg
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|AdminLog whereCreatedAt($value)
 * @method static Builder|AdminLog whereId($value)
 * @method static Builder|AdminLog whereMsg($value)
 * @method static Builder|AdminLog whereUpdatedAt($value)
 * @method static Builder|AdminLog whereUser($value)
 * @mixin \Eloquent
 * @property string $ip
 * @method static Builder|AdminLog whereIp($value)
 * @method static Builder|AdminLog newModelQuery()
 * @method static Builder|AdminLog newQuery()
 * @method static Builder|AdminLog query()
 */
class AdminLog extends Model {

	protected $guarded = ['id'];

	/* сколько дней хранить */
	public static int $store_days = 60;

	public static function add($msg) {
		$user = Auth::user();

		$name = ($user) ? $user->name : 'console';
		$ip = \Request::ip();
		$data = [
			'user' => $name,
			'ip'   => $ip,
			'msg'  => $msg
		];

		self::create($data);
		self::where('created_at', '<', Carbon::now()->subDay(self::$store_days))->delete();
	}

	public static function last($count = 10): Collection
    {
        return self::orderBy('created_at', 'desc')->limit($count)->get();
	}
}
