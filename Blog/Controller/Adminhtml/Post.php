<?php

namespace GiangVu\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class Post extends Action
{
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'GiangVu_Blog::blog'
            )->_addBreadcrumb(
                __('Blog'),
                __('Blog')
                );
            return $this;
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('GiangVu_Blog::blog');
    }
}
