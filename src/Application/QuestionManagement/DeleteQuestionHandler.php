<?php

namespace App\Application\QuestionManagement;

use App\Application\Command;
use App\Application\CommandHandler;
use App\Domain\Exception\FailedEntitySpecification;
use App\Domain\QuestionManagement\Question;
use App\Domain\QuestionManagement\QuestionsRepository;
use App\Domain\QuestionManagement\Specification\CurrentUserOwnsQuestion;
use Slick\Event\EventDispatcher;

class DeleteQuestionHandler implements CommandHandler
{
    /**
     * @var QuestionsRepository
     */
    private QuestionsRepository $questions;

    /**
     * @var EventDispatcher
     */
    private EventDispatcher $dispatcher;

    /**
     * @var CurrentUserOwnsQuestion
     */
    private CurrentUserOwnsQuestion $currentUserOwnsQuestion;

    /**
     * Creates a EditQuestionHandler
     *
     * @param QuestionsRepository $questions
     * @param EventDispatcher $dispatcher
     * @param CurrentUserOwnsQuestion $currentUserOwnsQuestion
     */
    public function __construct(
    QuestionsRepository $questions,
    EventDispatcher $dispatcher,
    CurrentUserOwnsQuestion $currentUserOwnsQuestion
) {
    $this->questions = $questions;
    $this->dispatcher = $dispatcher;
    $this->currentUserOwnsQuestion = $currentUserOwnsQuestion;
}

    /**
     * Handle provide command
     *
     * @param Command|DeleteQuestionCommand $command
     * @return Question
     */
    public function handle(Command $command)
{
    $question = $this->questions->withId($command->questionId());
    if (!$this->currentUserOwnsQuestion->isSatisfiedBy($question)) {
        throw new FailedEntitySpecification(
            "Only question owner can delete the question."
        );
    }

    $this->dispatcher->dispatchEventsFrom(
        $this->questions->update(
            $question->change($command->title(), $command->body())
        )
    );
    return $question;
}
}
