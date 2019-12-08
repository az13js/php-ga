<?php
namespace GeneticAlgorithms\DefaultRealization;

use GeneticAlgorithms\Interfaces\FactoryInterface;

/**
 * 个体工厂
 *
 * @author az13js <1654602334@qq.com>
 */
class IndividualFactory implements FactoryInterface
{
    /**
     * 初始化的方式
     *
     * @var string
     */
    private $initType = 'random';

    /**
     * 用来返回个体
     *
     * @return Individual
     */
    public function create(): Individual
    {
        switch ($this->initType) {
            default:
                return $this->randomInit();
        }
    }

    /**
     * 随即地初始化并返回一个个体
     *
     * @return Individual
     */
    private function randomInit(): Individual
    {
        $binraryInfo = [];
        for ($i = 0; $i < Individual::LEN; ++$i) {
            $binraryInfo[] = 0x01 & mt_rand();
        }
        return new Individual($binraryInfo);
    }
}
