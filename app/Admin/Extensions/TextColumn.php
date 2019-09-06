<?php
/**
 * Created by PhpStorm.
 * User: user_ilyas
 * Date: 06.09.2019
 * Time: 22:28
 */

namespace App\Admin\Extensions;


use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class TextColumn extends AbstractDisplayer
{

    /**
     * Display method.
     *
     * @param null $limit
     * @return mixed
     */
    public function display($limit = null)
    {

        return $limit !== null ? mb_strimwidth($this->getValue(), 0, $limit, "..."): $this->getValue();
    }
}