<?php

namespace ATF\Vendor\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface VendorProductRelationInterface extends ExtensibleDataInterface
{

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const VENDOR_PRODUCT_ID = 'vendor_product_id';
    const PRODUCT_ID = 'product_id';
    const VENDOR_ENTITY_ID = 'vendor_entity_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    /**
     * Vendor Product ID
     * @return int|null
     */
    public function getId();

    /**
     * Set Vendor Product ID
     * @param $value
     * @return $this
     */
    public function setId($value);

    /**
     * Product ID
     * @return int
     */
    public function getProductId(): int;

    /**
     * Set Product ID
     * @param int $productId
     * @return $this
     */
    public function setProductId(int $productId);

    /**
     * Vendor Entity ID
     * @return int
     */
    public function getVendorEntityId(): int;

    /**
     * Set Vendor Entity ID
     * @param int $vendorEntityId
     * @return $this
     */
    public function setVendorEntityId(int $vendorEntityId);

}
