<?php
namespace GiangVu\Polls\Ui\Component\Create\Form\Poll;

use Magento\Framework\Data\OptionSourceInterface;
use GiangVu\Polls\Model\ResourceModel\Poll\CollectionFactory as PollCollectionFactory;
use Magento\Framework\App\RequestInterface;

/**
 * Options tree for "Poll (ID)" field
 */
class Options implements OptionSourceInterface
{
    /**
     * @var \GiangVu\Polls\Model\ResourceModel\Poll\CollectionFactory
     */
    protected $_pollCollectionFactory;
    
    /**
     * @var RequestInterface
     */
    protected $_request;
    
    /**
     * @var array
     */
    protected $_pollTree = null;
    
    /**
     * @param PollCollectionFactory $pollCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        PollCollectionFactory $pollCollectionFactory,
        RequestInterface $request
    ) {
            $this->_pollCollectionFactory = $pollCollectionFactory;
            $this->_request = $request;
    }
    
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getPollTree();
    }
    
    /**
     * Retrieve polls tree
     *
     * @return array
     */
    protected function getPollTree()
    {
        if ($this->_pollTree === null) {
            $collection = $this->_pollCollectionFactory->create();
            
//             $collection->addNameToSelect();
            
            $pollById = null;
            
            foreach ($collection as $poll) {
                $pollId = $poll->getPoll_id();
                if (! isset($pollById[$pollId])) {
                    $pollById[$pollId] = [
                        'value' => $pollId
                    ];
                }
                $pollById[$pollId]['label'] = $poll->getPoll_title();
            }
            $this->_pollTree = $pollById;
        }
        
        return $this->_pollTree;
    }
}