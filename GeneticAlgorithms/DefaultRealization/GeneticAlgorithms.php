<?php
namespace GeneticAlgorithms\DefaultRealization;

use GeneticAlgorithms\Abstracts\Algorithm;

/**
 * 遗传算法的实现
 *
 * 这个类是抽象类 GeneticAlgorithms\Abstracts\Algorithm 的实现。
 *
 * @see GeneticAlgorithms\Abstracts\Algorithm
 * @author az13js <1654602334@qq.com>
 */
class GeneticAlgorithms extends Algorithm
{
    /**
     * 最好的个体
     *
     * @var Individual
     */    
    protected $bestIndividual;

    /**
     * 停止迭代的代数，初始化后的代数算为0
     *
     * @var int
     */
    protected $stopGeneration = 1000;

    /**
     * 当前种群的最大的适应度。
     *
     * @var float
     */
    protected $maxFitness = 0;

    /**
     * 种群中出现个体适应度大于等于此值时停止计算
     *
     * @var float
     */
    protected $stopFitness = 1000;

    /**
     * 种群
     *
     * @var Individual[]
     */
    protected $population = [];

    /**
     * 个体的适应度
     *
     * @var float[]
     */
    protected $fitness = [];

    /**
     * 选择中的
     *
     * @var Individual[]
     */
    protected $haveSelect = [];

    /**
     * 种群大小
     *
     * @var int
     */
    const POPULATION_SIZE = 100;

    /**
     * 初始化种群方法
     *
     * @return void
     */
    protected function initializationPopulation()
    {
        $factory = new IndividualFactory();
        $this->population = [];
        for ($i = 0; $i < self::POPULATION_SIZE; ++$i) {
            $this->population[] = $factory->create();
        }
    }

    /**
     * 算出当前种群中最大适应度的方法。
     *
     * @return void
     */
    protected function computingMaxFitness()
    {
        $this->fitness = [];
        $fitnessSum = $this->maxFitness;
        for ($i = 0; $i < self::POPULATION_SIZE; ++$i) {
            $this->fitness[$i] = $this->population[$i]->getFitness();
            $fitnessSum += $this->fitness[$i];
            if ($this->fitness[$i] > $this->maxFitness) {
                $this->maxFitness = $this->fitness[$i];
                $this->bestIndividual = $this->population[$i];
            }
        }
        $avg = $fitnessSum / (self::POPULATION_SIZE + 1);
        echo "{$this->offsetGeneration},{$this->maxFitness},$avg" . PHP_EOL;
    }

    /**
     * 淘汰适应度低的个体的方法。
     *
     * 我们默认淘汰全部个体
     *
     * @return void
     */
    protected function eliminated()
    {
    }

    /**
     * 选中适应度高的个体的方法。
     *
     * @return void
     */
    protected function select()
    {
        $this->haveSelect = [];
        $fitnessList = array_merge($this->fitness, [$this->maxFitness]);
        $individualList = array_merge($this->population, [$this->bestIndividual]);
        for ($i = 0; $i < self::POPULATION_SIZE; ++$i) {
            $index = $this->roulette($fitnessList);
            $this->haveSelect[] = $individualList[$index];
        }
    }

    /**
     * 对适应度高的个体进行杂交的方法。
     *
     * @return void
     */
    protected function crossover()
    {
        for ($i = 0; $i < self::POPULATION_SIZE; $i = $i + 2) {
            $cut = mt_rand(1, Individual::LEN - 1);
            $newGeneA = [];
            $newGeneB = [];
            for ($j = 0; $j < $cut; ++$j) {
                $newGeneA[] = $this->haveSelect[$i]->binraryInfo[$j];
                $newGeneB[] = $this->haveSelect[$i + 1]->binraryInfo[$j];
            }
            for ($j = $cut; $j < Individual::LEN; ++$j) {
                $newGeneA[] = $this->haveSelect[$i + 1]->binraryInfo[$j];
                $newGeneB[] = $this->haveSelect[$i]->binraryInfo[$j];
            }
            $this->population[$i] = new Individual($newGeneA);
            $this->population[$i + 1] = new Individual($newGeneB);
        }
    }

    /**
     * 对杂交后个体进行变异的方法。
     *
     * @return void
     */
    protected function variation()
    {
        //$rate = 0.001;
        //if ($this->offsetGeneration >= 1000) { // 当迭代到 1000 代后突变概率改为0.1
        //    $rate = 0.1;
        //}
        //if ($this->offsetGeneration >= 2000) { // 当迭代到 2000 代后突变概率改为0.3
        //    $rate = 0.3;
        //}
        $rate = 0.1;
        for ($i = 0; $i < self::POPULATION_SIZE; ++$i) {
            for ($bit = 0; $bit < Individual::LEN; ++$bit) {
                if (mt_rand() / mt_getrandmax() <= $rate) {
                    $this->population[$i]->binraryInfo[$bit] = 1 - $this->population[$i]->binraryInfo[$bit];
                }
            }
        }
    }

    /**
     * 种群达到停止条件后保存适应度高的个体的方法。
     *
     * @return void
     */
    protected function saveMaxFitnessIndividual()
    {
        //echo $this->maxFitness . PHP_EOL;
    }

    /**
     * 轮盘赌算法
     *
     * @param array $indexWeight
     * @return int
     */
    private function roulette(array $indexWeight)
    {
        $sum = array_sum($indexWeight);
        $selectValue = mt_rand() / mt_getrandmax() * $sum;
        $left = 0;
        foreach ($indexWeight as $key => $value) {
            $right = $left + $value;
            if ($selectValue >= $left && $selectValue < $right) {
                return $key;
            }
            $left = $right;
        }
        return $key;
    }
}
