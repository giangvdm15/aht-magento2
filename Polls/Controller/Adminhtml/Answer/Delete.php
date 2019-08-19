<?php
namespace GiangVu\Polls\Controller\Adminhtml\Answer;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Answer';
    
    protected $_resultPageFactory;
    protected $_answerRepository;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \GiangVu\Polls\Api\AnswerRepositoryInterface $answerRepository
    ) {
            $this->_resultPageFactory = $resultPageFactory;
            $this->_answerRepository = $answerRepository;
            parent::__construct($context);
    }
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $answer = $this->_answerRepository->getById($id);
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if(!$answer) {
            $this->messageManager->addErrorMessage(__('Unable to process. Please, try again.'));
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }
        
        try {
            $this->_answerRepository->delete($answer);
            $this->messageManager->addSuccessMessage(__('An Answer has been deleted successfully!'));
        }
        catch(\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete an Answer!'));
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}