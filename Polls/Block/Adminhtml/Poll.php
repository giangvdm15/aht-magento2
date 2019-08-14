<?php
namespace GiangVu\Polls\Block\Adminhtml;

class Poll extends \Magento\Backend\Block\Widget\Grid\Container
{
    
    protected function _construct()
    {
        $this->_controller = 'adminhtml_poll';
        $this->_blockGroup = 'GiangVu_Polls';
        $this->_headerText = __('Polls');
        $this->_addButtonLabel = __('Create New Poll');
        parent::_construct();
    }
}