<?php

namespace ATF\Specific404Page\Controller\Product;

class CustomProduct404 extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        echo 'Custom Product Page Not Found';
    }
}
