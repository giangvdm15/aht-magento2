<?php
namespace GiangVu\Polls\Model\MyPoll\Source;

class Poll implements PollSourceInterface, \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var null|array
     */
    protected $ids;
    
    /**
     * @param \GiangVu\Polls\Model\ResourceModel\Poll\CollectionFactory $collectionFactory
     * @param \GiangVu\Polls\Model\ResourceModel\Poll $poll
     */
    public function __construct(
        \GiangVu\Polls\Model\ResourceModel\Poll\CollectionFactory $collectionFactory,
        \GiangVu\Polls\Model\ResourceModel\Poll $poll
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->poll = $poll;
    }
    
    /**
     * @return array|null
     */
    public function toOptionArray()
    {
        if (null == $this->ids) {
            $this->ids = $this->collectionFactory->create()
            ->setEntityTypeFilter($this->poll->getTypeId())
            ->toOptionArray();
        }
        return $this->ids;
    }
}