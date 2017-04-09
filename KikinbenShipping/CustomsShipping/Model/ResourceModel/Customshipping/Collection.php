<?php


namespace KikinbenShipping\CustomsShipping\Model\ResourceModel\Customshipping;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'KikinbenShipping\CustomsShipping\Model\Customshipping',
            'KikinbenShipping\CustomsShipping\Model\ResourceModel\Customshipping'
        );
    }
}
