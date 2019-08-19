<?php

namespace GiangVu\Polls\Controller\Adminhtml\Answer;

class Index extends \GiangVu\Polls\Controller\Adminhtml\Answer
{
    const ADMIN_RESOURCE = 'Answer';
    
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