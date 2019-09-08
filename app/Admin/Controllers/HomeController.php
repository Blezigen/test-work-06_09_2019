<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public static function functions()
    {
        return view('admin.dashboard.functions');
    }


    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append(HomeController::functions());
                });
            })
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });


                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }
}
