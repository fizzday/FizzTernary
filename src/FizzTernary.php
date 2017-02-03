<?php
namespace Fizzday\FizzTernary;

/**
 * php实现的完全标准三叉树, 达到33复制的效果, 先来后到, 依次向后排列
 * Class FizzTernary
 * @package Fizzday\FizzTernary
 */
class FizzTernary
{
    /**
     * 根据编号, 获取当前层数是第几层
     * @param $id   编号
     * @return int
     */
    public static function getLayers($id)
    {
        if (!$id) return false;

        $log = log($id) / log(3);
        // 如果能整除, 直接返回
        if (is_int($log) || $log == 0) {
            return $log + 1;
        }

        // 如果不能整除, 则可能为上一层, 也可能为下一层, 我们只需要跟下一层的比较是否在下一层范围内, 即可知道给定的数值所处的层数, 否则即为上一层
        $log_res = ceil($log);
        // 计算中间数, 即刚好是3的指数值
        $int_num = pow(3, $log_res);
        // 计算同一层两边的数量
        $per_num = ($int_num-1)/2;
        // 如果刚好在范围内, 则直接返回
        if ($int_num - $per_num <= $id) {
            return $log_res + 1;
        } else {
            return $log_res;
        }
    }

    /**
     * 跟据编号, 获取所有上级的编号
     * @param $id   编号
     * @param int $layers   限定层数
     * @return array
     */
    public static function getPids($id=0, $layers = 0)
    {
        if ($id < 1) return false;

        // 结果存放容器
        static $ids = array();
        // 当前要执行的层数
        static $current_layers = 0;

        $leave_id = $id % 3;
        if ($leave_id == 0) {
            $id = $id / 3;
            $ids[] = $id;
        } elseif ($leave_id == 1) {
            $id = ($id - 1) / 3;
            $ids[] = $id;
        } elseif ($leave_id == 2) {
            $id = ($id + 1) / 3;
            $ids[] = $id;
        }

        if ($id == 1) return $ids;

        if ($layers > 0) {
            $current_layers++;
            if ($current_layers >= $layers)
                return $ids;
        }

        return self::getPids($id, $layers);
    }
}

//$a = TernaryTree::getPids(17, 3);
//$a = TernaryTree::getLayers(2);
//print_r($a);
