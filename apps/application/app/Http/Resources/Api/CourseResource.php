<?php

namespace App\Http\Resources\Api;

use App\Helpers\Date as DateHelper;
use App\Http\Resources\BaseJsonResource;
use App\Models\Course;
use Illuminate\Http\Request;

/**
 * @mixin Course
 */
class CourseResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function getArray($request): array
    {
        $this->addStandardNeeds();

        return [
            'name'       => $this->name,
            'class_time' => DateHelper::dateObject($this->class_time),
            'duration'   => $this->duration,
        ];
    }
}
