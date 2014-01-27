<?php


class memcache_class
{
    private static $memcache_obj = null;

    public function __construct($memcache_server, $memcache_port) {
        if (is_null(self::$memcache_obj)) {
            self::$memcache_obj = new Memcached();
            if (!self::$memcache_obj->addServer($memcache_server, $memcache_port)) {
                die('memcache error');

            }
        }
    }

    function setCache($key, $value, $ttl = 259200) {
        self::$memcache_obj->set($key, $value, $ttl);
        /*

        $items = self::$memcache_obj->get('items');
        if (!in_array($key, array_values($items))) {
            $items[] = $key;
        }
        self::$memcache_obj->set('items', $items);
        */
    }

    function getCache($key)
    {
        $data = self::$memcache_obj->get($key);
        return $data;
    }

    function delCache($key)
    {
        self::$memcache_obj->delete($key);

        $items = self::$memcache_obj->get('items');
        if (!in_array($key, array_values($items))) {
            unset ($items[array_search($key, $items)]);
        }
        self::$memcache_obj->set('items', $items);
        return true;
    }
}

