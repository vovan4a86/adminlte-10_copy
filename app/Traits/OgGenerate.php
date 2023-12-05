<?php namespace App\Traits;

use Artesaos\SEOTools\Facades\OpenGraph;

/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 19.12.2017
 * Time: 11:09
 */


trait OgGenerate{
	public function ogGenerate() {

		OpenGraph::setUrl($this->url);
		if($this->og_title || $this->title){
			OpenGraph::setTitle($this->og_title ?: $this->title);
		}
		if($this->og_description || $this->description){
			OpenGraph::setDescription($this->og_description ?: $this->description);
		}
		if($this->image_src){
			OpenGraph::addImage($this->image ? $this->image_src : '/apple-touch-icon.png');
		}
	}
}
