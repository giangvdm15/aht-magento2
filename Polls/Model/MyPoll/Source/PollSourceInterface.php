<?php
namespace GiangVu\Polls\Model\MyPoll\Source;

interface PollSourceInterface
{
    public function toOptionArray();
}