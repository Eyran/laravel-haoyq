<?php
/**
 * Deque.php
 * 双端队列
 * Author: haoyq
 * Date: 2018/12/16
 */

namespace App\Libraries;


class Deque
{
    /**
     * 用于存储队列
     * @var array
     */
    protected $queue;

    public function __construct(array $arr)
    {
        $this->queue = $arr;
    }

    /**
     * 获取队列长度
     * @return int
     */
    public function getLength()
    {
        return count($this->queue);
    }

    /**
     * 队列头部出队
     * @return mixed
     */
    public function removeFirst()
    {
        return array_shift($this->queue);
    }

    /**
     * 获取队列头部
     * @return mixed
     */
    public function getFirst()
    {
        return reset($this->queue);
    }

    /**
     * 队列头部入队
     * @param $value
     * @return $this
     */
    public function setFirst($value)
    {
        return array_unshift($this->queue, $value);
    }

    /**
     * 队列尾部出队
     * @return mixed
     */
    public function removeLast()
    {
        return array_pop($this->queue);
    }

    /**
     * 获取队列尾部
     * @return mixed
     */
    public function getLast()
    {
        return end($this->queue);
    }

    /**
     * 队列尾部入队
     * @param $value
     * @return $this
     */
    public function setLast($value)
    {
        return array_push($this->queue, $value);
    }

    /**
     * 清空队列
     */
    public function clear()
    {
        $this->queue = array();
    }
}