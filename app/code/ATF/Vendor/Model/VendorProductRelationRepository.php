<?php

namespace ATF\Vendor\Model;

use ATF\Vendor\Model\ResourceModel\VendorProductRelation\Collection as VendorProductRelationCollection;
use ATF\Vendor\Model\ResourceModel\VendorProductRelation\CollectionFactory as VendorProductRelationCollectionFactory;
use ATF\Vendor\Model\VendorProductRelation as VendorProductRelationModel;
use ATF\Vendor\Model\VendorProductRelationFactory as VendorProductRelationModelFactory;
use ATF\Vendor\Model\ResourceModel\VendorProductRelation as VendorProductRelationResource;
use ATF\Vendor\Model\ResourceModel\Vendor\Collection as VendorCollection;
use ATF\Vendor\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;

class VendorProductRelationRepository implements \ATF\Vendor\Api\VendorProductRelationRepositoryInterface
{

    protected VendorProductRelationResource $resource;

    protected VendorProductRelationModelFactory $vendorProductRelationModelFactory;

    protected VendorProductRelationCollectionFactory $vendorProductRelationCollectionFactory;

    protected VendorCollectionFactory $vendorCollectionFactory;

    public function __construct(
        VendorProductRelationResource          $resource,
        VendorProductRelationModelFactory      $vendorProductRelationModelFactory,
        VendorProductRelationCollectionFactory $vendorProductRelationCollectionFactory,
        VendorCollectionFactory                $vendorCollectionFactory
    )
    {
        $this->resource = $resource;
        $this->vendorProductRelationModelFactory = $vendorProductRelationModelFactory;
        $this->vendorProductRelationCollectionFactory = $vendorProductRelationCollectionFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
    }


    public function newModel(): VendorProductRelationModel
    {
        return $this->vendorProductRelationModelFactory->create();
    }

    public function newCollection(): VendorProductRelationCollection
    {
        return $this->vendorProductRelationCollectionFactory->create();
    }

    public function getRelatedVendorsByProductId(int $productId): VendorCollection
    {
        $collection = $this->vendorCollectionFactory->create();
        $tableName = $collection->getTable(VendorProductRelationResource::TABLE_NAME);
        $collection
            ->addFieldToFilter(
                'atf_vendor2product.product_id',
                $productId
            )
            ->getSelect()
            ->joinLeft(
                ['atf_vendor2product' => $tableName],
                'main_table.vendor_id = atf_vendor2product.vendor_entity_id'
            );

        return $collection;
    }

}
