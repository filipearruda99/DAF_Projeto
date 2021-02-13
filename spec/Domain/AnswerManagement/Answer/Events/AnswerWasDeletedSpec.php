<?php

namespace spec\App\Domain\AnswerManagement\Answer\Events;

use App\Domain\AnswerManagement\Answer\AnswerId;
use App\Domain\AnswerManagement\Answer\Events\AnswerWasDeleted;
use App\Domain\QuestionManagement\Question\QuestionId;
use PhpSpec\ObjectBehavior;
use Slick\Event\Domain\AbstractEvent;
use Slick\Event\Event;

class AnswerWasDeletedSpec extends ObjectBehavior
{

    private $answerId;

    function let()
    {
        $this->answerId = new AnswerId();
        $this->beConstructedWith($this->answerId);
    }


    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerWasDeleted::class);
    }

    function its_an_event()
    {
        $this->shouldBeAnInstanceOf(Event::class);
        $this->shouldHaveType(AbstractEvent::class);

    }

    function it_has_a_answerId()
    {
        $this->answerId()->shouldBe($this->answerId);
    }


}
