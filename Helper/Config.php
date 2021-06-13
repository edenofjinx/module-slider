<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    /**
     * @param string $path
     * @param string $scope
     * @return string
     */
    public function getValue(
        string $path,
        string $scope = ScopeInterface::SCOPE_STORE
    ): string {
        return (string)($this->scopeConfig->getValue($path, $scope));
    }

    public function getActive()
    {
        return $this->getValue('slider_config/general/active') ?? null;
    }
}
