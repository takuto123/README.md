<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zaiko;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ZaikoRequest;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        // 在庫情報を全件取得する
        $zaikos = Zaiko::all();
    
        return response()->json($zaikos);
    }
    
    public function show($id = null)
    {
        // 在庫IDに対応する在庫情報を取得する
        $zaiko = Zaiko::find($id);

        if (!$zaiko) {
            return response()->json(['message' => 'Inventory not found'], 404);
        }

        return response()->json($zaiko);
    }


    public function store(ZaikoRequest $request)
    {
        $inputs = $request->validated();
        DB::beginTransaction();

        try {
            $zaiko = new Zaiko();
            $zaiko->name = $inputs['name'];
            $zaiko->kakaku = $inputs['kakaku'];
            $zaiko->kazu = $inputs['kazu'];
            $zaiko->shosai = $inputs['shosai'];
            $zaiko->jyoukyou = $inputs['jyoukyou'];
            $zaiko->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }

        if (!$zaiko->save()) {
            // 在庫保存失敗時のレスポンスを返す
            return response()->json(['error' => 'Failed to save stock'], 500);
        }
        
        
        // 保存成功時のレスポンスを返す
        return response()->json(['message' => 'Product saved successfully'], 200);
        
    }

    public function Update(ZaikoRequest $request)
    {
        $inputs = $request->validated();

        DB::beginTransaction();

        try {
            $zaiko = Zaiko::find($request->id);
            $zaiko->name = $inputs['name'];
            $zaiko->kakaku = $inputs['kakaku'];
            $zaiko->kazu = $inputs['kazu'];
            $zaiko->shosai = $inputs['shosai'];
            $zaiko->jyoukyou = $inputs['jyoukyou'];
            $zaiko->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e; 
        }
        if (!$zaiko->save()) {
                // 在庫保存失敗時のレスポンスを返す
                return response()->json(['error' => 'Failed to save stock'], 500);
            }

        // 保存成功時のレスポンスを返す
        return response()->json(['message' => 'Product saved successfully'], 200);
    }
}    