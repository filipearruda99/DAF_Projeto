<?php

namespace spec\App\Domain\AnswerManagement\Answer\Events;

use App\Domain\AnswerManagement\Answer\AnswerId;
use App\Domain\AnswerManagement\Answer\Events\AnswerWasEdited;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;
use Slick\Event\Domain\AbstractEvent;
use Slick\Event\Event;

class AnswerWasEditedSpec extends ObjectBehavior
{

    private $answerId;
    private $description;




    function let()
    {
        $this->answerId = new AnswerId();
        $this->description = "new description";
        $this->beConstructedWith(
            $this->answerId,
            $this->description,

        );
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

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerWasEdited::class);
    }
}
