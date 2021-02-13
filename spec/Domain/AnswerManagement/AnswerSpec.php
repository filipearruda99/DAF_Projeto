<?php

namespace spec\App\Domain\AnswerManagement;

use App\Domain\AnswerManagement\Answer;
use App\Domain\QuestionManagement\Question;
use App\Domain\QuestionManagement\Question\QuestionId;
use App\Domain\UserManagement\User;
use PhpSpec\ObjectBehavior;

class AnswerSpec extends ObjectBehavior
{


    private Question $question;

    private $description;



    function let(User $user, Question $question)
    {
        $user->userId()->willReturn(new User\UserId());
        $question->questionId()->willReturn(new QuestionId());
        $this->description = "It's 5 pm";
        $this->beConstructedWith($user, $question, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Answer::class);
    }

    function it_has_a_user(User $user)
    {
        $this->owner()->shouldBe($user);
    }

    function it_has_a_answer_id()
    {
        $this->answerId()->shouldBeAnInstanceOf(Answer\AnswerId::class);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }

    function it_has_a_date_when_answer_was_given()
    {
        $this->givenOn()->shouldBeAnInstanceOf(\DateTimeImmutable::class);
    }

    function it_has_a_question(Question $question)
    {
        $this->question()->shouldBe($question);
    }






}
