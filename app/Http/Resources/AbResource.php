<?php
declare(strict_types = 1);

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
    public function __construct($resource, private $fields = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Ab $this */
        $data = [
            'abId' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'photoLink' => $this->photos()->first(),
        ];

        self::optionalFields($data);

        return $data;
    }

    private function optionalFields(array &$data): void
    {
        if ($this->fields) {
            if (in_array('description', $this->fields['fields'])) {
                /** @var Ab $this */
                $data['fields']['description']  = $this->description;
            }

            if (in_array('photos', $this->fields['fields'])) {
                $data['fields']['photos']  = self::getFormatPhotos($this->photos);
            }
        }
    }

    private function getFormatPhotos(Collection $photos): array
    {
        $res = [];
        foreach ($photos as $photo) {
            $data = [];
            $data['photoId'] = $photo['id'];
            $data['photoLink'] = $photo['link'];
            $data['createdAt'] = $photo['created_at'];
            $res[] = $data;
        }

        return $res;
    }
}
