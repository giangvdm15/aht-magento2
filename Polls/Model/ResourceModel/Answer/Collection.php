<?php
namespace GiangVu\Polls\Model\ResourceModel\Answer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'answer_id';
    protected $_eventPrefix = 'giangvu_answer_entity_collection';
    protected $_eventObject = 'answer_collection';
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('GiangVu\Polls\Model\Answer', 'GiangVu\Polls\Model\ResourceModel\Answer');
    }
}