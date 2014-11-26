<?php
namespace EasyGallery\Album;

class AlbumDto {

	private $album_path;
	private $images;

	public function __construct($album_path, array $images) {
		$this->album_path = $album_path;
		$this->images = $images;
	}

	public function get_images() {
		return $this->images;
	}

	public function get_album_path() {
		return $this->album_path;
	}
}

?>
