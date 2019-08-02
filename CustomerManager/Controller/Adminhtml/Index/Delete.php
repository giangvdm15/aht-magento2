<?php
namespace GiangVu\CustomerManager\Controller\Adminhtml\Index;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Index';
    
    protected $resultPageFactory;
    protected $customerRepository;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\ResourceModel\CustomerRepository $customerRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->customerRepository = $customerRepository;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $customer = $this->customerRepository->getById($id);
        
        if(!$customer) {
            $this->messageManager->addErrorMessage(__('Unable to process. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }
        
        try {
            $this->customerRepository->delete($customer);
            $this->messageManager->addSuccessMessage(__('A Customer has been deleted successfully!'));
        }
        catch(\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete a Customer'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}