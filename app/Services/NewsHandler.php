<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class NewsHandler extends Controller
{

    public static function insert()
    {
        DB::beginTransaction();
        try {
            $guardian_result = Guardian::transform();
            $newsApi_result = NewsApi::transform();
            $data = array_merge($guardian_result, $newsApi_result);
            News::insert($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }


}
