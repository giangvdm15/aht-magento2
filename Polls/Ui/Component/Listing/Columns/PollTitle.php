<?php
namespace GiangVu\Polls\Ui\Component\Listing\Columns;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use GiangVu\Polls\Model\PollRepository;

class PollTitle extends Column
{
    protected $_pollRepository;
    
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     * @param \GiangVu\Polls\Model\PollRepository $pollRepository
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        PollRepository $pollRepository
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_pollRepository = $pollRepository;
    }
    
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item[$fieldName] != '') {
                    $pollTitle = $this->getPollTitle($item[$fieldName]);
                    $item[$fieldName] = $pollTitle;
                }
            }
        }
        
        return $dataSource;
    }
    
    /**
     * @param $pollId
     * @return string
     */
    private function getPollTitle($pollId)
    {
        $poll = $this->_pollRepository->getById($pollId);
        $title = $poll->getPoll_title();
        return $title;
    }
}