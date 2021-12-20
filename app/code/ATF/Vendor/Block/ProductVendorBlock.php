<?php

namespace ATF\Vendor\Block;

use Magento\Framework\View\Element\Template;
use ATF\Vendor\Model\VendorProductRelationRepository;
use ATF\Vendor\Model\VendorProductRelationRepositoryFactory;
use Magento\Framework\Registry;

class ProductVendorBlock  extends \Magento\Framework\View\Element\Template
{

    protected VendorProductRelationRepositoryFactory $vendorProductRelationRepositoryFactory;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected Registry $_coreRegistry;

    public function __construct(
        Template\Context $context,
        VendorProductRelationRepositoryFactory $vendorProductRelationRepositoryFactory,
        Registry $_coreRegistry,
        array $data = [])
    {
        $this->vendorProductRelationRepositoryFactory = $vendorProductRelationRepositoryFactory;
        $this->_coreRegistry = $_coreRegistry;
        parent::__construct($context, $data);
    }

    public function getProductId()
    {
        $product = $this->_coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    public function getVendors()
    {
        $productId = $this->getProductId();

        $productRepositoryFactory = $this->vendorProductRelationRepositoryFactory->create();

        $collections = $productRepositoryFactory->getRelatedVendorsByProductId($productId);

        return $collections;

    }

}
