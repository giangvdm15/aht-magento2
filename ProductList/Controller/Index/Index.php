<?php
namespace GiangVu\ProductList\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
    protected $_productCollectionFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollectionFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $page = $this->_pageFactory->create();
        $page->getLayout()->getBlock('page.main.title')->setPageTitle(__('Product List'));
        $page->getConfig()->getTitle()->set(__('Product List'));
        
        return $page;
    }
}