<?php

namespace spec\App\Application\AnswerManagement;

use App\Application\AnswerManagement\AddAnswerCommand;
use App\Application\AnswerManagement\DeleteAnswerCommand;
use App\Application\Command;
use App\Domain\UserManagement\User;
use PhpSpec\ObjectBehavior;

class DeleteAnswerCommandSpec extends ObjectBehavior
{

    private $description;


    function let(User $user)
    {
        $this->description = "HI?";


        $this->beConstructedWith($user, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteAnswerCommand::class);
    }

    function its_a_command()
    {
        $this->shouldBeAnInstanceOf(Command::class);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }


    function it_has_a_user(User $user)
    {
        $this->owner()->shouldBe($user);
    }


}
