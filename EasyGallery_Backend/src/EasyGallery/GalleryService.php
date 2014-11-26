<?php

namespace EasyGallery;

use EasyGallery\Album\AlbumDao;
use EasyGallery\Album\AlbumDto;
use EasyGallery\ThumbFactory;

class GalleryService {
	
	private $thumbs_path;
	private $dao;
	
	public function __construct($thumbs_path, $images_path) {
		$this->dao = new AlbumDao ( $images_path );
		$this->thumbs_path = $thumbs_path;
	}
	
	public function print_images($offset, $count, callable $printer, $album = NULL) {
		$thumb_factory = new ThumbFactory($this->thumbs_path, $album);
		$dto = $this->dao->list_album ( function ($file) {
			return '.' != substr($file, 0, 1);
		}, $album );
		$images = array_slice ( $dto->get_images (), $offset, $count );
		foreach ( $images as $img ) {
			$img_path = $dto->get_album_path().DIRECTORY_SEPARATOR.$img;
			$thumb_path = $thumb_factory->get_thumb_relative_path($img, $img_path);
			$code = substr($img, 0, strpos($img, "-"));
			$printer($code, $img_path, $thumb_path);
		}
	}
}

?>