<?php

namespace App\Traits;

trait Domainable
{
    public function getDomain(string $url): string
    {
        if (empty($url)) {
            return '';
        }

        $pieces = parse_url($url);
        $domain = $pieces['host'] ?? $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }

        return '';
    }
}
