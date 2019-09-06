<?php

namespace App\Admin\Controllers;

use App\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id', __('Id'));
        $grid->column('article', __('Article'));
        $grid->column('image', __('Image'))->image("",60);
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'))->text(60);
        $grid->column('price', __('Price'))->currency("RUB");
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('article', __('Article'));
        $show->field('image', __('Image'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'))->currency("RUB");
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->textarea('name', __('Name'));
        $form->textarea('article', __('Article'));
        $form->image('image', __('Image'))->uniqueName();
        $form->textarea('description', __('Description'));
        $form->decimal('price', __('Price'));

        return $form;
    }
}
