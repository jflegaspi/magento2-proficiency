<?php

namespace ATF\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use ATF\Vendor\Api\Data\VendorProductRelationInterface;
use ATF\Vendor\Model\ResourceModel\VendorProductRelation as VendorProductRelationResource;

class VendorProductRelation extends AbstractModel implements VendorProductRelationInterface
{

    /**
     * Vendor Product Relation Cache Tag
     */
    const CACHE_TAG = 'vendor_product_product_rel';

    protected $_cacheTag = self::CACHE_TAG;

    protected $_eventPrefix = 'vendor_product_product_relation';


    protected function _construct()
    {
        parent::_construct(VendorProductRelationResource::class);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::VENDOR_PRODUCT_ID);
    }

    /**
     * @param $value
     * @return VendorProductRelation
     */
    public function setId($value)
    {
        return $this->setData(self::VENDOR_PRODUCT_ID, $value);
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @param int $productId
     * @return VendorProductRelation
     */
    public function setProductId(int $productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @return int
     */
    public function getVendorEntityId(): int
    {
        return $this->getData(self::VENDOR_ENTITY_ID);
    }

    /**
     * @param int $vendorEntityId
     * @return VendorProductRelation
     */
    public function setVendorEntityId(int $vendorEntityId)
    {
        return $this->setData(self::VENDOR_ENTITY_ID, $vendorEntityId);
    }
}
