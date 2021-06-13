<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Api\Data\Slider;

use Magento\Framework\Api\SearchResultsInterface;
use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderInterface;

interface FrontpageSliderSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get assets list.
     *
     * @return FrontpageSliderInterface[]
     */
    public function getItems();

    /**
     * Set assets list.
     *
     * @param FrontpageSliderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}
