<?php

namespace GiangVu\Polls\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class Answer extends Action
{
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'GiangVu_Polls::answers'
            )->_addBreadcrumb(
                __('Answers'),
                __('Answers')
                );
            return $this;
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('GiangVu_Polls::answers');
    }
}
