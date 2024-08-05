<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Photo>
 */
final class PhotoFactory extends Factory
{
    const FAKE_PHOTO_LINKS = [
'https://static.vecteezy.com/system/resources/previews/006/059/989/non_2x/crossed-camera-icon-avoid-taking-photos-image-is-not-available-illustration-free-vector.jpg',
'https://static.vecteezy.com/system/resources/previews/005/720/408/large_2x/crossed-image-icon-picture-not-available-delete-picture-symbol-free-vector.jpg',
'https://static.vecteezy.com/system/resources/previews/004/141/669/large_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg'
];

    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Photo::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'ab_id' => \App\Models\Ab::factory(),
            'link' => collect(self::FAKE_PHOTO_LINKS)->random(),
        ];
    }
}
