<?php
namespace GeneticAlgorithms\Interfaces;

/**
 * 定义一个工厂接口，实现这个接口的类提供一个工厂方法
 *
 * @author az13js <1654602334@qq.com>
 */
interface FactoryInterface
{
    /**
     * 工厂方法
     *
     * @return object 返回某些对象，具体返回什么对象由实现决定
     * @author az13js <1654602334@qq.com>
     */
    public function create();
}
