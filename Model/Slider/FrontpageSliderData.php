<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Model\Slider;

use Magento\Framework\Model\AbstractModel;
use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderInterface;
use Custom\FrontpageSlider\Model\ResourceModel\FrontpageSliderResourceModel;

class FrontpageSliderData extends AbstractModel implements FrontpageSliderInterface
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(FrontpageSliderResourceModel::class);
        parent::_construct();
    }

    public function getSliderId()
    {
        return $this->getData(self::SLIDER_ENTITY_ID);
    }

    public function setSliderId($sliderId)
    {
        return $this->setData(self::SLIDER_ENTITY_ID, $sliderId);
    }

    public function getSliderImageUrl()
    {
        return $this->getData(self::SLIDER_IMAGE_URL);
    }

    public function setSliderImageUrl($sliderImageUrl)
    {
        return $this->setData(self::SLIDER_IMAGE_URL, $sliderImageUrl);
    }

    public function getSliderImagePosition()
    {
        return $this->getData(self::SLIDER_IMAGE_POSITION);
    }

    public function setSliderImagePosition($sliderImagePosition)
    {
        return $this->setData(self::SLIDER_IMAGE_POSITION, $sliderImagePosition);
    }
}
