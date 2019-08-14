<?php
namespace GiangVu\Polls\Model;

use Magento\Framework\DataObject\IdentityInterface;
use GiangVu\Polls\Api\Data\PollInterface;

class Poll extends \Magento\Framework\Model\AbstractModel implements 
    IdentityInterface,
    PollInterface
{
    const CACHE_TAG = 'giangvu_poll_entity';
    
    protected $_cacheTag = 'giangvu_poll_entity';
    
    protected $_eventPrefix = 'giangvu_poll_entity';
    
    protected function _construct()
    {
        $this->_init('GiangVu\Polls\Model\ResourceModel\Poll');
    }
    
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    
    public function getDefaultValues()
    {
        $values = [];
        
        return $values;
    }
}