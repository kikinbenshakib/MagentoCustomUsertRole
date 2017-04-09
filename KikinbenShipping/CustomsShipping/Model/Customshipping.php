<?php


namespace KikinbenShipping\CustomsShipping\Model;

use KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface;

class Customshipping extends \Magento\Framework\Model\AbstractModel implements CustomshippingInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('KikinbenShipping\CustomsShipping\Model\ResourceModel\Customshipping');
    }

    /**
     * Get customshipping_id
     * @return string
     */
    public function getCustomshippingId()
    {
        return $this->getData(self::CUSTOMSHIPPING_ID);
    }

    /**
     * Set customshipping_id
     * @param string $customshippingId
     * @return KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface
     */
    public function setCustomshippingId($customshippingId)
    {
        return $this->setData(self::CUSTOMSHIPPING_ID, $customshippingId);
    }

    /**
     * Get shippingrate
     * @return string
     */
    public function getShippingrate()
    {
        return $this->getData(self::SHIPPINGRATE);
    }

    /**
     * Set shippingrate
     * @param string $shippingrate
     * @return KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface
     */
    public function setShippingrate($shippingrate)
    {
        return $this->setData(self::SHIPPINGRATE, $shippingrate);
    }
}
