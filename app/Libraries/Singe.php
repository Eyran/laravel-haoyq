<?php
/**
 * Singe.php
 * 单例模式
 * Author: haoyq
 * Date: 2018/12/9
 */

namespace App\Libraries;


class Singe
{
    /**
     * 私有静态变量，用于存储实例
     * @var
     */
    private static $instance;

    /**
     * 私有构造函数，防止外部实例化
     * Singe constructor.
     */
    private function __construct()
    {

    }

    /**
     * 私有克隆
     */
    private function __clone(){}

    /**
     * 提供外部实例化
     * @return Singe
     */
    public static function getSinge()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}