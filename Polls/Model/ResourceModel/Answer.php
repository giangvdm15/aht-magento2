<?php
namespace GiangVu\Polls\Model\ResourceModel;

class Answer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }
    
    protected function _construct()
    {
        $this->_init('giangvu_answer_entity', 'answer_id');
    }
    
}