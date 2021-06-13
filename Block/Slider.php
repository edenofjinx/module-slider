<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Block;

use Custom\FrontpageSlider\Helper\Config;
use Magento\Framework\View\Element\Template;
use Custom\FrontpageSlider\Model\ResourceModel\FrontpageSliderFormCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Slider extends Template
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var FrontpageSliderFormCollectionFactory
     */
    protected $collection;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Config $config,
        FrontpageSliderFormCollectionFactory $collection,
        StoreManagerInterface $storeManager,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->collection = $collection;
        $this->storeManager = $storeManager;
    }

    public function isActive()
    {
        return $this->config->getActive();
    }

    public function getSlideCollection()
    {
        if (!$this->isActive()) {
            return [];
        }
        return $this->collection->create()->setOrder('position', 'ASC');
    }

    public function getMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
