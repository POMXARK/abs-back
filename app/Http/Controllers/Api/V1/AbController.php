<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexAbRequest;
use App\Http\Requests\ShowAbRequest;
use App\Http\Requests\StoreAbRequest;
use App\Http\Requests\UpdateAbRequest;
use App\Models\Ab;
use App\Services\Domains\AbService;
use Exception;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;
use Symfony\Component\HttpFoundation\Response;

/**
 * Контроллер объявлений.
 *
 * @see AbControllerTest
 */
class AbController extends Controller
{
    public function __construct(private readonly AbService $abService)
    {
    }

    /**
     * Получить все объявления постранично.
     */
    #[QueryParam("page", "int", required: false, example: 1)]
    #[QueryParam("sort_by_price", "string", required: false, example: 'desc')]
    #[QueryParam("sort_by_created_at", "string", required: false, example: 'desc')]
    public function index(IndexAbRequest $request)
    {
        return response()->json($this->abService->getAll($request->validated()), Response::HTTP_OK);
    }

    /**
     * Создать объявление.
     *
     * @throws Exception
     */
    #[BodyParam("photos", "string[]")]
    public function store(StoreAbRequest $request)
    {
        return response()->json(['abId' => $this->abService->create($request->validated()), Response::HTTP_CREATED]);
    }

    /**
     * Получить объявление.
     */
    #[QueryParam("fields", "string[]")]
    public function show(Ab $ab, ShowAbRequest $request)
    {
        return response()->json($this->abService->findById($ab->id, $request->validated()), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbRequest $request, Ab $ab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ab $ab)
    {
        //
    }
}
