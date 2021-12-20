<?php

namespace ATF\Vendor\Model\ResourceModel;

use ATF\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{

    const TABLE_NAME = 'atf_vendor';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, VendorInterface::VENDOR_ID);
    }
}
