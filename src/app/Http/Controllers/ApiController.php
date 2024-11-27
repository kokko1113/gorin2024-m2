<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Log;
use App\Models\Spot;
use Exception;
use Illuminate\Http\Request;

class ApiController
{
    public function getEvent(Request $request)
    {
        try {
            if (!isset($request->id)) {
                // throw==例外を投げる(catchに飛ぶ)
                throw new Exception("IDが指定されていません");
            }
            $id = $request->id;
            $event = Event::query()->find($id);
            if(!isset($event)){
                throw new Exception("イベントが存在しません");
            }
            $spots = Spot::query()->where("event_id", $id)->get();
            foreach ($spots as $spot) {
                $spotArr[] = [
                    "name" => $spot->name,
                    "description" => $spot->description,
                    "location_x" => $spot->location_x,
                    "location_y" => $spot->location_y,
                    "map_image" => explode(",", $spot->images),
                ];
            }
            $result = [
                "name" => $event->name,
                "map_image" => $event->map_image,
                "spots" => $spotArr,
            ];
            if (empty($result)) {
                throw new Exception("resultsが空です");
            }
            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404,[],JSON_UNESCAPED_UNICODE);
        }
    }

    public function getSpot(Request $request)
    {
        try{

            if (!isset($request->event_id)) {
                throw new Exception("イベントIDが指定されていません");
            }
            $event_id = $request->event_id;
            $description = $request->description;
            $name = $request->name;
            $min_x = $request->min_x;
            $max_x = $request->max_x;
            $min_y = $request->min_y;
            $max_y = $request->max_y;
            $spots = Spot::query()->where("event_id", $event_id)->get();
            $results = [];
            foreach ($spots as $spot) {
                $query = Spot::query();
                if (isset($description)) {
                    $query->where("description", $description);
                }
                if (isset($description)) {
                    $query->where("name", $name);
                }
                if (isset($min_x)) {
                    $query->where("location_x", ">=", $min_x);
                }
                if (isset($max_x)) {
                    $query->where("location_x", "<=", $max_x);
                }
                if (isset($min_y)) {
                    $query->where("location_y", ">=", $min_y);
                }
                if (isset($max_y)) {
                    $query->where("location_y", "<=", $max_y);
                }
                $item = $query->find($spot->id);
                if(!isset($item)){
                    throw new Exception("イベントが存在しません");
                }
                $results[] = [
                    // eventのnullじゃないか確認 <-- OK
                    "name" => $item->name,
                    "description" => $item->description,
                    "location_x" => $item->location_x,
                    "location_y" => $item->location_y,
                    "map_image" => explode(",", $item->images),
                ];
            }
            if (empty($results)) {
                throw new Exception("リザルトが空です");
            }
            return response()->json($results);
        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()],404,[],JSON_UNESCAPED_UNICODE);
        }
    }

    public function postLog(Request $request)
    {
        try{

            if (!isset($request->event_id) || !isset($request->operation_type)) {
                throw new Exception("イベントIDもしくは操作種別が指定されていません");
            }
            $event_id = $request->event_id;
            $spot_id = $request->spot_id;
            $operation_type = $request->operation_type;
            $event = Event::query()->find($event_id);
            $spot = Spot::query()->find($spot_id);
            if (!isset($event)) {
                throw new Exception("イベントが存在しません");
            }
            Log::query()->create([
                "event_id" => $event->id,
                "spot_id" => isset($spot) ? $spot->id : null,
                "operation_type" => $operation_type,
            ]);
            return response()->json(["message" => "ログが登録されました"], 204);
        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()],404,[],JSON_UNESCAPED_UNICODE);
        }
    }
}
