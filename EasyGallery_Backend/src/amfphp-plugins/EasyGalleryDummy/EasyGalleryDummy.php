<?php


class EasyGalleryDummy implements Amfphp_Core_Common_IDeserializer, Amfphp_Core_Common_IDeserializedRequestHandler, Amfphp_Core_Common_IExceptionHandler, Amfphp_Core_Common_ISerializer
{
    /**
* if content type is not set or content is set to "application/x-www-form-urlencoded", this plugin will handle the request
*/
    const CONTENT_TYPE = "application/x-www-form-urlencoded";

    protected $serviceName;
    protected $methodName;
    protected $parameters;
    protected $parametersAssoc;
    protected $serviceRouter;
    protected $showResult;
    protected $callStartTimeMs;
    protected $callDurationMs;
    protected $returnErrorDetails = false;
    
    private $target_file;

    public function __construct(array $config = null)
    {
        $filterManager = Amfphp_Core_FilterManager::getInstance();
        $filterManager->addFilter(Amfphp_Core_Gateway::FILTER_DESERIALIZER, $this, "filterHandler");
        $filterManager->addFilter(Amfphp_Core_Gateway::FILTER_DESERIALIZED_REQUEST_HANDLER, $this, "filterHandler");
        $filterManager->addFilter(Amfphp_Core_Gateway::FILTER_EXCEPTION_HANDLER, $this, "filterHandler");
        $filterManager->addFilter(Amfphp_Core_Gateway::FILTER_SERIALIZER, $this, "filterHandler");
        $filterManager->addFilter(Amfphp_Core_Gateway::FILTER_HEADERS, $this, "filterHeaders");
        $this->returnErrorDetails = (isset($config[Amfphp_Core_Config::CONFIG_RETURN_ERROR_DETAILS]) && $config[Amfphp_Core_Config::CONFIG_RETURN_ERROR_DETAILS]);
        $this->target_file = (isset($config['dummy_handler'])) ? $config['dummy_handler'] : realpath(dirname(__FILE__) . '/unsupported.html');
    }

    public function filterHandler($handler, $contentType)
    {
        if (!$contentType || $contentType == self::CONTENT_TYPE) {
            return $this;
        }
    }

    public function deserialize(array $getData, array $postData, $rawPostData)
    {
        $ret = new stdClass();

        return $ret;
    }

    public function handleDeserializedRequest($deserializedRequest, Amfphp_Core_Common_ServiceRouter $serviceRouter)
    {
    }

    public function handleException(Exception $exception)
    {
    }

    public function serialize($data)
    {
        include $this->target_file;
    }

    public function filterHeaders($headers, $contentType)
    {
        if (!$contentType || $contentType == self::CONTENT_TYPE) {
            return array();
        }
    }

}
