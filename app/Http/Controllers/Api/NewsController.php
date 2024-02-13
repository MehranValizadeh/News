<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $news = new News();
            if($request->has('source')){
                $news = $news->where('source' ,'=', 'App/Services/'.ucfirst($request->source));
            }
            if ($request->has('date')){
                $news = $news->whereYear('created_at' , $request->date);
            }
            $news = $news->get();
            if ($news->count() > 0){
                foreach ($news as $item) {
                    $result [] = [
                        'author' => $item->author,
                        'title' => $item->title,
                        'body' => $item->body,
                    ];
                }
            }else{
                $result = [];
            }
            return response()->json($result);
        }catch (Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function update($id , Request $request)
    {
        $news = News::where('id',$id)->update(['updated_at' => Carbon::now()->toDateTimeString('second')]);;
        return redirect()->back();
    }
}
