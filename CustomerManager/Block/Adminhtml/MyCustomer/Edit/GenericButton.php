<?php
namespace GiangVu\CustomerManager\Block\Adminhtml\MyCustomer\Edit;
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
        $customer = $this->registry->registry('customer');
        return $customer ? $customer->getId() : null;
    }
    
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}