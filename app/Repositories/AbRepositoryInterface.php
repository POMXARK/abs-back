<?php

namespace App\Repositories;

use App\Http\Resources\AbResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface AbRepositoryInterface
{
    /**
     * Получить всё.
     *
     * @throws QueryException
     */
    public function getAll(int $countUsers): AnonymousResourceCollection;

    /**
     * Создание из массива.
     *
     * @throws QueryException
     */
    public function createFromArray(array $data): int;

    /**
     * Поиск модели по идентификатору.
     *
     * @throws QueryException
     */
    public function findById(string $id): AbResource;
}
