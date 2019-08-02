<?php
namespace GiangVu\CustomerManager\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ChangePassword extends Column
{
    protected $urlBuilder;
    
    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components=[],
        array $data=[]
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
//             $fieldName = $this->getData('name');
            
            foreach($dataSource['data']['items'] as &$item)
            {
                // Creating buttons doesn't work
//                 $item[$fieldName . '_html'] = "<button class='button'><span>Go</span></button>";
//                 $item[$fieldName . '_title'] = __('Change customer\'s password');
//                 $item[$fieldName . '_submitlabel'] = __('Change Password');
//                 $item[$fieldName . '_cancellabel'] = __('Reset');
//                 $item[$fieldName . '_customerid'] = $item['entity_id'];
                
//                 $item[$fieldName . '_formaction'] = $this->urlBuilder->getUrl('grid/customer/sendmail');

                // so use anchor links instead
                $item[$this->getData('name')]['changepassword'] = [
                    'href' => $this->urlBuilder->getUrl('customermanager/index/changepassword', ['id' => $item['entity_id']]),
                    'label' => __('Change Password'),
                    'hidden' => false
                ];
            }
        }
        
        return $dataSource;
    }
}
