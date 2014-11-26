<?php
namespace EasyGallery;

use PHPThumb\GD;

class ThumbFactory {
	
	private $base_path;
	private $relative_path;
	
	public function __construct($thumbs_path, $album = NULL) {
		$this->relative_path = $album;
		$album_thumbs_path = $thumbs_path.DIRECTORY_SEPARATOR.$album;
		if (!file_exists($album_thumbs_path)) {
			mkdir($album_thumbs_path);
		}
		$this->base_path = realpath($album_thumbs_path);
	}
	
	public function get_thumb_relative_path($img, $img_path) {
		$thumb_path = $this->base_path.DIRECTORY_SEPARATOR.$img;
		if (!file_exists($thumb_path)) {
			$this->create_thumb($thumb_path, $img_path);
		}
		return $this->relative_path.'/'.$img;
	}
	
	private function create_thumb($thumb_path, $img_path) {
		$gd = new GD($img_path);
		$gd->adaptiveResize(100, 100);
		$gd->save($thumb_path);
	}
	
}