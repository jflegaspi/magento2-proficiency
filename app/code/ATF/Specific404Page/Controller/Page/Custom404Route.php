<?php

namespace ATF\Specific404Page\Controller\Page;

use Magento\Framework\App\ResponseInterface;

class Custom404Route extends \Magento\Framework\App\Action\Action
{


    public function execute()
    {
        echo 'Custom 404 Page Not Found';
    }
}
