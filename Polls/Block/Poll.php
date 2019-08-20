<?php
namespace GiangVu\Polls\Block;

class Poll extends \Magento\Framework\View\Element\Template
{
    protected $_session;
    protected $_pollRepository;
    protected $_answerRepository;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $session,
        \GiangVu\Polls\Model\PollRepository $pollRepository,
        \GiangVu\Polls\Model\AnswerRepository $answerRepository
    ) {
        parent::__construct($context);
        $this->_session = $session;
        $this->_pollRepository = $pollRepository;
        $this->_answerRepository = $answerRepository;
    }
    
    public function isCustomerLoggedIn(){
        return $this->_session->isLoggedIn();
    }
    
    public function getActivePolls()
    {
        $pollCollection = $this->_pollRepository->getList();
        $pollCollection->addFieldToFilter('status', array('eq' => 1));
        //         $collection->setPageSize();
        
        return $pollCollection;
    }
    
    public function getAnswersByPollId($pollId)
    {
        $answerCollection = $this->_answerRepository->getList();
        $answerCollection->addFieldToFilter('poll_id', array('eq' => $pollId));
        
        return $answerCollection;
    }
}