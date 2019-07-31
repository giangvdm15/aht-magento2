<?php

namespace GiangVu\ProductList\Block;

use Magento\Framework\DataObject;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_imageFactory;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Helper\ImageFactory $imageHelper
    ) {
        parent::__construct($context);
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_imageFactory = $imageHelper;
    }
    
    public function getProductImage(DataObject $product)
    {
        $imageHelper = $this->_imageFactory->create();
        $imageUrl = $imageHelper
            ->init($product, 'product_thumbnail_image')
            ->setImageFile($product->getFile())
            ->resize(50, 50)
            ->getUrl();
        
        return $imageUrl;
    }
    
    public function getProducts(int $num = 10)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize($num);
        
        return $collection;
    }
    
}