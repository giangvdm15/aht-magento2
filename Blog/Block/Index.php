<?php

namespace GiangVu\Blog\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_postFactory;
    protected $_postRepository;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \GiangVu\Blog\Model\PostFactory $postFactory,
        \GiangVu\Blog\Model\PostRepository $postRepo
        )
    {
        parent::__construct($context);
        $this->_postFactory = $postFactory;
        $this->_postRepository = $postRepo;
    }
    
    public function getBlogInfo()
    {
        return __('Giang\'s Blog module');
    }
    
    public function getPosts()
    {
        $collection = $this->_postRepository->getList();
        
        return $collection;
    }
    
}