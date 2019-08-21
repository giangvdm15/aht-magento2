<?php
namespace GiangVu\Polls\Controller\Poll;

class Submit extends \Magento\Framework\App\Action\Action
{
    
    protected $_pageFactory;
    protected $_submissionFactory;
    protected $_submissionRepository;
    protected $_coreRegistry;
    protected $_resultRedirect;
    private $_cacheTypeList;
    private $_cacheFrontendPool;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \GiangVu\Polls\Model\SubmissionFactory $submissionFactory,
        \GiangVu\Polls\Api\SubmissionRepositoryInterface $submissionRepository,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_submissionFactory = $submissionFactory;
        $this->_submissionRepository = $submissionRepository;
        $this->_coreRegistry = $coreRegistry;
        $this->_resultRedirect = $result;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        if (isset($_POST['submit-poll'])) {
            $submitData = $this->getRequest()->getPostValue();
            
            $newSubmission = $this->_submissionFactory->create();
            
            $newSubmission->setPoll_id($submitData['poll_id']);
            $newSubmission->setCustomer_id($submitData['customer_id']);
            $newSubmission->setAnswer_id($submitData['answer_id']);
            
            $this->_submissionRepository->save($newSubmission);
        }
        
        $types = array(
            'config',
            'layout',
            'block_html',
            'collections',
            'reflection',
            'db_ddl',
            'compiled_config',
            'eav',
            'config_integration',
            'config_integration_api',
            'full_page',
            'translate',
            'config_webservice',            
            'vertex'
        );
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath($submitData['current-page']);
    }
}