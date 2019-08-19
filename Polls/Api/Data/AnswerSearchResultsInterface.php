<?php

namespace GiangVu\Polls\Api\Data;

interface AnswerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    
    /**
     * Get Answer list.
     * @return \GiangVu\Polls\Api\Data\AnswerInterface[]
     */
    public function getItems();
    
    /**
     * Set name list.
     * @param \GiangVu\Polls\Api\Data\AnswerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}