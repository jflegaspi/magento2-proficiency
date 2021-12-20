<?php

namespace ATF\OrderController\Controller\Order;

use Magento\Framework\App\Action\Context;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use Magento\Framework\Controller\Result\JsonFactory;


class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var OrderRepositoryInterface
     */
    protected OrderRepositoryInterface $orderRepository;

    /**
     * @var OrderItemRepositoryInterface
     */
    protected OrderItemRepositoryInterface $orderItemRepository;

    /**
     * @var JsonFactory
     */
    protected JsonFactory $jsonFactory;


    /**
     * @param Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        JsonFactory $jsonFactory)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('orderID');

        $data = [];
        $resultJson = $this->jsonFactory->create();

        try {
            $order = $this->orderRepository->get($id);

            if($order) {

                $orderItems = $order->getItems();
                $items = [];
                foreach ($orderItems as $item) {
                    $items[] = ['sku' => $item->getSku(), 'item_id' => $item->getItemId(), 'price' => $item->getPrice()];
                }

                $data = [
                    'status' => $order->getStatus(),
                    'total' => $order->getGrandTotal(),
                    'items' => $items,
                    'total_invoiced' => $order->getTotalInvoiced()
                ];

            }


            return $resultJson->setData($data);

        } catch (\Exception $exception) {
            return $resultJson->setData(['message' => $exception->getMessage()]);
        }


    }

}
