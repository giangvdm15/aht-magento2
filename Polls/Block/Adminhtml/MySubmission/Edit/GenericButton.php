<?php
namespace GiangVu\Polls\Block\Adminhtml\MySubmission\Edit;
use Magento\Search\Controller\RegistryConstants;

class GenericButton
{
    protected $urlBuilder;
    protected $registry;
    
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }
    
    public function getId()
    {
        $answer = $this->registry->registry('submission');
        return $answer ? $answer->getId() : null;
    }
    
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}