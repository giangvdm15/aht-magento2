<?php
namespace GiangVu\CustomerManager\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
//     protected $_customerFactory;
    
    protected $_customerRepository;
    
    protected $_encryptor;
    
    protected $_coreRegistry;
    
    protected $resultRedirect;
    
    protected $urlInterface;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
//         \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Encryption\EncryptorInterface $encryptorInterface,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
        $this->_pageFactory = $pageFactory;
//         $this->_customerFactory = $customerFactory;
        $this->_customerRepository = $customerRepository;
        $this->_encryptor = $encryptorInterface;
        $this->_coreRegistry = $coreRegistry;
        $this->resultRedirect = $result;
        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        if (isset($_POST['changepasswordbtn'])) {
            $customer = $this->_customerRepository->getById($_POST['changepasswordbtn']);
        }
        elseif (isset($_POST['createbtn'])) {
            $customer->setName($_POST['name']);
            $customer->setUrlKey($_POST['url']);
            $customer->setContent($_POST['content']);
            $customer->setStatus($_POST['status']);
            $customer->setCreatedAt(date('Y-m-d H:i:s'));
            $customer->setUpdatedAt(date('Y-m-d H:i:s'));
        }
        
        $this->_customerRepository->save(
            $customer,
            $this->_encryptor->getHash($_POST['new-password'], true)
        );
        
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customermanager/index/index');
        return $resultRedirect;
    }
}
