<?php

namespace spec\App\Domain\AnswerManagement\Answer\Specification;

use App\Domain\AnswerManagement\Answer;
use App\Domain\AnswerManagement\Answer\Specification\AcceptedAnswer;
use PhpSpec\ObjectBehavior;

class AcceptedAnswerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AcceptedAnswer::class);
    }

    function its_a_answer_specification()
    {
        $this->shouldBeAnInstanceOf(AnswerSpecification::class);
    }

    function its_true_when_question_has_open_flag_to_true(Answer $answer)
    {
        $answer->isAccepted()->willReturn(true);
        $this->isSatisfiedBy($answer)->shouldBe(true);
    }

    function its_false_when_question_has_open_flag_to_false(Answer $answer)
    {
        $answer->isOpen()->willReturn(false);
        $this->isSatisfiedBy($answer)->shouldBe(false);
    }

    function it_can_be_created_statically()
    {
        $this->beConstructedThrough('create');
        $this->shouldHaveType(AcceptedAnswer::class);
    }

}
