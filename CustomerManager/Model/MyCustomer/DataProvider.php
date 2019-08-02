<?php
namespace GiangVu\CustomerManager\Model\MyCustomer;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
// use GiangVu\CustomerManager\Model\Customer;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $customerCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $customerCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        
        $items = $this->collection->getItems();
        
        foreach ($items as $customer)
        {
            $this->_loadedData[$customer->getId()] = $customer->getData();
        }
        
        return $this->_loadedData;
    }
}