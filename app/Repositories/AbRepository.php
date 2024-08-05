<?php

namespace App\Repositories;

use App\Http\Resources\AbResource;
use App\Http\Resources\AbResourceCollection;
use App\Http\Resources\AbResources;
use App\Models\Ab;
use App\Models\Photo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Throwable;

class AbRepository implements AbRepositoryInterface
{
    /**
     * Получить всё.
     *
     * @throws QueryException
     */
    public function getAll(int $countUsers, array $fields): LengthAwarePaginator
    {
        $query = Ab::query()->with('photos');
        self::orderByField($query, $fields, 'sort_by_price');
        self::orderByField($query, $fields, 'sort_by_created_at');

        return $query->paginate($countUsers);
    }

    private function orderByField(&$query, array $fields, string $name): void
    {
        if (array_key_exists($name, $fields)) {
                if($name == 'sort_by_price') {
                    $query = $query->orderBy('price', $fields[$name]);
                }
                if($name == 'sort_by_created_at') {
                    $query = $query->orderBy('created_at', $fields[$name]);
                }
        }
    }

    /**
     * Создание из массива.
     *
     * @throws QueryException
     * @throws Throwable
     */
    public function createFromArray(array $data): int
    {
        DB::beginTransaction();

        try {
            $ab = Ab::query()->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);

            foreach ($data['photos'] as $photo) {
                Photo::query()->create(['ab_id' => $ab->id, 'link' => $photo]);
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

       return self::findById($ab->id)->id;
    }

    /**
     * Поиск модели по идентификатору.
     *
     * @throws QueryException
     */
    public function findById(int $id, array $fields = null): Ab
    {
        /** @var Ab $stmt */
        return Ab::query()->with('photos')->find($id);
    }
}
