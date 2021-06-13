<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Controller\Adminhtml\Images;

use Custom\FrontpageSlider\Api\FrontpageSliderRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Delete extends Action implements HttpPostActionInterface
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var FrontpageSliderRepositoryInterface
     */
    protected $sliderRepository;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    public function __construct(
        Action\Context $context,
        RequestInterface $request,
        JsonFactory $resultJsonFactory,
        FrontpageSliderRepositoryInterface $sliderRepository
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->sliderRepository = $sliderRepository;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        try {
            $slideId = $this->request->getParam('slide_id');
            if ($slideId) {
                $this->sliderRepository->deleteById($slideId);
            }
            $message = 'Slide was deleted.';
        } catch (\Exception $e) {
            $message = 'There was an error deleting image slider.';
        }
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData(['message' => $message]);
    }
}
