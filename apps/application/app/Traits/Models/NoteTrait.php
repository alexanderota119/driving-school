<?php

namespace App\Traits\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait NoteTrait
{
    public function addNote($text, $member = null): Note
    {
        $member = $member ?? auth()->user();

        $data = [
            'text'          => $text,
            'userable_type' => optional($member)->getMorphClass(),
            'userable_id'   => optional($member)->id,
        ];

        return $this->notes()->create($data);
    }

    public function notes(): MorphMany|Note
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function myNotes(): MorphMany|Note
    {
        return $this->morphMany(Note::class, 'userable');
    }

    public function note(): MorphOne|Note
    {
        return $this->morphOne(Note::class, 'noteable')->orderBy('updated_at', 'desc');
    }
}
