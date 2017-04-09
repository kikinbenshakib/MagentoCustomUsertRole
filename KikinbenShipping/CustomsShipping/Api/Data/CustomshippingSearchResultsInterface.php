<?php


namespace KikinbenShipping\CustomsShipping\Api\Data;

interface CustomshippingSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get customshipping list.
     * @return \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface[]
     */
    
    public function getItems();

    /**
     * Set shippingrate list.
     * @param \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
