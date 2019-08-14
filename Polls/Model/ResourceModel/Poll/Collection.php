<?php
namespace GiangVu\Polls\Model\ResourceModel\Poll;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'poll_id';
    protected $_eventPrefix = 'giangvu_poll_entity_collection';
    protected $_eventObject = 'poll_collection';
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('GiangVu\Polls\Model\Poll', 'GiangVu\Polls\Model\ResourceModel\Poll');
    }
}