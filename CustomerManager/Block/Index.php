<?php

namespace GiangVu\CustomerManager\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_customerCollectionFactory;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory
    ) {
        parent::__construct($context);
        $this->_customerCollectionFactory = $customerCollectionFactory;
    }
    
    public function getCustomers()
    {
        $collection = $this->_customerCollectionFactory->create();
        $collection->addAttributeToSelect('*');
//         $collection->setPageSize();
        
        return $collection;
    }
    
}