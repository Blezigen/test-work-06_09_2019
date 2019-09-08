<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Currency;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;

class CurrencyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Currencies';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Currency);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('code', __('Code'));
        $grid->column('symbol', __('Symbol'));
        $grid->column('format', __('Format'));
        $grid->column('nominal', __('Nominal'));
        $grid->column('exchange_rate', __('Exchange rate'));
        $grid->column('active', __('Active'));
        $grid->column('created_at', __('Created at'));
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
        $show = new Show(Currency::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('code', __('Code'));
        $show->field('symbol', __('Symbol'));
        $show->field('format', __('Format'));
        $show->field('nominal', __('Nominal'));
        $show->field('exchange_rate', __('Exchange rate'));
        $show->field('active', __('Active'));
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
        $form = new Form(new Currency);

        $form->text('name', __('Name'));
        $form->text('code', __('Code'));
        $form->text('symbol', __('Symbol'));
        $form->text('format', __('Format'));
        $form->text('nominal', __('Nominal'));
        $form->text('exchange_rate', __('Exchange rate'));
        $form->switch('active', __('Active'));

        return $form;
    }

    protected function updateFromTheCbr()
    {
        $user = Admin::user();
        try {
            if ($user != null && $user->can("currency-update")) {
                $data = Artisan::call('currency:manage',['-u' => 'true']);
                return Response::json(["execute" => "success"], 200);
            }
        }
        catch (\Throwable $ex) { }
        return Response::json(["execute" => "filed"], 200);

    }
}
