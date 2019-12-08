<?php
namespace GeneticAlgorithms\Abstracts;

/**
 * 遗传算法主流程
 *
 * 遗传算法的主要步骤是：
 * 1. 初始化种群
 * 2. 设置当前代数为第0代
 * 3. 判断当前代数是否达到终止条件，是则执行第11步。
 * 4. 判断当前代数适应度最大的个体的适应度是不是大于或等于需要的最小适应度，
 *        如果是，那么执行11步
 *        如果不是，那么继续
 * 5. 淘汰种群中的一些适应度低的个体
 * 6. 选择种群中的一些高适应度个体作为父母辈
 * 7. 高适应度的个体进行杂交，生成新的个体
 * 8. 新的个体发生变异
 * 9. 代数加1
 * 10. 执行第3步。
 * 11. 记录当前种群中适应度最大的个体。
 *
 * @author az13js <1654602334@qq.com>
 */
abstract class Algorithm
{
    /**
     * 停止迭代的代数，初始化后的代数算为0
     *
     * @var int
     */
    protected $stopGeneration;

    /**
     * 代数，初始化后的代数算为0
     *
     * @var int
     */
    protected $offsetGeneration = 0;

    /**
     * 当前种群的最大的适应度。
     *
     * @var float
     */
    protected $maxFitness;

    /**
     * 种群中出现个体适应度大于等于此值时停止计算
     *
     * @var float
     */
    protected $stopFitness;

    /**
     * 遗传算法的运行
     *
     * @return void
     */
    public final function run()
    {
        $this->initializationPopulation();
        $this->computingMaxFitness();
        for ($generation = 0; $generation < $this->stopGeneration; ++$generation) {
            if ($this->maxFitness >= $this->stopFitness) {
                break;
            }
            $this->offsetGeneration++;
            $this->eliminated();
            $this->select();
            $this->crossover();
            $this->variation();
            $this->computingMaxFitness();
        }
        $this->saveMaxFitnessIndividual();
    }

    /**
     * 初始化种群方法
     *
     * @return void
     */
    protected abstract function initializationPopulation();

    /**
     * 算出当前种群中最大适应度的方法。
     *
     * @return void
     */
    protected abstract function computingMaxFitness();

    /**
     * 淘汰适应度低的个体的方法。
     *
     * @return void
     */
    protected abstract function eliminated();

    /**
     * 选中适应度高的个体的方法。
     *
     * @return void
     */
    protected abstract function select();

    /**
     * 对适应度高的个体进行杂交的方法。
     *
     * @return void
     */
    protected abstract function crossover();

    /**
     * 对杂交后个体进行变异的方法。
     *
     * @return void
     */
    protected abstract function variation();

    /**
     * 种群达到停止条件后保存适应度高的个体的方法。
     *
     * @return void
     */
    protected abstract function saveMaxFitnessIndividual();
}
