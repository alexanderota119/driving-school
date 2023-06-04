<?php

namespace App\Http\Resources;

use App\Helpers\Date as DateHelper;
use App\Http\Resources\Api\AddressResource;
use App\Http\Resources\Api\NoteResource;
use App\Http\Resources\Api\PhoneResource;
use Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Model
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int    $id
 * @property int    $rating
 */
class BaseJsonResource extends JsonResource
{
    public $needs = [];

    public function toArray($request): array
    {
        $data = $this->getArray($request);

        $fillable_needs = [
            [
                'name'        => 'address',
                'data_append' => fn () => [
                    'address' => AddressResource::make($this->whenLoaded('address')),
                ],
            ],
            [
                'name'        => 'addresses',
                'data_append' => fn () => [
                    'addresses' => AddressResource::make($this->whenLoaded('addresses')),
                ],
            ],
            [
                'name'        => 'notes',
                'data_append' => fn () => [
                    'notes' => NoteResource::collection($this->whenLoaded('notes')),
                ],
            ],
            [
                'name'        => 'myNotes',
                'data_append' => fn () => [
                    'myNotes' => NoteResource::collection($this->whenLoaded('myNotes')),
                ],
            ],
            [
                'name'        => 'rating',
                'data_append' => fn () => [
                    'myNotes' => $this->when($this->hasAppended('rating'), ['star' => (int) $this->rating]),
                ],
            ],
            [
                'name'        => 'ratings',
                'data_append' => fn () => [
                    'ratings' => RatingResource::collection($this->whenLoaded('ratings')),
                ],
            ],
            [
                'name'        => 'phone',
                'data_append' => fn () => [
                    'phone' => PhoneResource::make($this->whenLoaded('phone')),
                ],
            ],
            [
                'name'        => 'phones',
                'data_append' => fn () => [
                    'phones' => PhoneResource::collection($this->whenLoaded('phones')),
                ],
            ],
        ];

        foreach ($fillable_needs as $fillable_need) {
            if (Arr::get($this->needs, $fillable_need['name']) === true) {
                $data += $fillable_need['data_append']();
            }
        }

        return $data + [
            'id' => $this->id,

            // standard dates
            'created_at' => DateHelper::dateObject($this->created_at),
            'updated_at' => DateHelper::dateObject($this->updated_at),
            'deleted_at' => DateHelper::dateObject($this->deleted_at),

            // Default option value and label text. If the modal specific
            // resource sets it this is ignored.
            'option' => [
                'value' => $this->id,
                'text'  => $this->name,
            ],
        ];
    }

    public function getArray($request)
    {
        return [];
    }

    public function addStandardNeeds()
    {
        $this->needs = [
            'address'   => true,
            'addresses' => true,
            'notes'     => true,
            'myNotes'   => true,
            'rating'    => true,
            'ratings'   => true,
            'phone'     => true,
            'phones'    => true,
        ];
    }
}
