<?php
namespace GiangVu\Polls\Controller\Adminhtml\Submission;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Submission';
    
    protected $_resultPageFactory;
    protected $_submissionRepository;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \GiangVu\Polls\Api\SubmissionRepositoryInterface $submissionRepository
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_submissionRepository = $submissionRepository;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $submission = $this->_submissionRepository->getById($id);
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if(!$submission) {
            $this->messageManager->addErrorMessage(__('Unable to process. Please, try again.'));
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }
        
        try {
            $this->_submissionRepository->delete($submission);
            $this->messageManager->addSuccessMessage(__('A Submission record has been deleted successfully!'));
        }
        catch(\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete a Submission record!'));
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}