<?php

use EasyGallery\Album\AlbumDao;

class EasyGallery_ImageService {
	
	private $dao;
	
	public function __construct() {
		$this->dao = new AlbumDao(IMAGES_PATH);
	}
	
	public function get_image($code) {
		$header = $code . '-';
		$header_len = strlen($header);
		$img_path = $this->dao->find_first_image(function ($file) use ($header, $header_len) {
			return strnatcmp(substr($file, 0, $header_len), $header);
		});
		$data = file_get_contents($img_path);
		return new Amfphp_Core_Amf_Types_ByteArray($data ? $data : '');
	}

}

?>