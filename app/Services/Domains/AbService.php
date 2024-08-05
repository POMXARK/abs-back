<?php
declare(strict_types = 1);

namespace App\Services\Domains;

use App\Http\Resources\AbResource;
use App\Http\Resources\AbResourceCollection;
use App\Repositories\AbRepositoryInterface;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @see AbServiceTest
 */
readonly class AbService
{
    const COUNT_AB = 10;

    public function __construct(private AbRepositoryInterface $abRepository)
    {
    }

    /**
     * Получить всё.
     *
     * @throws QueryException
     */
    public function getAll(array $fields): AbResourceCollection
    {
        return AbResourceCollection::make($this->abRepository->getAll(self::COUNT_AB, $fields));
    }

    /**
     * Создание.
     *
     * @throws Exception
     */
    public function create(array $data): int
    {
        return $this->abRepository->createFromArray($data);
    }

    /**
     * Получить данные.
     */
    public function findById(int $id, array $fields): AbResource
    {
        return AbResource::make($this->abRepository->findById($id), $fields);
    }
}
