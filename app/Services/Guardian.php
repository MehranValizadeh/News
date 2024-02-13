<?php

namespace App\Services;
use App\Abstracts\NewsHandler;
use App\interfaces\NewsInterface;
use Carbon\Carbon;

class Guardian implements NewsInterface
{
    const apiKey = '2cbe25da-bbed-4648-9386-1820ced1ba45';

    public static function sendRequest()
    {
        $api = new \Guardian\GuardianAPI(self::apiKey);
        $response = $api->sections()
            ->setQuery("business")
            ->fetch();
        return $response;
    }

    public static function transform(){
        $request = self::sendRequest();
        $now = Carbon::now()->toDateTimeString('second');
        foreach ($request->response->results as $item) {
            $response [] = [
                'author' => $item->id,
                'title' => $item->webTitle,
                'body' => $item->webUrl,
                'source' => str_replace('\\' , '/' , self::class),
                'updated_at' => $now,
                'created_at' => $now
            ];
        }
        return $response;
    }
}
