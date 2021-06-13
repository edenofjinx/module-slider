<?php

/**
 * Author: Julius Liaudanskis
 * Email: j.liaudanskis@gmail.com
 **/

namespace Custom\FrontpageSlider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class FrontpageSliderResourceModel extends AbstractDb
{
    /**#@+*/
    private const TABLE = 'frontpage_slider';
    private const PRIMARY_KEY = 'entity_id';
    /**#@-*/

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_isPkAutoIncrement = false;
        $this->_useIsObjectNew = true;

        $this->_init(
            self::TABLE,
            self::PRIMARY_KEY
        );
    }
}
