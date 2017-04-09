<?php


namespace KikinbenShipping\CustomsShipping\Model\ResourceModel;

class Customshipping extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('kikinbenshipping_customshipping', 'customshipping_id');
    }
}
