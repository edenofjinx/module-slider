<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Custom\FrontpageSlider\Model\ResourceModel\FrontpageSliderResourceModel;
use Custom\FrontpageSlider\Model\Slider\SliderFormModel;

class FrontpageSliderFormCollection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(SliderFormModel::class, FrontpageSliderResourceModel::class);
    }
}
