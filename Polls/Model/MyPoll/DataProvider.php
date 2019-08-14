<?php
namespace GiangVu\Polls\Model\MyPoll;

use GiangVu\Polls\Model\ResourceModel\Poll\CollectionFactory as CollectionFactory;
// use GiangVu\Polls\Model\Poll;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $pollCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $pollCollectionFactory->create();
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
        
        foreach ($items as $poll)
        {
            $this->_loadedData[$poll->getId()] = $poll->getData();
        }
        
        return $this->_loadedData;
    }
}