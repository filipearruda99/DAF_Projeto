<?php

namespace App\Domain\AnswerManagement\Answer\Events;

use App\Domain\AnswerManagement\Answer;

use App\Domain\AnswerManagement\Answer\AnswerId;
use App\Domain\QuestionManagement\Question;
use App\Domain\UserManagement\User\UserId;
use Slick\Event\Domain\AbstractEvent;
use Slick\Event\Event;

class AnswerWasCreated extends AbstractEvent implements Event
{
    private AnswerId $answerId;
    private UserId $owner;
    private Question $question;
    private string $description;
    private \DateTimeImmutable $givenOn;

      /**
       * Creates a AnswerWasCreated
       *
       * @param Answer $answer
       */

      public function __construct(Answer $answer)
      {
        parent:: __construct();
        $this->answerId = $answer->answerId();
        $this->owner = $answer->owner()->userId();
        $this->question = $answer->question();
        $this->description = $answer->description();
        $this->givenOn = new \DateTimeImmutable();

      }

    /**
     * @return AnswerId
     */
    public function answerId(): AnswerId
    {
        return $this->answerId;
    }

    /**
     * @return UserId
     */
    public function owner(): UserId
    {
        return $this->owner;
    }

    /**
     * @return Question
     */
    public function question(): Question
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    public function givenOn()
    {
        return $this->givenOn;
    }



}

