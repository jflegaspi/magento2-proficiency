<?php

namespace ATF\Vendor\Model\ResourceModel\VendorProductRelation;

use ATF\Vendor\Api\Data\VendorProductRelationInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use ATF\Vendor\Model\VendorProductRelation;
use ATF\Vendor\Model\ResourceModel\VendorProductRelation as VendorProductRelationResource;

class Collection extends AbstractCollection
{

    protected $_idFieldName = VendorProductRelationInterface::VENDOR_PRODUCT_ID;

    public function _construct()
    {
        $this->_init(VendorProductRelation::class, VendorProductRelationResource::class);
    }

}
