<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Controller\Adminhtml\Images;

use Custom\FrontpageSlider\Api\Data\Slider\FrontpageSliderInterfaceFactory;
use Custom\FrontpageSlider\Api\FrontpageSliderRepositoryInterface;
use Custom\FrontpageSlider\Model\Slider\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Store\Model\StoreManagerInterface;

class Save extends Action implements HttpPostActionInterface
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var RedirectFactory
     */
    protected $result;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @var FrontpageSliderRepositoryInterface
     */
    protected $sliderRepository;

    /**
     * @var FrontpageSliderInterfaceFactory
     */
    protected $sliderFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Action\Context $context,
        ImageUploader $imageUploader,
        RequestInterface $request,
        ResponseInterface $result,
        FrontpageSliderRepositoryInterface $sliderRepository,
        FrontpageSliderInterfaceFactory $sliderFactory,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
        $this->request = $request;
        $this->result = $result;
        $this->sliderRepository = $sliderRepository;
        $this->sliderFactory = $sliderFactory;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        try {
            $images = $this->request->getParam('frontpage_slider_container');
            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    $url = $this->setImageUrl($image);
                    if (!$url) {
                        continue;
                    }
                    if (!isset($image['entity_id']) || $image['entity_id'] === null || $image['entity_id'] === '') {
                        $data = $this->sliderFactory->create();
                    } else {
                        $data = $this->sliderRepository->get($image['entity_id']);
                    }
                    $data->setSliderImagePosition($image['position'] ?: '1');
                    $data->setSliderImageUrl($url);
                    $this->sliderRepository->save($data);
                }
            }
            $this->messageManager->addSuccessMessage(__('Slider has been saved successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index/scope/stores');
        return $resultRedirect;
    }

    protected function setImageUrl($data)
    {
        if (isset($data['image_url'][0]['name']) && isset($data['image_url'][0]['tmp_name'])) {
            $name = $data['image_url'][0]['name'];
            $url = $this->imageUploader->moveFileFromTmp($name);
        } elseif (isset($data['image_url'][0]['name']) && isset($data['image_url'][0]['url'])) {
            $url = $this->sanitizeImageUrl($data['image_url'][0]['url']);
        } else {
            $url = '';
        }
        return $url;
    }

    protected function sanitizeImageUrl($imageUrl)
    {
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $url = str_replace($mediaUrl, '', $imageUrl);
        $url = ltrim(str_replace('pub/media/', '', $url), '/');
        return $url;
    }
}
