<?php


namespace App\UserInterface\QuestionManagement;


use App\Application\CommandBus;
use App\Application\QuestionManagement\DeleteQuestionCommand;
use App\Domain\Exception\EntityNotFound;
use App\Domain\Exception\FailedEntitySpecification;
use App\Domain\QuestionManagement\Question\QuestionId;

use App\UserInterface\ApiControllerMethods;
use App\UserInterface\UserManagement\OAuth2\AuthenticatedControllerInterface;
use App\UserInterface\UserManagement\OAuth2\AuthenticatedControllerMethods;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * EditQuestionController
 *
 * @package App\UserInterface\QuestionManagement
 */


class DeleteQuestionController  extends AbstractController implements AuthenticatedControllerInterface
{
    use ApiControllerMethods;
    use AuthenticatedControllerMethods;

    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * Creates a EditQuestionController
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Handles delete question command
     *
     * @param Request $request
     * @return Response
     * @Route(path="/question/{questionId}", methods={"DELETE"})
     */
    public function handle(Request $request, string $questionId): Response
    {
        try {
            $questionId = new QuestionId($questionId);


            $command = new DeleteQuestionCommand(
                $questionId

            );

            $question = $this->commandBus->handle($command);

        } catch (EntityNotFound $ex) {
            return $this->notFound($ex->getMessage());
        } catch (FailedEntitySpecification $ex) {
            return $this->preconditionFailed($ex->getMessage());
        } catch (InvalidUuidStringException $ex) {
            return $this->badRequest($ex->getMessage());
        }

        return new Response(json_encode($question), 200, ['content-type' => 'application/json']);

    }


/**
 * @OA\Put(
 *     path="/question/{questionId}",
 *     tags={"Questions"},
 *     summary="Delete the question with the provided question identifier",
 *     operationId="editQuestion",
 *     @OA\Response(
 *         response=400,
 *         description="Missing property or errors regarding data sent."
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Quesiton not found"
 *     ),
 *     @OA\Parameter(
 *         name="questionId",
 *         in="path",
 *         description="ID of question to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=412,
 *         description="Trying to edit a question that isn't owned by the authenticated user or it's open."
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="The question with changed values",
 *         @OA\JsonContent(ref="#/components/schemas/Question")
 *     ),
 *     @OA\RequestBody(
 *     request="DeleteQuestion",
 *         description="Object containing the new inforamtion needded to update the question stored with the privided identifier",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/DeleteQuestionCommand")
 *     ),
 *     security={
 *         {"OAuth2.0-Token": {"user.management"}}
 *     }
 * )
 */
}