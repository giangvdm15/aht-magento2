<?php

namespace GiangVu\Polls\Api\Data;

interface SubmissionSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    
    /**
     * Get Poll list.
     * @return \GiangVu\Polls\Api\Data\SubmissionInterface[]
     */
    public function getItems();
    
    /**
     * Set name list.
     * @param \GiangVu\Polls\Api\Data\SubmissionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}