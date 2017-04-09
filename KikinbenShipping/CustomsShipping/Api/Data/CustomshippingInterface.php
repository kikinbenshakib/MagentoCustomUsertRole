<?php


namespace KikinbenShipping\CustomsShipping\Api\Data;

interface CustomshippingInterface
{

    const CUSTOMSHIPPING_ID = 'customshipping_id';
    const SHIPPINGRATE = 'shippingrate';


    /**
     * Get customshipping_id
     * @return string|null
     */
    
    public function getCustomshippingId();

    /**
     * Set customshipping_id
     * @param string $customshipping_id
     * @return KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface
     */
    
    public function setCustomshippingId($customshippingId);

    /**
     * Get shippingrate
     * @return string|null
     */
    
    public function getShippingrate();

    /**
     * Set shippingrate
     * @param string $shippingrate
     * @return KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface
     */
    
    public function setShippingrate($shippingrate);
}
