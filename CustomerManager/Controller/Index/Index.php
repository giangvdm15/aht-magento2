<?php
namespace GiangVu\CustomerManager\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
    protected $_customerCollectionFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory
    ) {
            $this->_pageFactory = $pageFactory;
            $this->_customerCollectionFactory = $customerCollectionFactory;
            return parent::__construct($context);
    }
    
    public function execute()
    {
        $page = $this->_pageFactory->create();
        $page->getLayout()->getBlock('page.main.title')->setPageTitle(__('Customer List'));
        $page->getConfig()->getTitle()->set(__('Customer List'));
        
        return $page;
    }
}