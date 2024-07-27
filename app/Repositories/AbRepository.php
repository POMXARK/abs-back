<?php

namespace App\Repositories;

use App\Http\Resources\AbResource;
use App\Models\Ab;
use App\Models\Photo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Throwable;

class AbRepository implements AbRepositoryInterface
{
    /**
     * Получить всё.
     *
     * @throws QueryException
     */
    public function getAll(int $countUsers): AnonymousResourceCollection
    {
        return AbResource::collection(
                Ab::query()->with('photos')->paginate($countUsers)
        );
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
    public function findById(string $id): AbResource
    {
        /** @var Ab $stmt */
        return AbResource::make(Ab::query()->with('photos')->find($id));
    }
}
