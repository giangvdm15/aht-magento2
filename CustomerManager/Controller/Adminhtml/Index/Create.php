<?php
namespace GiangVu\CustomerManager\Controller\Adminhtml\Index;

class Create extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
    protected $_customerFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory
    ) {
            $this->_pageFactory = $pageFactory;
            $this->_postFactory = $customerFactory;
            return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}