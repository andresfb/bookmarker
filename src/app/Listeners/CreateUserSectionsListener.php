<?php

namespace App\Listeners;

use App\Models\Section;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class CreateUserSectionsListener implements ShouldQueue
{
    public function handle(Registered $event): void
    {
        $index = 1;
        [$default, $list] = Section::getStandardList();

        foreach ($list as $item) {
            $slug = Str::slug($item);

            Section::updateOrCreate([
                'user_id' => $event->user->id,
                'slug' => $slug,
            ], [
                'title' => $item,
                'is_default' => $item === $default,
                'order_by' => $index,
            ]);

            $index++;
        }
    }
}
