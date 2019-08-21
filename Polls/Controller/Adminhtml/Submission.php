<?php

namespace GiangVu\Polls\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class Submission extends Action
{
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'GiangVu_Polls::polls'
            )->_addBreadcrumb(
                __('Polls'),
                __('Submissions')
                );
            return $this;
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('GiangVu_Polls::submissions');
    }
}
