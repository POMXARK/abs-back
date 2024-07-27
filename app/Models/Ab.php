<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property array $photos
 */
class Ab extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
