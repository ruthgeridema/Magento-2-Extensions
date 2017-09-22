<?php

namespace Idema\CustomerTab\Controller\Customer;

use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package Idema\CustomerTab\Controller\Customer
 */
class Index extends Action
{

    public function execute()
    {

        $this->_view->loadLayout();

        $this->_view->renderLayout();
    }
}