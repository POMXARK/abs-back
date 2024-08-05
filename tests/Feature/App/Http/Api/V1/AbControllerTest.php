<?php

namespace Tests\Feature\App\Http\Api\V1;

use App\Http\Resources\AbResource;
use App\Http\Resources\AbResourceCollection;
use App\Http\Resources\AbResources;
use App\Models\Ab;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

/**
 * Тесты контроллера для работы c пользователями.
 *
 * @see AbController
 */
#[Group('AbController')]
final class AbControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ошибка, если запрос выполняется неавторизованным пользователем.
     */
    public function testAuthError(): void
    {
//        $this->withoutExceptionHandling();
//
//        $this->expectException(AuthenticationException::class);
//
////        $this->get(route('api.v1.abs.index'));
//        $this->post(route('api.v1.abs.store'));
//        $this->get(route('api.v1.abs,show'));
    }

    /**
     * Успешное получения списка.
     */
    public function testIndexSuccess(): void
    {
        $abId = rand(0, 99999);
        Ab::factory()->create(['id' => $abId]);
        Ab::factory()->create();
        Photo::factory(3)->create(['ab_id' => $abId]);
//        Sanctum::actingAs(User::factory()->create());

        $response = $this->get(route('api.v1.abs.index'), headers: ['Accept' => 'application/json']);
        $models = $response->getOriginalContent();

        $this->assertNotEmpty($models);
        $this->assertSame(AbResourceCollection::class, get_class($models));
        foreach ($models as $model) {
            $this->assertSame(AbResource::class, get_class($model));
        }
        $response->assertOk();
    }

    /**
     * Успешное создание.
     */
    public function testCreateSuccess(): void
    {
        $params = [
            'name' => fake()->name,
            'description' => fake()->text(),
            'photos' => [fake()->url, fake()->url, fake()->url],
            'price' => fake()->randomFloat(2, 0, 999999),
            ];
        Sanctum::actingAs(User::factory()->create());

        $response = $this->post(route('api.v1.abs.store', $params), headers: ['Accept' => 'application/json']);

        $response->assertJsonStructure(['abId']);
        $response->assertOk();
    }


    /**
     * Ошибки валидации при создании.
     */
    public function testCreateInvalidError(): void
    {
        $params = [
            'name' => fake()->text(1000),
            'description' => fake()->text(3000),
            'photos' => [fake()->url, fake()->url, fake()->url, fake()->url]
        ];
        Sanctum::actingAs(User::factory()->create());

        $response = $this->post(route('api.v1.abs.store', $params), headers: ['Accept' => 'application/json']);

        $response->assertInvalid(['name', 'description', 'photos']);
    }

    /**
     * Успешное получение.
     */
    public function testGetSuccess(): void
    {
        $abId = rand(0, 99999);
        Ab::factory()->create(['id' => $abId]);
        Photo::factory(3)->create(['ab_id' => $abId]);
        $params = ['ab' => $abId, 'fields' => ['description', 'photos']];
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get(route('api.v1.abs.show', $params), headers: ['Accept' => 'application/json']);
        $models = $response->getOriginalContent();

        $this->assertSame(AbResource::class, get_class($models));
        $response->assertOk();
    }
}
