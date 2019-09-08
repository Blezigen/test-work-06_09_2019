<?php

namespace App\Console\Commands;

use App\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageCurrency extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:manage 
                                {--u|update : Update data from the "cbr.ru" } 
                                {--a|activate : Enable currency in system } 
                                {--d|deactivate : Disable currency in system } 
                                {--i|initialize : Initializes all currency in system } 
                                {--c|currency= : Code or comma separated list of codes for currencies}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currencies operations';

    protected $defaultCurrency = "RUB";

    /**
     * All installable currencies.
     *
     * @var array
     */
    protected $currencies;


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $update = $this->option('update');
        $activate = $this->option('activate');
        $deactivate = $this->option('deactivate');
        $initialize = $this->option('initialize');
        $currency = $this->option('currency');

        try {
            if ($initialize) {
                $this->initializeCurrency($currency);
            }

            if ($activate) {
                $this->activateCurrency($currency);
            }

            if ($update) {
                $this->updateCurrency($currency);
            }

            if ($deactivate) {
                $this->deactivateCurrency($currency);
            }
            return 0;
        }
        catch (\Throwable $ex){
            $this->error("Message: ".$ex->getMessage());
            return -1;
        }
    }

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->currencies = include(resource_path("/currencies.php"));
        $this->defaultCurrency = config("currency.default");
        parent::__construct();
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


    private function request($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_MAXCONNECTS, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }


    /**
     * Create or update currency by code
     *
     * @param $symbolCode
     * @param $data
     * @return bool
     * @throws \Exception
     */
    private function createOrUpdateCurrency($symbolCode, $data)
    {
        try {
            $currencyDB = Currency::firstOrNew(
                ["code" => $symbolCode],
                [
                    "name" => $data["name"],
                    "code" => $symbolCode,
                    "symbol" => $data["symbol"],
                    "format" => $data["format"],
                    "active" => false
            ]);

            if ($this->defaultCurrency == $symbolCode){
                $currencyDB["nominal"] = 1;
                $currencyDB["exchange_rate"] = 1;
            }

            $currencyDB->save();
            return true;
        }
        catch (\Throwable $ex){
            throw new \Exception("Create or update currency filed!");
        }
    }

    /**
     * Initialize all currency in system
     * @param $currency
     * @return bool
     * @throws \Exception
     */
    private function initializeCurrency($currency)
    {
        if ($currency && $currency != null){
            $data = $this->getCurrency($currency);
            $this->output->write("Add currency \"{$currency} \" ... ");

            try {
                if (!$this->createOrUpdateCurrency($currency, $data)) {
                    $this->error('FILED');
                } else {
                    $this->output->writeln("<info>SUCCESS</info>");
                    return true;
                }
            }
            catch (\Throwable $ex){
                $this->error('FILED');
                throw $ex;
            }
            return false;
        }
        else {
            foreach ($this->currencies as $currencyIn => $value)
            {
                $data = $this->getCurrency($currencyIn);
                $this->output->write("Add currency \"{$currencyIn} \" ... ");
                try {
                    if (!$this->createOrUpdateCurrency($currencyIn, $data)) {
                        $this->error('FILED');
                    } else {
                        $this->output->writeln("<info>SUCCESS</info>");
                    }
                }
                catch (\Throwable $ex){
                    $this->error('FILED');
                    throw $ex;
                }
            }
        }

        return false;
    }

    /**
     * @param $currency
     * @return bool
     * @throws \Throwable
     */
    private function activateCurrency($currency)
    {
        if ($currency ){
            $this->output->write("Activate currency \"{$currency} \" ... ");

            $currencyDB = Currency::find(["code" => $currency])->first();
            try {
                if ($currencyDB){
                    $currencyDB->active = true;
                    $currencyDB->save();
                    $this->output->writeln("<info>SUCCESS</info>");
                    return true;
                }
                else
                    throw new NotFoundHttpException("Currency not found!");
            }
            catch (\Throwable $ex){
                $this->error('FILED');
                throw $ex;
            }
            return false;
        }
        else {

            try {
                \DB::update("UPDATE currencies SET active = 1;");
                $this->output->writeln("Update status for all currencies ... <info>SUCCESS</info>");
            }
            catch (\Throwable $ex){
                $this->error('FILED');
                throw $ex;
            }
            return true;
        }

        return false;
    }


    private function deactivateCurrency($currency)
    {
        if ($currency){
            $this->output->write("Activate currency \"{$currency} \" ... ");

            $currencyDB = Currency::find(["code" => $currency])->first();
            try {
                if ($currencyDB){
                    $currencyDB->active = false;
                    $currencyDB->save();
                    $this->output->writeln("<info>SUCCESS</info>");
                    return true;
                }
                else
                    throw new NotFoundHttpException("Currency not found!");
            }
            catch (\Throwable $ex){
                $this->error('FILED');
                throw $ex;
            }
            return false;
        }
        else {

            try {
                $query = \DB::update("UPDATE currencies SET active = 0;");
                $this->output->writeln("Update status for all currencies ... <info>SUCCESS</info>");
            }
            catch (\Throwable $ex){
                $this->error('FILED');
                throw $ex;
            }
            return true;
        }

        return false;
    }

    private function updateCurrency($currency)
    {
        $this->comment('Updating exchange rates from the CBR.RU ... ');
        $content = $this->request('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));

        $currenciesXML = new \SimpleXMLElement($content);


        foreach ($currenciesXML as $currencyIn) {
            try {
                if ((string)$currencyIn->CharCode === "XDR") continue;
                $this->output->write("Updating currency \"{$currencyIn->CharCode} \" ... ");
                $curr = $this->currencies[(string)$currencyIn->CharCode];
                $currencyDB = Currency::firstOrNew(["code" => $currencyIn->CharCode],[
                    "name" => $curr["name"],
                    "code" => (string)$currencyIn->CharCode,
                    "symbol" => $curr["symbol"],
                    "format" => $curr["format"],
                    "exchange_rate" => str_replace(",",".", $currencyIn->Value),
                    "active" => 0
                ]);

                if ($currencyIn->CharCode == $this->defaultCurrency) {
                    $currencyDB->nominal = 1;
                } else {
                    $currencyDB->nominal = (integer) $currencyIn->Nominal;
                }

                $currencyDB->save();
                $this->output->writeln("<info>SUCCESS</info>");
            }
            catch (\Throwable $ex){
                $this->error('FILED');
                dd($ex);
                throw $ex;
            }
        }
        return true;

    }


}
