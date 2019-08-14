<?php

namespace GiangVu\Polls\Controller\Adminhtml\Poll;

class Index extends \GiangVu\Polls\Controller\Adminhtml\Poll
{
    const ADMIN_RESOURCE = 'Poll';
    
    protected $resultPageFactory;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
    
}