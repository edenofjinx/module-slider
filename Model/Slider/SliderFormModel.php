<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Model\Slider;

use Magento\Framework\Model\AbstractModel;
use Custom\FrontpageSlider\Model\ResourceModel\FrontpageSliderResourceModel;

class SliderFormModel extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(FrontpageSliderResourceModel::class);
    }
}
