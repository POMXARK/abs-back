<?php

namespace App\Repositories;

use App\Models\Ab;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AbRepositoryInterface
{
    /**
     * Получить всё.
     *
     * @throws QueryException
     */
    public function getAll(int $countUsers, array $fields): LengthAwarePaginator;

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
    public function findById(int $id, array $fields): Ab;
}
