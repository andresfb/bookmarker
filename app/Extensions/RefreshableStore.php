<?php

namespace App\Extensions;

use App\Traits\CacheRefreshable;
use Illuminate\Cache\RedisStore;

class RefreshableStore extends RedisStore
{
    use CacheRefreshable;

    /**
     * @param $app
     */
    public function __construct(protected $app)
    {
        $redis = $this->app['redis'];

        $prefix = $this->app['config']['cache.prefix'] ?? 'default';

        $connection = $this->app['config']['cache.stores.refreshable.connection'];

        parent::__construct($redis, $prefix, $connection);
    }

    /**
     * @inheritDoc
     */
    public function get($key): mixed
    {
        if ($this->refreshCache()) {
            return null;
        }

        return parent::get($key);
    }

    /**
     * @inheritDoc
     */
    public function many(array $keys): array
    {
        if ($this->refreshCache()) {
            return [];
        }

        return parent::many($keys);
    }

    /**
     * @inheritDoc
     */
    public function add($key, $value, $seconds): bool
    {
        if ($this->refreshCache()) {
            return parent::add($key, $value, 5);
        }

        return parent::add($key, $value, $seconds);
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value, $seconds): bool
    {
        if ($this->refreshCache()) {
            return parent::put($key, $value, 5);
        }

        return parent::put($key, $value, $seconds);
    }

    /**
     * @inheritDoc
     */
    public function putMany(array $values, $seconds): bool
    {
        if ($this->refreshCache()) {
            return parent::putMany($values, 5);
        }

        return parent::putMany($values, $seconds);
    }

    /**
     * @inheritDoc
     */
    public function forever($key, $value): bool
    {
        if ($this->refreshCache()) {
            return parent::put($key, $value, 5);
        }

        return parent::forever($key, $value);
    }
}
