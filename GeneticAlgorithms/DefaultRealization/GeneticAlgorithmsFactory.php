<?php
namespace GeneticAlgorithms\DefaultRealization;

use GeneticAlgorithms\Interfaces\FactoryInterface;

/**
 * 遗传算法工厂
 *
 * 此类实现了GeneticAlgorithms\Interfaces\FactoryInterface接口，对外提供遗传算法对象。
 *
 * @author az13js <1654602334@qq.com>
 */
class GeneticAlgorithmsFactory implements FactoryInterface
{
    /**
     * 工厂方法
     *
     * @return GeneticAlgorithms 返回遗传算法对象
     * @author az13js <1654602334@qq.com>
     */
    public function create(): GeneticAlgorithms
    {
        return new GeneticAlgorithms();
    }
}
