<?php
namespace GiangVu\Polls\Model;

use GiangVu\Polls\Api\Data;
use GiangVu\Polls\Api\PollRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use GiangVu\Polls\Model\ResourceModel\Poll as ResourcePoll;
use GiangVu\Polls\Model\ResourceModel\Poll\CollectionFactory as PollCollectionFactory;
/**
 * Class PollRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PollRepository implements PollRepositoryInterface
{
    /**
     * @var ResourcePoll
     */
    protected $resource;
    
    /**
     * @var PollFactory
     */
    protected $PollFactory;
    
    /**
     * @var PollCollectionFactory
     */
    protected $PollCollectionFactory;
    
    /**
     * @var Data\PollSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @param ResourcePoll $resource
     * @param PollFactory $PollFactory
     * @param Data\PollInterfaceFactory $dataPollFactory
     * @param PollCollectionFactory $PollCollectionFactory
     * @param Data\PollSearchResultsInterfaceFactory $searchResultsFactory
     */
    private $collectionProcessor;
    
    public function __construct(
        ResourcePoll $resource,
        PollFactory $PollFactory,
        Data\PollInterfaceFactory $dataPollFactory,
        PollCollectionFactory $PollCollectionFactory
    ) {
        $this->resource = $resource;
        $this->PollFactory = $PollFactory;
        $this->PollCollectionFactory = $PollCollectionFactory;
        // $this->searchResultsFactory = $searchResultsFactory;
        // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }
    
    /**
     * Save Poll data
     *
     * @param \GiangVu\Polls\Api\Data\PollInterface $Poll
     * @return Poll
     * @throws CouldNotSaveException
     */
    public function save(\GiangVu\Polls\Api\Data\PollInterface $Poll)
    { 
        try {
            $this->resource->save($Poll);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Poll: %1', $exception->getMessage()),
                $exception
            );
        }
        return $Poll;
    }
    
    /**
     * Load Poll data by given Poll Identity
     *
     * @param string $PollId
     * @return Poll
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($PollId)
    {
        $Poll = $this->PollFactory->create();
        $Poll->load($PollId);
        if (!$Poll->getId()) {
            throw new NoSuchEntityException(__('The CMS Poll with the "%1" ID doesn\'t exist.', $PollId));
        }
        return $Poll;
    }
    
    /**
     * Load Poll data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \GiangVu\Polls\Api\Data\PollSearchResultsInterface
     */
    public function getList()
    {
        /** @var \GiangVu\Polls\Model\ResourceModel\Poll\Collection $collection */
        $collection = $this->PollCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Delete Poll
     *
     * @param \GiangVu\Polls\Api\Data\PollInterface $Poll
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\GiangVu\Polls\Api\Data\PollInterface $Poll)
    {
        try {
            $this->resource->delete($Poll);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Poll: %1',
                $exception->getMessage()
                ));
        }
        return true;
    }
    
    /**
     * Delete Poll by given Poll Identity
     *
     * @param string $PollId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($PollId)
    {
        return $this->delete($this->getById($PollId));
    }
}