<?php

namespace spec\App\Domain\AnswerManagement\Answer\Events;

use App\Domain\AnswerManagement\Answer\Events\AnswerId;
use App\Domain\Common\RootAggregatorId;
use PhpSpec\ObjectBehavior;

class AnswerIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerId::class);
    }
    function its_a_root_aggregate_identifier()
    {
        $this->shouldBeAnInstanceOf(RootAggregatorId::class);
    }
}
