<?php

namespace spec\App\Application\QuestionManagement;

use App\Application\Command;
use App\Application\QuestionManagement\DeleteQuestionCommand;
use App\Domain\QuestionManagement\Question\QuestionId;
use PhpSpec\ObjectBehavior;

class DeleteQuestionCommandSpec extends ObjectBehavior
{
    private $questionId;
    private $title;
    private $body;

    function let()
    {
        $this->questionId = new QuestionId();
        $this->title = 'Delete title';
        $this->body = 'Delete body';
        $this->beConstructedWith($this->questionId, $this->title, $this->body);
    }


    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteQuestionCommand::class);
    }


    function its_a_command()
    {
        $this->shouldBeAnInstanceOf(Command::class);
    }

    function it_has_a_questionId()
    {
        $this->questionId()->shouldBe($this->questionId);
    }

    function it_has_a_title()
    {
        $this->title()->shouldBe($this->title);
    }

    function it_has_a_body()
    {
        $this->body()->shouldBe($this->body);
    }
















}
