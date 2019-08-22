<?php
namespace GiangVu\Polls\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface; 

class FrontendPollRendering extends Template implements BlockInterface
{
    protected $_template = "widget/polls.phtml";
    
    protected $_session;
    protected $_pollRepository;
    protected $_answerRepository;
    protected $_submissionRepository;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $session,
        \GiangVu\Polls\Api\PollRepositoryInterface $pollRepository,
        \GiangVu\Polls\Api\AnswerRepositoryInterface $answerRepository,
        \GiangVu\Polls\Api\SubmissionRepositoryInterface $submissionRepository
    ) {
        parent::__construct($context);
        $this->_session = $session;
        $this->_pollRepository = $pollRepository;
        $this->_answerRepository = $answerRepository;
        $this->_submissionRepository = $submissionRepository;
    }
    /**
     * Check if customer has logged in
     * 
     * @return boolean
     */
    public function isCustomerLoggedIn()
    {
        return $this->_session->isLoggedIn();
    }
    
    /**
     * Retrieve currently logged in customer's ID
     * 
     * @return int
     */
    public function getCustomerId()
    {
        return $this->_session->getCustomer()->getId();
    }
    
    public function getActivePolls()
    {
        $pollCollection = $this->_pollRepository->getList();
        $pollCollection->addFieldToFilter('status', array('eq' => 1));
//         $collection->setPageSize();
        
        return $pollCollection;
    }
    
    /**
     * Retrieve a collection of Answers linked to the Poll with given ID
     * 
     * @param int $pollId
     * @return \GiangVu\Polls\Model\ResourceModel\Answer\Collection
     */
    public function getAnswersByPollId($pollId)
    {
        $answerCollection = $this->_answerRepository->getList();
        $answerCollection->addFieldToFilter('poll_id', array('eq' => $pollId));
        
        return $answerCollection;
    }
    
    /**
     * Check if the Poll with given ID is answered by currently logged in Customer
     * 
     * @param int $pollId
     * @param int $customerId
     * @return boolean
     */
    public function isPollAnsweredByCustomer(int $pollId, int $customerId)
    {
//         $submissionCollection = $this->_submissionRepository
//             ->getList()
//             ->addFieldToFilter('poll_id', array('eq' => $pollId))
//             ->addFieldToFilter('customer_id', array('eq' => $customerId));
        
//         foreach ($submissionCollection as $submission) {
//             if ($submission->getSubmission_id() == null) return false;
//         }
        
//         return true;

        // temporary solution
        // get a collection of submissions by poll_id,
        // then check if current customer has submitted any answer
        $submissionCollection = $this->_submissionRepository
            ->getList()
            ->addFieldToFilter('poll_id', array('eq' => $pollId));
        
        foreach ($submissionCollection as $submission) {
            if ($submission->getCustomer_id() == $customerId) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Retrieve a collection of Submissions containing the given poll_id
     * 
     * @param int $pollId
     * @return \GiangVu\Polls\Model\ResourceModel\Submission\Collection
     */
    public function getSubmissionsByPollId(int $pollId)
    {
        $submissionCollection = $this->_submissionRepository->getList();
        $submissionCollection->addFieldToFilter('poll_id', array('eq' => $pollId));
        
        return $submissionCollection;
    }
    
    /**
     * Retrieve a collection of Submissions containing the given poll_id and answer_id
     * 
     * @param int $pollId
     * @param int $answerId
     * @return \GiangVu\Polls\Model\ResourceModel\Submission\Collection
     */
    public function getSubmissionsByPollIdAndAnswerId(int $pollId, int $answerId)
    {
        $submissionCollection = $this->_submissionRepository->getList();
        $submissionCollection
            ->addFieldToFilter('poll_id', array('eq' => $pollId))
            ->addFieldToFilter('answer_id', array('eq' => $answerId));
        
        return $submissionCollection;
    }
    
    /**
     * Retrieve a collection of Submissions containing the given poll_id and customer_id
     * Typically used for retrieving answer submitted to a specific poll by a specific customer
     * 
     * @param int $pollId
     * @param int $customerId
     * @return \GiangVu\Polls\Model\ResourceModel\Submission\Collection|null
     */
    public function getSubmissionByPollIdAndCustomerId(int $pollId, int $customerId)
    {
        $submissionCollection = $this->_submissionRepository->getList();
        $submissionCollection
            ->addFieldToFilter('poll_id', array('eq' => $pollId))
            ->addFieldToFilter('customer_id', array('eq' => $customerId));
        
        if($submissionCollection->getSize()){
            return $submissionCollection->getFirstItem();
        }
        
        return null;
    }
    
    /**
     * Get total number of items in a collection
     * 
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     * @return number
     */
    public function countCollectionItems(
        \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
    ) {
        return $collection->count();
    }
    
    public function getSubmissionsByCustomerId($customerId)
    {
        $submissionCollection = $this->_submissionRepository->getList();
        $submissionCollection->addFieldToFilter('customer_id', array('eq' => $customerId));
        
        return $submissionCollection;
    }
}