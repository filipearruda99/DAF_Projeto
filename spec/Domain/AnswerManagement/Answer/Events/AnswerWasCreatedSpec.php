<?php

namespace spec\App\Domain\AnswerManagement\Answer\Events;

use App\Domain\AnswerManagement\Answer;
use App\Domain\AnswerManagement\Answer\Events\AnswerWasCreated;
use App\Domain\QuestionManagement\Question;
use App\Domain\UserManagement\User;
use PhpSpec\ObjectBehavior;
use Slick\Event\Domain\AbstractEvent;
use Slick\Event\Event;

class AnswerWasCreatedSpec extends ObjectBehavior
{
    private $answerId;
    private $userId;
    private $description;
    private $question;


    function let(Answer $answer, User $user, Question $question)
    {

        $this->answerId = new Answer\AnswerId();
        $this->userId = new User\UserId();
        $this->question = $question;
        $this->description= "Nova Resposta";



        $answer->answerId()->willReturn($this->answerId);
        $answer->owner()->willReturn($this->user);
        $answer->description()->willReturn($this->description);
        $user->userId()->willReturn($this->userId);
        $answer->question()->willReturn($this->question);


        $this->beConstructedWith(
            $answer
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerWasCreated::class);
    }

    function its_an_event()
    {
        $this->shouldBeAnInstanceOf(Event::class);
        $this->shouldHaveType(AbstractEvent::class);
        $this->givenOn()->shouldBeAnInstanceOf(\DateTimeImmutable::class);
    }

    function it_has_a_owner_id()
    {
        $this->owner()->shouldBe($this->userId);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }

    function it_has_a_question()
    {
        $this->question()->shouldBe($this->question);
    }

}
