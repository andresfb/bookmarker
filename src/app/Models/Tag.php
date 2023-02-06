<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends \Spatie\Tags\Tag
{
    /**
     * getUserTags Method.
     *
     * @param int $userId
     * @return array
     *
     */
    public static function getUserTags(int $userId): array
    {
        return self::select('name')
            ->where('type', $userId)
            ->orderBy('name')
            ->get()
            ->pluck('name')
            ->toArray();
    }
}
