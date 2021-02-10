<?php

namespace spec\App\Application\QuestionManagement;

use App\Application\CommandHandler;
use App\Application\QuestionManagement\DeleteQuestionCommand;
use App\Application\QuestionManagement\DeleteQuestionHandler;
use App\Application\QuestionManagement\EditQuestionCommand;
use App\Domain\Exception\FailedEntitySpecification;
use App\Domain\QuestionManagement\Question;
use App\Domain\QuestionManagement\Question\QuestionId;
use App\Domain\QuestionManagement\QuestionsRepository;
use App\Domain\QuestionManagement\Specification\CurrentUserOwnsQuestion;
use PhpSpec\ObjectBehavior;
use Slick\Event\EventDispatcher;

class DeleteQuestionHandlerSpec extends ObjectBehavior
{

    private $questionId;
    private $title;
    private $body;

    function let(
        QuestionsRepository $questions,
        EventDispatcher $dispatcher,
        Question $question,
        CurrentUserOwnsQuestion $currentUserOwnsQuestion
    ) {

        $this->questionId = new QuestionId();
        $questions->withId($this->questionId)->willReturn($question);

        $this->title = "Changed title";
        $this->body = "changed body";
        $question->change($this->title, $this->body)->willReturn($question);
        $question->isOpen()->willReturn(true);

        $questions->update($question)->willReturnArgument(0);

        $dispatcher->dispatchEventsFrom($question)->willReturn([]);

        $this->beConstructedWith($questions, $dispatcher, $currentUserOwnsQuestion);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteQuestionHandler::class);
    }


    function its_a_command_handler()
        {
        $this->shouldBeAnInstanceOf(CommandHandler::class);
    }

    function it_handles_delete_question_command(
        QuestionsRepository $questions,
        EventDispatcher $dispatcher,
        Question $question,
        CurrentUserOwnsQuestion $currentUserOwnsQuestion
    ) {
        $command = new EditQuestionCommand(
            $this->questionId,
            $this->title,
            $this->body
        );
        $currentUserOwnsQuestion
            ->isSatisfiedBy($question)
            ->shouldBeCalled()
            ->willReturn(true);

        $this->handle($command)->shouldBe($question);

        $question->change($this->title, $this->body)->shouldHaveBeenCalled();
        $questions->update($question)->shouldHaveBeenCalled();
        $dispatcher->dispatchEventsFrom($question)->shouldHaveBeenCalled();
    }

    function it_throws_exception_when_user_does_not_own_the_question(
        QuestionsRepository $questions,
        EventDispatcher $dispatcher,
        Question $question,
        CurrentUserOwnsQuestion $currentUserOwnsQuestion
    ) {
        $command = new DeleteQuestionCommand(
            $this->questionId,
            $this->title,
            $this->body
        );
        $currentUserOwnsQuestion
            ->isSatisfiedBy($question)
            ->shouldBeCalled()
            ->willReturn(false);

        $this->shouldThrow(FailedEntitySpecification::class)
            ->during('handle', [$command]);

        $question->change($this->title, $this->body)->shouldNotHaveBeenCalled();
        $questions->update($question)->shouldNotHaveBeenCalled();
        $dispatcher->dispatchEventsFrom($question)->shouldNotHaveBeenCalled();
    }










}
