<?php

namespace App\Domain\AnswerManagement\Answer\Specification;

use App\Domain\AnswerManagement\Answer;
use App\Domain\AnswerManagement\AnswerSpecification;
use App\Domain\QuestionManagement\Question;


class AcceptedAnswer implements AnswerSpecification
{
    /**
     * Creates an accepted answer specification instance
     *
     * @return AcceptedAnswer
     */
    public static function create(): AcceptedAnswer
    {
        return new AcceptedAnswer();
    }

    /**
     * Returns TRUE whenever the given answer is satisfied by this specification
     *
     * @param Answer $answer
     * @return bool
     */

    public function isSatisfiedBy(Answer $answer): bool
    {
        return $answer->isOpen();
    }

}


