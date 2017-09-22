<?php

namespace Idema\PreviousTab\Block\Catalog\Product;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Reports\Block\Product\Viewed;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;


/**
 * Class PreviousTab
 * @package Idema\PreviousTab\Block\Catalog\Product
 */
class PreviousTab extends Template
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
     * @var AbstractProduct $abstractProduct
     */
    protected $abstractProduct;

    /**
     * PreviousTab constructor.
     * @param Context $context
     * @param array $data
     * @param ObjectManagerInterface $objectManager
     * @param PriceCurrencyInterface $priceCurrency
     * @param PageFactory $pageFactory
     * @param AbstractProduct $abstractProduct
     * @param Viewed $viewed
     */
    public function __construct(
        Context $context,
        array $data = [],
        ObjectManagerInterface $objectManager,
        PriceCurrencyInterface $priceCurrency,
        PageFactory $pageFactory,
        AbstractProduct $abstractProduct,
        Viewed $viewed
    )
    {
        parent::__construct($context, $data);

        $this->_objectManager = $objectManager;
        $this->viewed = $viewed;
        $this->pageFactory = $pageFactory;
        $this->priceCurrency = $priceCurrency;
        $this->abstractProduct = $abstractProduct;
    }

    /**
     * @return object
     */
    public function getLoadedProductCollection()
    {
        return $this->viewed->getItemsCollection()->setPageSize(8);
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
    public function getProductPrice($product)
    {
        return $this->abstractProduct->getProductPriceHtml(
            $product,
            FinalPrice::PRICE_CODE,
            Render::ZONE_ITEM_LIST
        );
    }

}
