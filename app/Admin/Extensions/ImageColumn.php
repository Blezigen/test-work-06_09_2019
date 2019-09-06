<?php
/**
 * Created by PhpStorm.
 * User: user_ilyas
 * Date: 06.09.2019
 * Time: 21:27
 */

namespace App\Admin\Extensions;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class ImageColumn extends AbstractDisplayer
{

    /**
     * Display method.
     *
     * @return mixed
     */
    public function display()
    {
        return <<<EOT
<img src='/storage/{$this->getValue()}' alt='{$this->getKey()}'/>
EOT;
    }
}