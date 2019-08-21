<?php
namespace GiangVu\Polls\Model;

use Magento\Framework\DataObject\IdentityInterface;
use GiangVu\Polls\Api\Data\SubmissionInterface;

class Submission extends \Magento\Framework\Model\AbstractModel implements
    IdentityInterface,
    SubmissionInterface
{
    const CACHE_TAG = 'giangvu_submission';
    
    protected $_cacheTag = 'giangvu_submission';
    
    protected $_eventPrefix = 'giangvu_submission';
    
    protected function _construct()
    {
        $this->_init('GiangVu\Polls\Model\ResourceModel\Submission');
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