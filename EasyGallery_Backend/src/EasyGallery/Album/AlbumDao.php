<?php
namespace EasyGallery\Album;

use EasyGallery\ArrayUtils;
use EasyGallery\Album\AlbumDto;

class AlbumDao {

	private $images_path;

	public function __construct($images_path) {
		$this->images_path = $images_path;
	}

	/**
	 * @return \EasyGallery\AlbumDto
	 */
	public function list_album(callable $filter = NULL, $album = NULL) {
		$album_path = $this->images_path;
		if ($album) {
			$album_path .= DIRECTORY_SEPARATOR.$album;
		}
		$files = scandir($album_path);
		if ($filter) {
			$files = array_filter($files, $filter);
		}
		return new AlbumDto($album_path, $files);
	}

	public function find_first_image(callable $matcher, $album = NULL) {
		$dto = $this->list_album(NULL, $album);
		$image = ArrayUtils::binary_find_first($dto->get_images(), $matcher);
		return $dto->get_album_path().DIRECTORY_SEPARATOR.$image;
	}
}
?>