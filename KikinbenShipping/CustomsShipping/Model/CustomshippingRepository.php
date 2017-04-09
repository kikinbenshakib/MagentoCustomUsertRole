<?php


namespace KikinbenShipping\CustomsShipping\Model;

use KikinbenShipping\CustomsShipping\Api\CustomshippingRepositoryInterface;
use KikinbenShipping\CustomsShipping\Api\Data\CustomshippingSearchResultsInterfaceFactory;
use KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use KikinbenShipping\CustomsShipping\Model\ResourceModel\Customshipping as ResourceCustomshipping;
use KikinbenShipping\CustomsShipping\Model\ResourceModel\Customshipping\CollectionFactory as CustomshippingCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class CustomshippingRepository implements customshippingRepositoryInterface
{

    protected $resource;

    protected $customshippingFactory;

    protected $customshippingCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataCustomshippingFactory;

    private $storeManager;


    /**
     * @param ResourceCustomshipping $resource
     * @param CustomshippingFactory $customshippingFactory
     * @param CustomshippingInterfaceFactory $dataCustomshippingFactory
     * @param CustomshippingCollectionFactory $customshippingCollectionFactory
     * @param CustomshippingSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceCustomshipping $resource,
        CustomshippingFactory $customshippingFactory,
        CustomshippingInterfaceFactory $dataCustomshippingFactory,
        CustomshippingCollectionFactory $customshippingCollectionFactory,
        CustomshippingSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->customshippingFactory = $customshippingFactory;
        $this->customshippingCollectionFactory = $customshippingCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomshippingFactory = $dataCustomshippingFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface $customshipping
    ) {
        /* if (empty($customshipping->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customshipping->setStoreId($storeId);
        } */
        try {
            $this->resource->save($customshipping);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customshipping: %1',
                $exception->getMessage()
            ));
        }
        return $customshipping;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($customshippingId)
    {
        $customshipping = $this->customshippingFactory->create();
        $customshipping->load($customshippingId);
        if (!$customshipping->getId()) {
            throw new NoSuchEntityException(__('customshipping with id "%1" does not exist.', $customshippingId));
        }
        return $customshipping;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->customshippingCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $items = [];
        
        foreach ($collection as $customshippingModel) {
            $customshippingData = $this->dataCustomshippingFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $customshippingData,
                $customshippingModel->getData(),
                'KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $customshippingData,
                'KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \KikinbenShipping\CustomsShipping\Api\Data\CustomshippingInterface $customshipping
    ) {
        try {
            $this->resource->delete($customshipping);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the customshipping: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customshippingId)
    {
        return $this->delete($this->getById($customshippingId));
    }
}
