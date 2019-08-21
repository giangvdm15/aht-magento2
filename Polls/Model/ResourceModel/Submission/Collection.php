<?php
namespace GiangVu\Polls\Model\ResourceModel\Submission;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'submission_id';
    protected $_eventPrefix = 'giangvu_submission_collection';
    protected $_eventObject = 'submission_collection';
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('GiangVu\Polls\Model\Submission', 'GiangVu\Polls\Model\ResourceModel\Submission');
    }
}