<?php namespace App\Traits;
use Adminlte3\Settings;
use Adminlte3\Thumb;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Application;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait HasImage{
	public string $image_field = 'image';

    public function getWebpFileName()
    {
        $arr = explode('.', $this->{$this->image_field});
        if (count($arr) == 2) {
            $arr[1] = 'webp';
            return implode('.', $arr);
        }
    }

	public function deleteImage($thumbs = null, $upload_url = null): void
    {
		if(!$this->{$this->image_field}) return;
		if(!$thumbs){
			$thumbs = self::$thumbs;
		}
		if(!$upload_url){
			$upload_url = self::UPLOAD_URL;
		}

		foreach ($thumbs as $thumb => $size){
			$t = Thumb::url($upload_url . $this->{$this->image_field}, $thumb);
            $webp = Thumb::url($upload_url . $this->getWebpFileName(), $thumb);
			@unlink(public_path($t));
			@unlink(public_path($webp));
		}
		@unlink(public_path($upload_url . $this->{$this->image_field}));
		@unlink(public_path($upload_url . $this->getWebpFileName()));
	}

	public function getImageSrcAttribute(): Application|string|UrlGenerator|\Illuminate\Contracts\Foundation\Application|null
    {
		return $this->{$this->image_field} ? url(self::UPLOAD_URL . $this->{$this->image_field}) : null;
	}

	public function thumb($thumb): Application|string|UrlGenerator|\Illuminate\Contracts\Foundation\Application|null
    {
		if (!$this->{$this->image_field}) {
			return null;
		} else {
			$file = public_path(self::UPLOAD_URL . $this->{$this->image_field});
			$file = str_replace(['\\\\', '//'], DIRECTORY_SEPARATOR, $file);
			$file = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $file);

			if (!is_file(public_path(Thumb::url(self::UPLOAD_URL . $this->{$this->image_field}, $thumb)))) {
				if (!is_file($file))
					return null; //нет исходного файла
				//создание миниатюры
				Thumb::make(self::UPLOAD_URL . $this->{$this->image_field}, self::$thumbs);
			}

			return url(Thumb::url(self::UPLOAD_URL . $this->{$this->image_field}, $thumb));
		};
	}

	public static function uploadImage(UploadedFile $image): string
    {
		$file_name = md5(uniqid(rand(), true)) . '_' . time() . '.' . Str::lower($image->clientExtension());
        $image->move(public_path(self::UPLOAD_URL), $file_name);
		Image::make(public_path(self::UPLOAD_URL . $file_name))
			->resize(1920, 1080, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})
			->save(null, Settings::get('image_quality', 100));

        self::webpImage(public_path(self::UPLOAD_URL . $file_name),
            Settings::get('image_quality', 100));

		Thumb::make(self::UPLOAD_URL . $file_name, self::$thumbs);
		return $file_name;
	}

    public static function uploadIcon($image): string
    {
		$file_name = md5(uniqid(rand(), true)) . '_' . time() . '.' . Str::lower($image->getClientOriginalExtension());
		$image->move(public_path(self::UPLOAD_URL), $file_name);
		return $file_name;
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
