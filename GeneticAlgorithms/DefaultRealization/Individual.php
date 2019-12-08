<?php
namespace GeneticAlgorithms\DefaultRealization;

use GeneticAlgorithms\Abstracts\Individual as AbstractIndividual;

/**
 * 个体
 *
 * @author az13js <1654602334@qq.com>
 */
class Individual extends AbstractIndividual
{
    /**
     * 二进制串
     * @var array
     */
    public $binraryInfo = [];

    /**
     * 染色体的长度
     *
     * @var int
     */
    const LEN = 64;

    /**
     * 二进制串
     *
     * @param array $binraryInfo
     */
    public function __construct(array $binraryInfo)
    {
        $this->binraryInfo = $binraryInfo;
    }

    /**
     * 用来返回个体的适应度
     *
     * 目前版本使用 DeJong F2 函数
     *
     * @return float
     */
    public function getFitness(): float
    {
        $half = self::LEN / 2;
        $firstArray = array_slice($this->binraryInfo, 0, $half);
        $secondArray = array_slice($this->binraryInfo, $half);
        // X -> [-2.048, 2.048] -> [0, 4.096]
        $max = pow(2, $half);
        $x1 = intval(implode('', $firstArray), 2) / $max * 4.096 - 2.048;
        $x2 = intval(implode('', $secondArray), 2) / $max * 4.096 - 2.048;
        return 1 / (0.001 + 100 * pow($x1 * $x1 - $x2, 2) + pow(1 - $x1, 2));
    }
}
