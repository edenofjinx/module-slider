<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Api\Data\Slider;

interface FrontpageSliderInterface
{

    const SLIDER_ENTITY_ID = 'entity_id';
    const SLIDER_IMAGE_URL = 'image_url';
    const SLIDER_IMAGE_POSITION = 'position';

    /**
     * @return string|null
     */
    public function getSliderId();

    /**
     * @param $sliderId
     * @return $this
     */
    public function setSliderId($sliderId);

    /**
     * @return string|null
     */
    public function getSliderImageUrl();

    /**
     * @param $sliderImageUrl
     * @return $this
     */
    public function setSliderImageUrl($sliderImageUrl);

    /**
     * @return string|null
     */
    public function getSliderImagePosition();

    /**
     * @param $sliderImagePosition
     * @return $this
     */
    public function setSliderImagePosition($sliderImagePosition);

}
