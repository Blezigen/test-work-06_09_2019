<?php
/**
 * Created by PhpStorm.
 * User: user_ilyas
 * Date: 06.09.2019
 * Time: 21:40
 */

namespace App\Admin\Extensions;


use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class CurrencyColumn extends AbstractDisplayer
{

    /**
     * Display method.
     *
     * @param string $default
     * @return mixed
     */
    public function display($default="c.u.")
    {
        return <<<EOT
{$this->getValue()} {$default}
EOT;
    }
}