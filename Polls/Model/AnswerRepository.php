<?php
namespace GiangVu\Polls\Model;

use GiangVu\Polls\Api\Data;
use GiangVu\Polls\Api\AnswerRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use GiangVu\Polls\Model\ResourceModel\Answer as ResourceAnswer;
use GiangVu\Polls\Model\ResourceModel\Answer\CollectionFactory as AnswerCollectionFactory;
/**
 * Class AnswerRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AnswerRepository implements AnswerRepositoryInterface
{
    /**
     * @var ResourceAnswer
     */
    protected $resource;
    
    /**
     * @var AnswerFactory
     */
    protected $AnswerFactory;
    
    /**
     * @var AnswerCollectionFactory
     */
    protected $AnswerCollectionFactory;
    
    /**
     * @var Data\AnswerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @param ResourceAnswer $resource
     * @param AnswerFactory $AnswerFactory
     * @param Data\AnswerInterfaceFactory $dataAnswerFactory
     * @param AnswerCollectionFactory $AnswerCollectionFactory
     * @param Data\AnswerSearchResultsInterfaceFactory $searchResultsFactory
     */
    private $collectionProcessor;
    
    public function __construct(
        ResourceAnswer $resource,
        AnswerFactory $AnswerFactory,
        Data\AnswerInterfaceFactory $dataAnswerFactory,
        AnswerCollectionFactory $AnswerCollectionFactory
    ) {
            $this->resource = $resource;
            $this->AnswerFactory = $AnswerFactory;
            $this->AnswerCollectionFactory = $AnswerCollectionFactory;
            // $this->searchResultsFactory = $searchResultsFactory;
            // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }
    
    /**
     * Save Answer data
     *
     * @param \GiangVu\Polls\Api\Data\AnswerInterface $Answer
     * @return Answer
     * @throws CouldNotSaveException
     */
    public function save(\GiangVu\Polls\Api\Data\AnswerInterface $Answer)
    {
        try {
            $this->resource->save($Answer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Answer: %1', $exception->getMessage()),
                $exception
            );
        }
        return $Answer;
    }
    
    /**
     * Load Answer data by given Answer Identity
     *
     * @param string $AnswerId
     * @return Answer
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($AnswerId)
    {
        $Answer = $this->AnswerFactory->create();
        $Answer->load($AnswerId);
        if (!$Answer->getId()) {
            throw new NoSuchEntityException(__('The CMS Answer with the "%1" ID doesn\'t exist.', $AnswerId));
        }
        return $Answer;
    }
    
    /**
     * Load Answer data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \GiangVu\Polls\Api\Data\AnswerSearchResultsInterface
     */
    public function getList()
    {
        /** @var \GiangVu\Polls\Model\ResourceModel\Answer\Collection $collection */
        $collection = $this->AnswerCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Delete Answer
     *
     * @param \GiangVu\Polls\Api\Data\AnswerInterface $Answer
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\GiangVu\Polls\Api\Data\AnswerInterface $Answer)
    {
        try {
            $this->resource->delete($Answer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Answer: %1',
                $exception->getMessage()
                ));
        }
        return true;
    }
    
    /**
     * Delete Answer by given Answer Identity
     *
     * @param string $AnswerId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($AnswerId)
    {
        return $this->delete($this->getById($AnswerId));
    }
}