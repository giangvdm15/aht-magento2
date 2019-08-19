<?php
namespace GiangVu\Polls\Controller\Adminhtml\Answer;

class Create extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
    protected $_answerFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \GiangVu\Polls\Model\AnswerFactory $answerFactory
    ) {
            $this->_pageFactory = $pageFactory;
            $this->_answerFactory = $answerFactory;
            return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}