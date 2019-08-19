<?php
namespace GiangVu\Polls\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface AnswerRepositoryInterface
{
    /**
     * Save .
     *
     * @param \GiangVu\Polls\Api\Data\AnswerInterface $Answer
     * @return \GiangVu\Polls\Api\Data\AnswerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\GiangVu\Polls\Api\Data\AnswerInterface $Answer);
    
    /**
     * Retrieve Answer.
     *
     * @param int $AnswerId
     * @return \GiangVu\Polls\Api\Data\AnswerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($AnswerId);
    
    /**
     * Retrieve Answers matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \GiangVu\Polls\Api\Data\AnswerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    // public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    
    /**
     * Delete Answer.
     *
     * @param \GiangVu\Polls\Api\Data\AnswerInterface $Answer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\GiangVu\Polls\Api\Data\AnswerInterface $Answer);
    
    /**
     * Delete Answer by ID.
     *
     * @param int $AnswerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($AnswerId);
}