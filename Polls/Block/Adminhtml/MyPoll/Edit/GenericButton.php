<?php
namespace GiangVu\Polls\Block\Adminhtml\MyPoll\Edit;
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
        $poll = $this->registry->registry('poll');
        return $poll ? $poll->getId() : null;
    }
    
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}