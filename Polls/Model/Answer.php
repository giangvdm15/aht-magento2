<?php
namespace GiangVu\Polls\Model;

use Magento\Framework\DataObject\IdentityInterface;
use GiangVu\Polls\Api\Data\AnswerInterface;

class Answer extends \Magento\Framework\Model\AbstractModel implements
    IdentityInterface,
    AnswerInterface
{
    const CACHE_TAG = 'giangvu_answer_entity';
    
    protected $_cacheTag = 'giangvu_answer_entity';
    
    protected $_eventPrefix = 'giangvu_answer_entity';
    
    protected function _construct()
    {
        $this->_init('GiangVu\Polls\Model\ResourceModel\Answer');
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