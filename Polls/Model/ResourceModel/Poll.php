<?php
namespace GiangVu\Polls\Model\ResourceModel;

class Poll extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }
    
    protected function _construct()
    {
        $this->_init('giangvu_poll_entity', 'poll_id');
    }
    
}