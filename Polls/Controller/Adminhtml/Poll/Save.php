<?php
namespace GiangVu\Polls\Controller\Adminhtml\Poll;

class Save extends \Magento\Framework\App\Action\Action
{
    const ADMIN_RESOURCE = 'Poll';
    
    protected $_pageFactory;
    protected $_pollFactory;
    protected $_pollRepository;
    protected $_coreRegistry;
    protected $resultRedirect;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \GiangVu\Polls\Model\PollFactory $pollFactory,
        \GiangVu\Polls\Api\PollRepositoryInterface $pollRepository,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_pollFactory = $pollFactory;
        $this->_pollRepository = $pollRepository;
        $this->_coreRegistry = $coreRegistry;
        $this->resultRedirect = $result;
        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $this->resultRedirect = $this->resultRedirectFactory->create();
        $this->resultRedirect->setPath('polls/*/');
        $postData = $this->getRequest()->getPostValue();
        
        $id = $postData['poll_id'] ? $postData['poll_id'] : null;
        
        if ($id == null) { // save new poll 
            $poll = $this->_pollFactory->create();
        }
        else { // update poll
            $poll = $this->_pollRepository->getById($id);
            $poll->setUpdated_at(date('Y/m/d h:i:s', time()));
        }
        
        $poll->setPoll_title($postData['poll_title']);
        $poll->setPoll_content($postData['poll_content']);
        $poll->setStatus($postData['status']);
        $this->_pollRepository->save($poll);
        
        return $this->resultRedirect;
    }
}
