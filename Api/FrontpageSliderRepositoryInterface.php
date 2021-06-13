<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Api;

use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderInterface;
use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;

interface FrontpageSliderRepositoryInterface
{

    /**
     *
     * @param int $sliderId
     * @return FrontpageSliderInterface
     */
    public function get(int $sliderId);

    /**
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return FrontpageSliderSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     *
     * @param FrontpageSliderInterface $sliderData
     * @return FrontpageSliderInterface
     * @throws CouldNotSaveException
     */
    public function save(FrontpageSliderInterface $sliderData);

    /**
     * @param int $sliderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $sliderId);

    /**
     * @return mixed
     */
    public function delete();

}
