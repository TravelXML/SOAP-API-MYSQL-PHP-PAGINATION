<?php

namespace MyApp;

class RateLimiter {
    private $redis;
    private $maxRequests;
    private $windowSeconds;

    public function __construct($host, $maxRequests, $windowSeconds) {
        $this->redis = new \Redis();
        $this->redis->connect($host);

        $this->maxRequests = $maxRequests;
        $this->windowSeconds = $windowSeconds;
    }

    public function isRateLimited($key) {
        $redisKey = "ratelimit:{$key}";
        $current = $this->redis->incr($redisKey);

        if ($current == 1) {
            $this->redis->expire($redisKey, $this->windowSeconds);
        }

        return $current > $this->maxRequests;
    }
}
