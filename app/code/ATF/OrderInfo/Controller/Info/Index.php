<?php

namespace ATF\OrderInfo\Controller\Info;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use ATF\OrderInfo\Api\OrderInfoInterface;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var OrderInfoInterface
     */
    protected OrderInfoInterface $orderInfo;

    /**
     * @param Context $context
     * @param OrderInfoInterface $orderInfo
     */
    public function __construct(
        Context $context,
        OrderInfoInterface $orderInfo)
    {
        $this->orderInfo = $orderInfo;
        parent::__construct($context);
    }

    public function execute()
    {
        $orderId = $this->getRequest()->getParam('orderID');
        $isJson = $this->getRequest()->getParam('json') ?? 0;

        return $this->orderInfo->getInfo($orderId, $isJson);
    }
}
