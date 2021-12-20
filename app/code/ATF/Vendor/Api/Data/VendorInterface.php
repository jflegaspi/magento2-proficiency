<?php

namespace ATF\Vendor\Api\Data;

interface VendorInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const VENDOR_ID = 'vendor_id';
    const NAME = 'name';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    /**
     * Vendor ID
     * @return int|null
     */
    public function getId();

    /**
     * Set Vendor ID
     * @param $value
     * @return $this
     */
    public function setId($value);

    /**
     * Vendor Name
     * @return string
     */
    public function getName();

    /**
     * Set Vendor Name
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

}
