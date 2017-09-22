<?php

namespace Idema\CustomerTab\Block;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Result\PageFactory;
use Magento\Reports\Block\Product\Viewed;

/**
 * Class CustomerTab
 * @package Idema\CustomerTab\Block
 */
class CustomerTab extends Template
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $viewed;

    /** @var PageFactory */
    protected $pageFactory;

    /** @var PriceCurrencyInterface $priceCurrency */
    protected $priceCurrency;

    /**
     * CustomerTab constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param PriceCurrencyInterface $priceCurrency
     * @param PageFactory $pageFactory
     * @param Viewed $viewed
     */
    public function __construct(
        Context $context,
        array $data = [],
        ObjectManagerInterface $objectManager,
        PriceCurrencyInterface $priceCurrency,
        PageFactory $pageFactory,
        Viewed $viewed
    )
    {
        parent::__construct($context, $data);

        $this->_objectManager = $objectManager;
        $this->viewed = $viewed;
        $this->pageFactory = $pageFactory;
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * @return object
     */
    public function getPreviousViewedProducts()
    {
        return $this->viewed->getItemsCollection()->setPageSize(10);
    }

    /**
     * @param $product
     * @return string
     */
    public function getAddToCartUrl($product)
    {
        $listBlock = $this->_objectManager->get('\Magento\Catalog\Block\Product\ListProduct');
        return $listBlock->getAddToCartUrl($product);
    }

    /**
     * @param $product
     * @return string
     */
    public function getFormattedPrice($product)
    {
        return $this->priceCurrency->convertAndFormat($product->getFinalPrice());
    }

}