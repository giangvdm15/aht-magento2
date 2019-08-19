<?php
namespace GiangVu\Polls\Model\MyAnswer;

use GiangVu\Polls\Model\ResourceModel\Answer\CollectionFactory as CollectionFactory;
// use GiangVu\Polls\Model\Poll;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $answerCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $answerCollectionFactory->create();
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