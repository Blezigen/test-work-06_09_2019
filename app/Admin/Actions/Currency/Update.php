<?php

namespace App\Admin\Actions\Currency;

use Encore\Admin\Actions\Action;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class Update extends Action
{
    protected $selector = '.update';

    public function handle(Request $request)
    {
        $user = Admin::user();

        if ($user != null && $user->can("currency-update")) {
            $data = Artisan::call('currency:manage',['-u' => 'true']);
            if ($data === 0){
                return $this->response()->success('Currency update success')->refresh();
            }
        }
        return $this->response()->error('Currency update failed')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-github update"><i class="fa fa-refresh"></i> Update from the CBR</a>
HTML;
    }
}