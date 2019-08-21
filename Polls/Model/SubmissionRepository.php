<?php
namespace GiangVu\Polls\Model;

use GiangVu\Polls\Api\Data;
use GiangVu\Polls\Api\SubmissionRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use GiangVu\Polls\Model\ResourceModel\Submission as ResourceSubmission;
use GiangVu\Polls\Model\ResourceModel\Submission\CollectionFactory as SubmissionCollectionFactory;
/**
 * Class SubmissionRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SubmissionRepository implements SubmissionRepositoryInterface
{
    /**
     * @var ResourceSubmission
     */
    protected $resource;
    
    /**
     * @var SubmissionFactory
     */
    protected $SubmissionFactory;
    
    /**
     * @var SubmissionCollectionFactory
     */
    protected $SubmissionCollectionFactory;
    
    /**
     * @var Data\SubmissionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @param ResourceSubmission $resource
     * @param SubmissionFactory $SubmissionFactory
     * @param Data\SubmissionInterfaceFactory $dataSubmissionFactory
     * @param SubmissionCollectionFactory $SubmissionCollectionFactory
     * @param Data\SubmissionSearchResultsInterfaceFactory $searchResultsFactory
     */
    private $collectionProcessor;
    
    public function __construct(
        ResourceSubmission $resource,
        SubmissionFactory $SubmissionFactory,
        Data\SubmissionInterfaceFactory $dataSubmissionFactory,
        SubmissionCollectionFactory $SubmissionCollectionFactory
    ) {
        $this->resource = $resource;
        $this->SubmissionFactory = $SubmissionFactory;
        $this->SubmissionCollectionFactory = $SubmissionCollectionFactory;
        // $this->searchResultsFactory = $searchResultsFactory;
        // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }
    
    /**
     * Save Submission data
     *
     * @param \GiangVu\Polls\Api\Data\SubmissionInterface $Submission
     * @return Submission
     * @throws CouldNotSaveException
     */
    public function save(\GiangVu\Polls\Api\Data\SubmissionInterface $Submission)
    {
        try {
            $this->resource->save($Submission);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Submission: %1', $exception->getMessage()),
                $exception
                );
        }
        return $Submission;
    }
    
    /**
     * Load Submission data by given Submission Identity
     *
     * @param string $SubmissionId
     * @return Submission
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($SubmissionId)
    {
        $Submission = $this->SubmissionFactory->create();
        $Submission->load($SubmissionId);
        if (!$Submission->getId()) {
            throw new NoSuchEntityException(__('The CMS Submission with the "%1" ID doesn\'t exist.', $SubmissionId));
        }
        return $Submission;
    }
    
    /**
     * Load Submission data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \GiangVu\Polls\Api\Data\SubmissionSearchResultsInterface
     */
    public function getList()
    {
        /** @var \GiangVu\Polls\Model\ResourceModel\Submission\Collection $collection */
        $collection = $this->SubmissionCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Delete Submission
     *
     * @param \GiangVu\Polls\Api\Data\SubmissionInterface $Submission
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\GiangVu\Polls\Api\Data\SubmissionInterface $Submission)
    {
        try {
            $this->resource->delete($Submission);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Submission: %1',
                $exception->getMessage()
                ));
        }
        return true;
    }
    
    /**
     * Delete Submission by given Submission Identity
     *
     * @param string $SubmissionId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($SubmissionId)
    {
        return $this->delete($this->getById($SubmissionId));
    }
}