<?php

namespace Idema\CustomerTab\Block;

use Magento\Framework\View\Result\PageFactory;
use Magento\Reports\Block\Product\Viewed;

/**
 * Class CustomerTab
 * @package Idema\CustomerTab\Block
 */
class CustomerTab extends \Magento\Framework\View\Element\Template
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
     * CustomerTab constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param PageFactory $pageFactory
     * @param Viewed $viewed
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Magento\Framework\ObjectManagerInterface $objectManager,
        PageFactory $pageFactory,
        Viewed $viewed
    )
    {
        parent::__construct($context, $data);

        $this->_objectManager = $objectManager;
        $this->viewed = $viewed;
        $this->pageFactory = $pageFactory;
    }

    /**
     * @return object
     */
    public function getPreviousViewedProducts()
    {
        return $this->viewed->getItemsCollection()->setPageSize(10);
    }
}