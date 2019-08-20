<?php
namespace GiangVu\Polls\Controller\Adminhtml\Poll;

use GiangVu\Polls\Model\ResourceModel\Answer\CollectionFactory as AnswerCollectionFactory;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Poll';
    
    protected $_resultPageFactory;
    protected $_pollRepository;
    protected $_answerCollectionFactory;
    protected $_registry;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \GiangVu\Polls\Api\PollRepositoryInterface $pollRepository,
        AnswerCollectionFactory $answerCollectionFactory,
        \Magento\Framework\Registry $registry
    ) {
            $this->_resultPageFactory = $resultPageFactory;
            $this->_pollRepository = $pollRepository;
            $this->_answerCollectionFactory = $answerCollectionFactory;
            $this->_registry = $registry;
            
            parent::__construct($context);
    }
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $poll = $this->_pollRepository->getById($id);
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if (!$poll) {
            $this->messageManager->addErrorMessage(__('Unable to process. Please, try again.'));
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }
        
        try {
            $this->_pollRepository->delete($poll);
            $this->messageManager->addSuccessMessage(__('A Poll (and its related Answer(s)) has been deleted successfully!'));
        }
        catch(\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete a Poll!'));
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}