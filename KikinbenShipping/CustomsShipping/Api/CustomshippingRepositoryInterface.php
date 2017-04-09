<?php


namespace KikinbenShipping\CustomsShipping\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomshippingRepositoryInterface
{


    /**
     * Save customshipping
     * @param \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface $customshipping
     * @return \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface $customshipping
    );

    /**
     * Retrieve customshipping
     * @param string $customshippingId
     * @return \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($customshippingId);

    /**
     * Retrieve customshipping matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete customshipping
     * @param \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface $customshipping
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface $customshipping
    );

    /**
     * Delete customshipping by ID
     * @param string $customshippingId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($customshippingId);
}
