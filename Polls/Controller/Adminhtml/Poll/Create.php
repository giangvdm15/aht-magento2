<?php
namespace GiangVu\Polls\Controller\Adminhtml\Poll;

class Create extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
    protected $_pollFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \GiangVu\Polls\Model\PollFactory $pollFactory
    ) {
            $this->_pageFactory = $pageFactory;
            $this->_pollFactory = $pollFactory;
            return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}