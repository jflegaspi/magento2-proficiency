<?php

namespace ATF\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use ATF\Vendor\Api\Data\VendorInterface;
use ATF\Vendor\Model\ResourceModel\Vendor as VendorResourceModel;

class Vendor extends AbstractModel implements VendorInterface
{
    /**
     * Vendor Product Relation Cache Tag
     */
    const CACHE_TAG = 'vendor';

    protected $_cacheTag = self::CACHE_TAG;

    protected $_eventPrefix = 'atf_vendor';

    public function _construct()
    {
        parent::_construct(VendorResourceModel::class); // TODO: Change the autogenerated stub
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::VENDOR_ID);
    }

    /**
     * @param $value
     * @return Vendor
     */
    public function setId($value)
    {
        return $this->setData(self::VENDOR_ID, $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return Vendor
     */
    public function setName(string $name)
    {
        return $this->setData(self::NAME, $name);
    }
}