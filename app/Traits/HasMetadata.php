<?php

namespace App\Traits;

trait HasMetadata
{
    /*
    |--------------------------------------------------------------------------
    | @todo document class use...
    |--------------------------------------------------------------------------
    |
     */

    public array $metadata = [];

    public function getMeta(string $key): mixed
    {
        $value = null;
        $temp = $this->attributes['metadata'] ?? null;

        if (null != $temp) {
            $temp = json_decode($temp, true);
            $value = $temp[$key] ?? null;
        }

        return $value;
    }

    public function getMetaKeys(string $namespace = ''): array
    {
        $finalKeys = [];

        $temp = $this->attributes['metadata'] ?? null;

        if (null != $temp) {
            $temp = json_decode($temp, true);
            $keys = array_keys($temp);

            foreach ($keys as $key) {
                if ('*' == $namespace) {
                    $finalKeys[] = $key;

                    continue;
                }
                if ('' != $namespace) {
                    if (false === strpos($key, $namespace)) {
                        continue;
                    }
                    $key = str_replace($namespace . '.', '', $key);
                    list($part) = explode('.', $key);
                    $finalKeys[] = $part;
                } else {
                    if (false !== strpos($key, '.')) {
                        continue;
                    }
                    $finalKeys[] = $key;
                }
            }
        }

        return $finalKeys;
    }

    /**
     * @param mixed $value
     */
    public function setMeta(string $key, mixed $value): void
    {
        $temp = $this->attributes['metadata'] ?? [];

        if (!is_array($temp)) {
            $temp = json_decode($temp, true);
        }

        $temp[$key] = $value;

        $this->attributes['metadata'] = json_encode($temp);
    }

    /**
     * @param string $namespace
     */
    public function getAllMeta($namespace = ''): array
    {
        $info = [];

        $keys = $this->getMetaKeys($namespace);

        foreach ($keys as $key) {
            $info[$key] = $this->getMeta($key);
        }

        return $info;
    }

    public function removeMeta(string $key): void
    {
        if (array_key_exists($key, $this->metadata)) {
            unset($this->attributes['metadata'][$key]);
        }
    }
}
