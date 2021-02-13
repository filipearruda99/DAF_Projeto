<?php


namespace App\Domain\AnswerManagement;


use App\Domain\AnswerManagement\Answer\AnswerId;
use App\Domain\Exception\EntityNotFound;


interface AnswerRepository
{
    /**
     * Adds a answer to the answer repository
     *
     * @param Answer $answer
     * @return Answer
     */
    public function add(Answer $answer): Answer;

    /**
     * Retrieves the answer stored with provided identifier
     *
     * @param AnswerId $answerId
     * @return Answer
     * @throws EntityNotFound when no answer is found for provided identifier
     */
    public function withId(AnswerId $answerId): Answer;

    /**
     * Updates changes on provided answer
     *
     * @param Answer $answer
     * @return Answer
     */
    public function update(Answer $answer): Answer;

    /**
     * Remove provided answer from repository
     *
     * @param Answer $question
     */
    public function remove(Answer $answer): void;
}

}