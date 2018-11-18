<?php

namespace Befree\Helpers;


use ArrayIterator;

class Collection implements \IteratorAggregate, \ArrayAccess
{
    /**
     * @var array
     */
    private $items;


    /**
     * Collection constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }


    /**
     * return a basic array
     * @return array
     */
    public function asArray(): array
    {
        return $this->items;
    }


    /**
     * return a json
     * @return string
     */
    public function asJson(): string
    {
        return json_encode($this->items);
    }


    /**
     * return a string list
     * @param string $glue
     * @param null $rule
     * @return string
     */
    public function asList(string $glue = ', ', $rule = null): string
    {
        $list = [];
        foreach ($this->items as $item) {
            if (is_object($item)) {
                if (is_null($rule)) {
                    $list[] = $item->id;
                } else {
                    $list[] = $item->$rule;
                }
            } else {
                $list[] = $item[0];
            }
        }
        return implode($glue, $list);
    }


    /**
     * retrieve a key in collection
     * @param mixed $key recupere la clef d'un tableau.
     * @return $value
     **/
    public function get($key)
    {
        $index = explode(".", $key);
        return $this->getValue($index, $this->items);
    }


    /**
     * retrieve the value of a key
     * @param array $indexes
     * @param $value
     * @return null
     */
    private function getValue(array $indexes, $value)
    {
        $key = array_shift($indexes);
        if (empty($indexes)) {
            if (!array_key_exists($key, $value)) {
                return null;
            }
            return $value[$key];
        } else {
            return $this->getValue($indexes, $value[$key]);
        }
    }


    /**
     * set a data in collection
     * @param mixed $key la clef a definir.
     * @param $value
     * @return void
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }


    /**
     * whether the collection has a key
     *
     * @param mixed $key clef a verifier
     * @return bool
     **/
    public function has($key)
    {
        return array_key_exists($key, $this->items);
    }


    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }


    /**
     * @param mixed $offset
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }


    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }


    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if ($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }


    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}