<?php
namespace GeneticAlgorithms\Abstracts;

/**
 * 个体
 *
 * @author az13js <1654602334@qq.com>
 */
abstract class Individual
{
    /**
     * 用来返回个体的适应度
     *
     * @return float
     */
    public abstract function getFitness(): float;
}
