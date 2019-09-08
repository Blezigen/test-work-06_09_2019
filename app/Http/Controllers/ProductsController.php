<?php

namespace App\Http\Controllers;

use App\Admin\Controllers\CurrencyController;
use App\Currency;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{

    public function index () {
        $data = [
            "products" => []
        ];

        $data["currencies"] = Currency::all()->toArray();
        $data["products"] = Product::all();


        return view('products', $data);
    }

    /**
     * Get currency data.
     *
     * @param string $currency
     *
     * @return array
     */
    protected function getCurrency($currency)
    {
        return Arr::get($this->currencies, $currency);
    }

    public function update(Request $request)
    {
        $currencies = [];
        $currenciesTemp = ["RUB"];
        $data = [
          "products" => [],
        ];
        $cur = $request->get("cur");
        if ($cur != null){
            $currenciesTemp = explode(",", $cur);
        }

        foreach ($currenciesTemp as $currency){
            $currencyData = Currency::where([ "code"=> $currency ])->firstOrFail();
            if ($currencyData){
                $currencies[$currency] = $currencyData;
            }
        }

        $query = Product::all();

        if ($query->count() > 0){
            $data["products"] = Product::all()->mapToGroups(function ($item, $key) use ($currencies) {
                $price = $item["price"];
                $prices = [];
                foreach ($currencies as $currency => $currencyData){
                    $exRate = floatval(str_replace(",",",",$currencyData["exchange_rate"]));
//                    $newPrice = $exRate == 0 ? 0 : $price/$exRate;

//                    dd(round($newPrice,2));
                    $prices[$currency] = [
                        "name" => $currencies[$currency]["name"],
                        "symbol" => $currencies[$currency]["symbol"],
                    ];

                    $currencyDefaultData = Currency::where(["code" => config("currency.default")])->firstOrFail();
                    $currencyNeighbor = Currency::where(["code" => $currency])->firstOrFail();

                    if ($currencyNeighbor->nominal !== 0) {
                        $coef = $currencyNeighbor->exchange_rate * $currencyDefaultData->nominal / $currencyNeighbor->nominal;
                        $value = $price / $coef;
                        $prices[$currency]["value"] = round($value, 2);
                    }
                    else{
                        $prices[$currency]["value"] = 0;
                    }
                }

                $item["prices"] = [];
                $item["prices"] = $prices;
                $item["description"] = mb_strimwidth($item["description"], 0, 220, "...");

                return [$item];
            })->toArray()[0];
        }

        return Response::json($data,200);
    }
}
