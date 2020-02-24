<?php

namespace fw\libs;

class Cache
{
    public function __construct()
    {

    }

    public function set(string $key, $data, $seconds = 3600): bool
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
            return true;
        }
        return false;
    }

    public function get(string $key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (is_file($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    public function delete($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }

}
