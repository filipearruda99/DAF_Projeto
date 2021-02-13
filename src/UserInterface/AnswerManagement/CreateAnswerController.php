<?php


namespace App\UserInterface\AnswerManagement;


use App\Application\AnswerManagement\AddAnswerCommand;
use App\Application\CommandBus;
use App\Domain\Exception\EntityNotFound;
use App\UserInterface\ApiControllerMethods;
use App\UserInterface\UserManagement\OAuth2\AuthenticatedControllerInterface;
use App\UserInterface\UserManagement\OAuth2\AuthenticatedControllerMethods;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * CreateAnswerController
 *
 * @package App\UserInterface\AnswerManagement
 */


final class CreateAnswerController extends AbstractController implements AuthenticatedControllerInterface
{
    use ApiControllerMethods;
    use AuthenticatedControllerMethods;

    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * Creates a CreateAnswerController
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }


    /**
     * Handles add new answer command request
     *
     * @return Response
     * @Route(path="/answers", methods={"POST"})
     */
    public function handle(Request $request): Response
    {
        $user = $this->currentUser();
        $data = $this->parseRequest($request, ["description"]);
        if (!$this->valid) {
            return $this->errorResponse;
        }

        $command = new AddAnswerCommand($user, $data->description);

        try {
            $question = $this->commandBus->handle($command);
        } catch (EntityNotFound $ex) {
            return $this->notFound($ex->getMessage());
        }

        return new Response(json_encode($answer), 200, ['content-type' => 'application/json']);
    }
}

/**
 * @OA\Post(
 *     path="/answer",
 *     tags={"Answers"},
 *     summary="Adds a new anser for an authenticated user",
 *     operationId="addAnswer",
 *     @OA\Response(
 *         response=400,
 *         description="Missing property or errors regarding data sent."
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="The newlly crated answer",
 *         @OA\JsonContent(ref="#/components/schemas/Question")
 *     ),
 *     @OA\RequestBody(
 *     request="AddQuestion",
 *         description="Object containing the very minimal inforamtion needded to create a question",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/AddAnswerCommand")
 *     ),
 *     security={
 *         {"OAuth2.0-Token": {"user.management"}}
 *     }
 * )
 */

