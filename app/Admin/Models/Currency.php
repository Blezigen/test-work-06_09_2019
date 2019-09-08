<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Admin\Models\Currency
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property string $format
 * @property int $nominal
 * @property float $exchange_rate
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    public function getTable()
    {
        return "currencies";
    }

    //
}
