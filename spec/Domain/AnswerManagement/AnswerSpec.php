<?php

namespace spec\App\Domain\AnswerManagement;

use App\Domain\AnswerManagement\Answer;
use App\Domain\Common\RootAggregatorId;
use PhpSpec\ObjectBehavior;

class AnswerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Answer::class);
    }

    function its_a_root_aggregate_identifier()
    {
        $this->shouldBeAnInstanceOf(RootAggregatorId::class);
    }

}
