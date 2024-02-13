<?php

namespace App\Services;


use App\Abstracts\NewsHandler;
use App\interfaces\NewsInterface;
use App\Models\News;
use Carbon\Carbon;

class NewsApi implements NewsInterface
{
    const apikey = '8b859fbbbdfe4e11a3469895082299e3';
    const url = 'https://newsapi.org/v2/top-headlines';

    public static function sendRequest()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::url.'?country=us&apiKey='.self::apikey,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_USERAGENT => "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)"
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function transform()
    {
        $request = json_decode(self::sendRequest());
        $now = Carbon::now()->toDateTimeString('second');
        foreach ($request->articles as $item) {
            $response [] = [
                'author' => $item->author,
                'title' => $item->title,
                'body' => $item->content,
                'source' => str_replace('\\' , '/' , self::class),
                'updated_at' => $now,
                'created_at' => $now
            ];
        }
        return $response;
    }

}
