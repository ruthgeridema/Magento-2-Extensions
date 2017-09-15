<?php
namespace Idema\PreviousTab\Block\Catalog\Product;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Framework\View\Result\PageFactory;
use Magento\Reports\Block\Product\Viewed;

/**
 * Class PreviousTab
 * @package Idema\PreviousTab\Block\Catalog\Product
 */
class PreviousTab extends \Magento\Framework\View\Element\Template
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

    /**
     * @var
     */
    protected $abstractProduct;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Magento\Framework\ObjectManagerInterface $objectManager,
        PageFactory $pageFactory,
        Viewed $viewed,
        AbstractProduct $abstractProduct
    ) {
        parent::__construct($context, $data);

        $this->_objectManager = $objectManager;
        $this->viewed = $viewed;
        $this->pageFactory = $pageFactory;
        $this->abstractProduct = $abstractProduct;
    }

    /**
     * @return object
     */
    public function getLoadedProductCollection()
    {
        //Set pagesize to 8 because of 4 per row (2 rows)
        return $this->viewed->getItemsCollection()->setPageSize(8);
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        return parent::_toHtml();
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        return $this->getProductPriceHtml(
            $product,
            \Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE,
            \Magento\Framework\Pricing\Render::ZONE_ITEM_LIST
        );
    }

    /**
     * Return HTML block with tier price
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $priceType
     * @param string $renderZone
     * @param array $arguments
     * @return string
     */
    public function getProductPriceHtml(
        \Magento\Catalog\Model\Product $product,
        $priceType,
        $renderZone = \Magento\Framework\Pricing\Render::ZONE_ITEM_LIST,
        array $arguments = []
    ) {
        if (!isset($arguments['zone'])) {
            $arguments['zone'] = $renderZone;
        }

        /** @var \Magento\Framework\Pricing\Render $priceRender */
        $priceRender = $this->getLayout()->getBlock('product.price.render.default');
        $price = '';

        if ($priceRender) {
            $price = $priceRender->render($priceType, $product, $arguments);
        }
        return $price;
    }
}
