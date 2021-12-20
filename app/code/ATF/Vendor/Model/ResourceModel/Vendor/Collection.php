<?php

namespace ATF\Vendor\Model\ResourceModel\Vendor;

use ATF\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use ATF\Vendor\Model\Vendor;
use ATF\Vendor\Model\ResourceModel\Vendor as VendorResourceModel;

class Collection extends AbstractCollection
{

    protected $_idFieldName = VendorInterface::VENDOR_ID;

    public function _construct()
    {
       $this->_init(Vendor::class, VendorResourceModel::class);
    }

}
