<?php
namespace GiangVu\Polls\Controller\Adminhtml\Answer;

class Save extends \Magento\Framework\App\Action\Action
{
    const ADMIN_RESOURCE = 'Answer';
    
    protected $_pageFactory;
    protected $_answerFactory;
    protected $_answerRepository;
    protected $_coreRegistry;
    protected $resultRedirect;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \GiangVu\Polls\Model\AnswerFactory $answerFactory,
        \GiangVu\Polls\Api\AnswerRepositoryInterface $answerRepository,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_answerFactory = $answerFactory;
        $this->_answerRepository = $answerRepository;
        $this->_coreRegistry = $coreRegistry;
        $this->resultRedirect = $result;
        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $this->resultRedirect = $this->resultRedirectFactory->create();
        $this->resultRedirect->setPath('polls/*/');
        $postData = $this->getRequest()->getPostValue();
        
        $id = $postData['answer_id'] ? $postData['answer_id'] : null;
        
        if ($id == null) { // save new answer   
            $answer = $this->_answerFactory->create();
        }
        else { // update answer
            $answer = $this->_answerRepository->getById($id);
            $answer->setUpdated_at(date('Y/m/d h:i:s', time()));
        }
        
        $answer->setAnswer_content($postData['answer_content']);
        $answer->setPoll_id($postData['poll_id']);
        $this->_answerRepository->save($answer);
        
        return $this->resultRedirect;
    }
}
