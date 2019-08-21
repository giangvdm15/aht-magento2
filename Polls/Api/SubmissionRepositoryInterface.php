<?php
namespace GiangVu\Polls\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SubmissionRepositoryInterface
{
    /**
     * Save Submission.
     *
     * @param \GiangVu\Polls\Api\Data\SubmissionInterface $Submission
     * @return \GiangVu\Polls\Api\Data\SubmissionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\GiangVu\Polls\Api\Data\SubmissionInterface $Submission);
    
    /**
     * Retrieve Submission.
     *
     * @param int $SubmissionId
     * @return \GiangVu\Polls\Api\Data\SubmissionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($SubmissionId);
    
    /**
     * Retrieve Submissions matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \GiangVu\Polls\Api\Data\SubmissionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    //     public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    
    /**
     * Delete Submission.
     *
     * @param \GiangVu\Polls\Api\Data\SubmissionInterface $Submission
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\GiangVu\Polls\Api\Data\SubmissionInterface $Submission);
    
    /**
     * Delete Submission by ID.
     *
     * @param int $SubmissionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($SubmissionId);
}