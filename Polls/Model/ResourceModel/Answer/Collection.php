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

    // protected function _initSelect()
    // {
    //     parent::_initSelect();

    //     $this->getSelect()->joinLeft(
    //         ['poll_table' => $this->getTable('giangvu_poll_entity')],
    //         'main_table.poll_id = poll_table.poll_id',
    //         ['poll_title' => 'poll_table.poll_title']
    //     );
    // }
}