<?php

namespace ATF\Vendor\Api;

use ATF\Vendor\Model\VendorProductRelation as VendorProductRelationModel;
use ATF\Vendor\Model\ResourceModel\VendorProductRelation\Collection as VendorProductRelationCollection;


interface VendorProductRelationRepositoryInterface
{

    public function newModel(): VendorProductRelationModel;

    public function newCollection(): VendorProductRelationCollection;

    public function getRelatedVendorsByProductId(int $productId);

}
