<?php


namespace App\UserInterface\AnswerManagement;


use App\Application\AnswerManagement\DeleteAnswerCommand;
use App\Application\CommandBus;
use App\Application\QuestionManagement\DeleteQuestionCommand;
use App\Domain\AnswerManagement\Answer;
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

/**
 * DeleteQuestionController
 *
 * @package App\UserInterface\AnswerManagement
 */
final class DeleteAnswerController extends AbstractController implements AuthenticatedControllerInterface
{
    use ApiControllerMethods;
    use AuthenticatedControllerMethods;

    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * Creates a DeleteAnswerController
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Handles delete answer command
     *
     * @param Request $request
     * @return Response
     * @Route(path="/answer/{answerId}", methods={"DELETE"})
     */
    public function handle(Request $request, string $answer): Response
    {
        try {
            $questionId = new Answer($answer);


            $command = new DeleteAnswerCommand(
                $answer

            );

            $question = $this->commandBus->handle($command);

        } catch (EntityNotFound $ex) {
            return $this->notFound($ex->getMessage());
        } catch (FailedEntitySpecification $ex) {
            return $this->preconditionFailed($ex->getMessage());
        } catch (InvalidUuidStringException $ex) {
            return $this->badRequest($ex->getMessage());
        }

        return new Response(json_encode($answer), 200, ['content-type' => 'application/json']);

    }


    /**
     * @OA\Delete(
     *     path="/answer/{answerId}",
     *     tags={"Questions"},
     *     summary="Delete the answer with the provided question identifier",
     *     operationId="deleteQuestion",
     *     @OA\Response(
     *         response=400,
     *         description="Missing property or errors regarding data sent."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Answer not found"
     *     ),
     *     @OA\Parameter(
     *         name="answerId",
     *         in="path",
     *         description="ID of answer to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=412,
     *         description="Trying to edit a answer that isn't owned by the authenticated user or it's open."
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The answer with changed values",
     *         @OA\JsonContent(ref="#/components/schemas/Answers")
     *     ),
     *     @OA\RequestBody(
     *     request="DeleteAnswer",
     *         description="Object containing the new inforamtion needded to update the question stored with the privided identifier",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/DeleteAnswerCommand")
     *     ),
     *     security={
     *         {"OAuth2.0-Token": {"user.management"}}
     *     }
     * )
     */
}