<?php

namespace App\Application\AnswerManagement;

use App\Application\Command;
use App\Domain\UserManagement\User;

class AddAnswerCommand implements Command
{
    /**
     * AddAnswerCommand
     *
     * @package App\Application\AnswerManagement
     *
     * @OA\Schema(
     *     description="AddAnswerCommand",
     *     title="AddAnswerCommand"
     * )
     */


    /**
     * @var User
     */
    private User $owner;

    /**
     * @var string
     *
     * @OA\Property(
     *     description="Answer description",
     *     example="Its 7 pm?"
     * )
     */
    private string $description;



    /**
     * Creates a AddAnswerCommand
     *
     * @param User $owner
     * @param string $description

     */
    public function __construct(User $owner, string $description)
    {
        $this->owner = $owner;
        $this->description = $description;

    }

    /**
     * owner
     *
     * @return User
     */
    public function owner(): User
    {
        return $this->owner;
    }

    /**
     * title
     *
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }


    }
