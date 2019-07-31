<?php

namespace GiangVu\Blog\Controller\Adminhtml\Post;

class NewAction extends \GiangVu\Blog\Controller\Adminhtml\Post
{
    public function execute()
    {
        $this->_forward('edit');
    }
}