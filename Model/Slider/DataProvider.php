<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Model\Slider;

use Custom\FrontpageSlider\Model\ResourceModel\FrontpageSliderFormCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        FrontpageSliderFormCollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $collection = $this->collection->create()->setOrder('position', 'ASC');
        $items = $collection->getItems();
        $this->loadedData = [];
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $i = 0;
        foreach ($items as $item) {
            $imageName = explode('/', $item->getImageUrl());
            $imageName = end($imageName);
            $this->loadedData['stores']['frontpage_slider_container'][$i] = $item->getData();
            unset($this->loadedData['stores']['frontpage_slider_container'][$i]['image_url']);
            $this->loadedData['stores']['frontpage_slider_container'][$i]['image_url'][0]['name'] = $imageName;
            $this->loadedData['stores']['frontpage_slider_container'][$i]['image_url'][0]['url'] =
                $mediaUrl . $item->getImageUrl();
            $i++;
        }
        return $this->loadedData;
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }
}
