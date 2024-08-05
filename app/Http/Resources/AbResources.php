<?php
declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Ab;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property int $id
 */
class AbResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $firstPhoto = $this->photos()->first();

        $photoLink = $firstPhoto ? $firstPhoto['link'] : null;

        /** @var Ab $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'photoLink' => $photoLink,
        ];
    }
}
