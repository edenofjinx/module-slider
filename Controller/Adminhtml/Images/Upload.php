<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Controller\Adminhtml\Images;

use Custom\FrontpageSlider\Model\Slider\ImageUploader;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Upload extends Action implements HttpPostActionInterface
{
    /**
     * Image uploader
     *
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * Upload constructor.
     *
     * @param Context $context
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        Context $context,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }
    /**
     * Upload file controller action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $dynamicRows = $this->getRequest()->getFiles('frontpage_slider_container');
        $files = [];
        foreach ($dynamicRows as $key => $rows) {
            $files = $dynamicRows[$key]['image_url'];
        }

        try {
            $result = $this->imageUploader->saveFileToTmpDir($files);
        } catch (Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
