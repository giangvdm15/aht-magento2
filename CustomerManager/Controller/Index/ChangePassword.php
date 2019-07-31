<?php
namespace GiangVu\CustomerManager\Controller\Index;

class ChangePassword extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
    protected $_coreRegistry;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $customer_id = $this->getRequest()->getParam('customer_id');
        $this->_coreRegistry->register('customer_id', $customer_id);
        return $this->_pageFactory->create();
    }
}