<?php

namespace ATF\OrderInfo\Model;

use ATF\OrderInfo\Api\OrderInfoInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Sales\Api\OrderRepositoryInterface;

class OrderInfo implements OrderInfoInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    protected OrderRepositoryInterface $orderRepository;

    /**
     * @var JsonFactory
     */
    protected JsonFactory $jsonFactory;

    /**
     * @var PageFactory
     */
    protected PageFactory $pageFactory;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param JsonFactory $jsonFactory
     * @param PageFactory $pageFactory
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        JsonFactory              $jsonFactory,
        PageFactory              $pageFactory)
    {

        $this->orderRepository = $orderRepository;
        $this->jsonFactory = $jsonFactory;
        $this->pageFactory = $pageFactory;

    }

    public function getInfo(int $orderId, bool $isJson = false)
    {
        try {
            $order = $this->orderRepository->get($orderId);
            $data = [];
            if ($order) {
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

                if ($isJson) {
                    return $this->_responseJson($data);
                }

                return $this->_responseBlock($data);
            }
        } catch (\Exception $exception) {
            return ['message' => $exception->getMessage()];
        }


    }

    protected function _responseJson(array $data = [])
    {
        $json = $this->jsonFactory->create();
        return $json->setData($data);

    }

    protected function _responseBlock(array $data = [])
    {
        $resultPage = $this->pageFactory->create();
        $block = $resultPage->getLayout()->getBlock('order_info');
        $block->setData('order', $data);
        return $resultPage;
    }

}
