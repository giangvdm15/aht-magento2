<?php
namespace GiangVu\Polls\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PollRepositoryInterface
{
    /**
     * Save Poll.
     *
     * @param \GiangVu\Polls\Api\Data\PollInterface $Poll
     * @return \GiangVu\Polls\Api\Data\PollInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\GiangVu\Polls\Api\Data\PollInterface $Poll);
    
    /**
     * Retrieve Poll.
     *
     * @param int $PollId
     * @return \GiangVu\Polls\Api\Data\PollInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($PollId);
    
    /**
     * Retrieve Polls matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \GiangVu\Polls\Api\Data\PollSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
//     public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    
    /**
     * Delete Poll.
     *
     * @param \GiangVu\Polls\Api\Data\PollInterface $Poll
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\GiangVu\Polls\Api\Data\PollInterface $Poll);
    
    /**
     * Delete Poll by ID.
     *
     * @param int $PollId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($PollId);
}