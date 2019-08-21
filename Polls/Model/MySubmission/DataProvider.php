<?php
namespace GiangVu\Polls\Model\MySubmission;

use GiangVu\Polls\Model\ResourceModel\Submission\CollectionFactory as CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $submissionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $submissionCollectionFactory->create();
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
            );
    }
    
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        
        $items = $this->collection->getItems();
        
        foreach ($items as $ans)
        {
            $this->_loadedData[$ans->getId()] = $ans->getData();
        }
        
        return $this->_loadedData;
    }
}