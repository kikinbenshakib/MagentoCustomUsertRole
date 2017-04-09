<?php


namespace KikinbenShipping\CustomsShipping\Model\Cache;

class CustomShipping extends \Magento\Framework\Cache\Frontend\Decorator\TagScope
{

    const TYPE_IDENTIFIER = 'customshipping_cache_tag';
    const CACHE_TAG = 'CUSTOMSHIPPING_CACHE_TAG';

    /**
     * @param \Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool
     */
    public function __construct(
        \Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool
    ) {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}
