<?php
namespace GiangVu\Blog\Block;
class Create extends \Magento\Framework\View\Element\Template
{
    private $postFactory;
    private $postRepository;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \GiangVu\Blog\Model\PostFactory $postFactory,
        \GiangVu\Blog\Model\PostRepository $postRepository
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }
}
