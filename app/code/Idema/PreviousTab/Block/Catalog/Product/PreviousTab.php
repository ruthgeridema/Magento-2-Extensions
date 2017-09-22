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

    /**
     * PreviousTab constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param PageFactory $pageFactory
     * @param Viewed $viewed
     * @param AbstractProduct $abstractProduct
     */
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
        return $this->viewed->getItemsCollection()->setPageSize(8);
    }
}
