<?php

namespace App\Enums;

class MarkerCachekeys
{
    public static array $baseKeys = [
        'ACTIVE'    => "active:list:user_id:%s",
        'SECTIONED' => "sectioned:list:user_id:%s:section_id:%s",
    ];

    /**
     * active Method.
     *
     * @param int $userid
     * @return string
     */
    public static function active(int $userid): string
    {
        return md5(sprintf(self::$baseKeys['ACTIVE'], $userid));
    }

    /**
     * sectioned Method.
     *
     * @param int $userid
     * @param int $sectionId
     * @return string
     */
    public static function sectioned(int $userid, int $sectionId): string
    {
        return md5(sprintf(self::$baseKeys['SECTIONED'], $userid, $sectionId));
    }
}
