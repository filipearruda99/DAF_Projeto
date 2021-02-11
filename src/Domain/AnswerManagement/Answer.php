<?php

namespace App\Domain\AnswerManagement;

use App\Domain\AnswerManagement\Answer\Events\AnswerId;
use App\Domain\QuestionManagement\Question\QuestionId;
use App\Domain\UserManagement\User;
use DateTimeImmutable;
use JsonSerializable;


class Answer
{


    private QuestionId $questionId;

    private AnswerId $answerId;

    private User $owner;

    private DateTimeImmutable $givenOn;

    private string $description;


    public function __construct(User $owner, QuestionId $questionId, string $description)
    {
        $this->questionId = $questionId;
        $this->answerId = new AnswerId();
        $this->owner = $owner;
        $this->givenOn = new DateTimeImmutable();
        $this->description = $description;
    }


    /**
     * @return QuestionId
     */
    public function questionId(): QuestionId
    {
        return $this->questionId;
    }

    /**
     * @return AnswerId
     */
    public function answerId(): AnswerId
    {
        return $this->answerId;
    }

    /**
     * @return User
     */
    public function owner(): User
    {
        return $this->owner;
    }

    /**
     * @return DateTimeImmutable
     */
    public function givenOn(): DateTimeImmutable
    {
        return $this->givenOn;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }







}
