<?php

namespace ATF\OrderInfo\Api;

interface OrderInfoInterface
{

    public function getInfo(int $orderId, bool $isJson);

}
