<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Model;

use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderInterface;
use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderSearchResultsInterface;
use Custom\FrontpageSlider\Api\FrontpageSliderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Custom\FrontpageSlider\Model\ResourceModel\FrontpageSliderResourceModel;
use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderInterfaceFactory;

class SliderRepository implements FrontpageSliderRepositoryInterface
{

    protected $sliderResource;

    protected $sliderFactory;

    public function __construct(
        FrontpageSliderResourceModel $sliderResource,
        FrontpageSliderInterfaceFactory $sliderFactory
    ) {
        $this->sliderResource = $sliderResource;
        $this->sliderFactory = $sliderFactory;
    }

    public function get(int $sliderId)
    {
        $config = $this->sliderFactory->create();
        $this->sliderResource->load($config, $sliderId);
        return $config;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        return [];
    }

    public function save(FrontpageSliderInterface $sliderData)
    {
        try {
            $this->sliderResource->save($sliderData);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('There was an error saving extension data.'));
        }

        return $sliderData;
    }

    public function deleteById(int $sliderId)
    {
        $slider = $this->get($sliderId);
        $this->sliderResource->delete($slider);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
