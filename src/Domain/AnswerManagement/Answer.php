<?php

namespace App\Domain\AnswerManagement;

use App\Domain\AnswerManagement\Answer\AnswerId;
use App\Domain\QuestionManagement\Question;
use App\Domain\UserManagement\User;
use DateTimeImmutable;



class Answer
{


    private Question $question;

    private AnswerId $answerId;

    private User $owner;

    private DateTimeImmutable $givenOn;

    private string $description;


    public function __construct(User $owner, Question $question, string $description)
    {
        $this->question = $question;
        $this->answerId = new AnswerId();
        $this->owner = $owner;
        $this->givenOn = new DateTimeImmutable();
        $this->description = $description;
    }


    /**
     * @return Question
     */
    public function question(): Question
    {
        return $this->question;
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
