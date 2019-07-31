<?php
namespace GiangVu\CustomerManager\Block;

class ChangePassword extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory;
    protected $customerRepository;
    protected $_coreRegistry;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
//         \Magento\Customer\Model\ResourceModel\CustomerRepository $customerRepositoryInterface,
        \Magento\Framework\Registry $coreRegistry
    ) {
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
//         $this->customerRepository = $customerRepositoryInterface;
        $this->_coreRegistry = $coreRegistry;
    }
    
    public function getCustomer()
    {
        $customerId = $this->_coreRegistry->registry('customer_id');
        // Block doesn't support Repository injection
//         $customer = $this->customerRepository->getById($customerId);
        // use CustomerFactory to retrieve customer instead
        $customer = $this->customerFactory->create();
        return $customer->load($customerId);
    }
    
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}