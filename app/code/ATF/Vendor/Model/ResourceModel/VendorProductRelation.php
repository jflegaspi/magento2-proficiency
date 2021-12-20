<?php

namespace ATF\Vendor\Model\ResourceModel;

use ATF\Vendor\Api\Data\VendorProductRelationInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class VendorProductRelation extends AbstractDb
{

    const TABLE_NAME = 'atf_vendor2product';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, VendorProductRelationInterface::VENDOR_PRODUCT_ID);
    }
}
