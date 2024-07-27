<?php

namespace App\Services\Domains;

use App\Http\Resources\AbResource;
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
    public function getAll(): AnonymousResourceCollection
    {
        return $this->abRepository->getAll(self::COUNT_AB);
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
    public function findById(string $id): AbResource
    {
        return $this->abRepository->findById($id);
    }
}
