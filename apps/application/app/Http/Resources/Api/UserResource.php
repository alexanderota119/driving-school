<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin User
 */
class UserResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request): array|JsonSerializable|Arrayable
    {
        $this->addStandardNeeds();

        return [
            'type'        => 'user',
            'avatar'      => route('student.avatar', $this),
            'name'        => $this->name,
            'email'       => $this->email,
            'last_name'   => $this->last_name,
            'first_name'  => $this->first_name,
            'middle_name' => $this->middle_name,
            'is_inactive' => (bool) $this->is_inactive,
        ];
    }
}
