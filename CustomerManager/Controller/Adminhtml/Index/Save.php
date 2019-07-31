<?php
namespace GiangVu\CustomerManager\Controller\Adminhtml\Index;

class Save extends \Magento\Framework\App\Action\Action
{
    const ADMIN_RESOURCE = 'Index';
    
    protected $_pageFactory;
    protected $_customerFactory;
//     protected $_customerRepository;
    protected $_encryptor;
    protected $_coreRegistry;
    protected $resultRedirect;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
//         \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Encryption\EncryptorInterface $encryptorInterface,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
            $this->_pageFactory = $pageFactory;
            $this->_customerFactory = $customerFactory;
//             $this->_customerRepository = $customerRepository;
            $this->_encryptor = $encryptorInterface;
            $this->_coreRegistry = $coreRegistry;
            $this->resultRedirect = $result;
            
            return parent::__construct($context);
    }
    
    public function execute()
    {
        $this->resultRedirect = $this->resultRedirectFactory->create();
        $this->resultRedirect->setPath('customer/*/');
        $data = $this->getRequest()->getPostValue();
        
        $id = $data['entity_id'];
        $password = $data['new_password'];
        
        $customer = $this->_customerFactory->create();
        $customer = $customer->load($id);
        $customer = $customer->changePassword($password);
        $customer->save();
        
//         $customer = $this->customerRepository->getById($id);
//         $this->customerRepository->save($customer, $this->encryptor->getHash($password, true));
        return $this->resultRedirect;
    }
}
