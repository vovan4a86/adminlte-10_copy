<?php namespace App\Traits;

use Artesaos\SEOTools\Facades\SEOMeta;

trait HasSeo{
	public function setSeo() {
        SEOMeta::setTitle($this->title ?? $this->name);
        SEOMeta::setDescription($this->description);
        SEOMeta::setKeywords($this->keywords);
	}
}
