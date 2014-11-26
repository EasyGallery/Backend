<?php
namespace EasyGallery;

use Amfphp_Core_Config;
use Amfphp_Core_HttpRequestGatewayFactory;

class GalleryEndpoint {
	
	private $gateway;
	
	public function __construct($images_path, $unsupported_method_handler = NULL) {
		defined('IMAGES_PATH') or define('IMAGES_PATH', $images_path);
		$cfg = new Amfphp_Core_Config();
		$cfg->serviceFolderPaths[] = dirname(__FILE__) . '/../amfphp-services/';
		$cfg->pluginsFolders[] = dirname(__FILE__) . '/../amfphp-plugins/';
		if ($unsupported_method_handler) {
			$cfg->pluginsConfig['EasyGalleryDummy'] = array('dummy_handler' => $unsupported_method_handler);
		} 
		$cfg->disabledPlugins[] = 'AmfphpGet';
		$cfg->disabledPlugins[] = 'AmfphpJson';
		$cfg->disabledPlugins[] = 'AmfphpDiscovery';
		$cfg->disabledPlugins[] = 'AmfphpMonitor';
		$cfg->disabledPlugins[] = 'AmfphpDummy';
		
		$this->gateway = Amfphp_Core_HttpRequestGatewayFactory::createGateway($cfg);
	}

	public function listen() {
		$this->gateway->service();
		$this->gateway->output();
	}
	
}