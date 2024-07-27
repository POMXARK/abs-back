<?php

namespace App\Http\Resources;

use App\Models\Ab;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property int $id
 */
class AbResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Ab $this */
        return [
            'abId' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'photos' => self::getFormatPhotos($this->photos),
        ];
    }

    private function getFormatPhotos(Collection $photos): array
    {
        $res = [];
        foreach ($photos as $photo) {
            $data = [];
            $data['id'] = $photo['id'];
            $data['link'] = $photo['link'];
            $data['createdAt'] = $photo['created_at'];
            $res[] = $data;
        }

        return $res;
    }
}
