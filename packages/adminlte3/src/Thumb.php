<?php namespace Adminlte3;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;

class Thumb {

	private static string $dir = '/thumbs';
	private static string $postfix = '.thumb_';

	public static function url($url, $thumb): string
    {
		$path_parts = pathinfo($url);
		return self::$dir . $path_parts['dirname'] . '/' . $path_parts['filename'] . self::$postfix . $thumb . '.' . $path_parts['extension'];
	}

	public static function make($url, $thumb, $size = null, $fit = null): bool|int
    {
		if (is_array($thumb)) {
			$result = 0;
			foreach ($thumb as $key => $value) {
				$params = explode('|', $value);
				if (self::make($url, $key, $params[0], Arr::get($params, 1, null))) $result++;
			}
			return $result;
		}
		if (!$size) return false;

		$sizes = explode('x', $size);
		$width = Arr::get($sizes, 0);
		$height = Arr::get($sizes, 1);

		$thumb_file = base_path('/public' . self::url($url, $thumb));
		$thumb_dir = pathinfo($thumb_file, PATHINFO_DIRNAME);
		if (!is_dir($thumb_dir)) mkdir($thumb_dir, 0775, true);

		$image = Image::make(base_path('/public' . $url));
		if ($fit == 'fit') {
			$image->fit($width, $height);
		} else {
			$image->resize($width, $height, function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});
		}

		$image->save($thumb_file, Settings::get('image_quality', 100));

        self::webpImage($thumb_file, Settings::get('image_quality', 100));
		return true;
	}

	public static function delete($url): ?int
    {
		$path_parts = pathinfo($url);
		$pattern = public_path(self::$dir . $path_parts['dirname'] . '/' . $path_parts['filename'] . self::$postfix . '*.' . $path_parts['extension']);
		if ($items = glob($pattern)) {
			foreach ($items as $item) {
				@unlink($item);
			}
		}
		return empty($items) ? null : count($items);
	}

	public static function get($url, $size, $fit = false, $thumb_key = null): ?string
    {
		if (!$thumb_key) $thumb_key = $size.($fit ? '_fit' : '');
		$thumb_url = self::url($url, $thumb_key);

		if (file_exists(public_path($thumb_url))) return $thumb_url;

		if (self::make($url, $thumb_key, $size, $fit)) return $thumb_url;

		return null;
	}

    public static function webpImage($source, $quality = 100, $removeOld = false)
    {
        $dir = pathinfo($source, PATHINFO_DIRNAME);
        $name = pathinfo($source, PATHINFO_FILENAME);
        $destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info = getimagesize($source);
        $isAlpha = false;
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($source);

        return $destination;
    }
}
