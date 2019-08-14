<?php

namespace GiangVu\Polls\Api\Data;

interface PollSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Post list.
     * @return \GiangVu\Polls\Api\Data\PollInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \GiangVu\Polls\Api\Data\PollInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}