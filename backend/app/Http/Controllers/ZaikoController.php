<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Zaiko; 
use App\Http\Requests\ZaikoRequest;
use Illuminate\Http\Response;
use App\Http\Requests\HensyuRequest;




class ZaikoController extends Controller
{
    /**
     * 在庫一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {
        $zaikos = Zaiko::all();
        return view('zaiko.list', ['zaikos' => $zaikos]);
    }


    /**
     * 詳細一覧を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $zaiko = Zaiko::find($id);

        if (is_null($zaiko)) {
            \Session::flash('err_msg', 'データがありませんよ');
            return redirect(route('zaikos'));
        }
        return view('zaiko.detail', ['zaiko' => $zaiko]);
    }

    /**
     * 在庫登録画面を表示する
     * 
     * @return view
     */
    public function showCreate()
    {
        return view('zaiko.from');
    }

    /**
     * 在庫を登録する
     * 
     * @return view
     */
    public function exeStore(ZaikoRequest $request)
    {
        $inputs = $request->validated();
        // dd($inputs['name']);
        // var_dump(12);exit;
        DB::beginTransaction();

        try {
            $zaiko = new Zaiko();
            $zaiko->name = $inputs['name'];
            $zaiko->kakaku = $inputs['kakaku'];
            $zaiko->kazu = $inputs['kazu'];
            $zaiko->shosai = $inputs['shosai'];
            $zaiko->jyoukyou = $inputs['jyoukyou'];
            $zaiko->save();
            // Zaiko::create($inputs);
         


            DB::commit();
        } catch (\Throwable $e) {
            // dd($e->getMessage());
            DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '在庫を登録しました');
        return redirect(route('zaikos'));
    }


    /**
     * 在庫編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $zaiko = Zaiko::find($id);
        if (is_null($zaiko)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('zaikos'));
        }
        return view('zaiko.edit', compact('zaiko'));
    }




    /**
     * 在庫を更新する
     * 
    * @return view
    */
    public function exeUpdate(ZaikoRequest $request)
    {
        $inputs = $request->validated();

        $userRole = auth()->user()->role; // ログインユーザーの役割を取得

        $allowedChoices = [];

        $userID = auth()->user()->id; // ログインユーザーのIDを取得

        if ($userID === 1) { // 在庫発注社員のIDが1の場合
            $allowedChoices = ['在庫確認'];
        } elseif ($userID === 2) { // 在庫発注管理者のIDが2の場合
            $allowedChoices = ['在庫確認', '発注状態', '発注受け取り済み'];
        } elseif ($userID === 3) { // 在庫受注社のIDが3の場合
            $allowedChoices = ['在庫発注', '発注済み'];
        } else {
            abort(403, '許可されていないユーザーです。');
        }

        DB::beginTransaction();

        try {
            $zaiko = Zaiko::find($request->id); // 変更点: $inputs['id'] から $request->id に変更
            $zaiko->name = $inputs['name'];
            $zaiko->kakaku = $inputs['kakaku'];
            $zaiko->kazu = $inputs['kazu'];
            $zaiko->shosai = $inputs['shosai'];

            if (in_array($inputs['jyoukyou'], $allowedChoices)) {
                $zaiko->jyoukyou = $inputs['jyoukyou'];
            } else {
                abort(403, '許可されていない選択肢です。');
            }

            $zaiko->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e; // エラーを再スローして詳細を表示する
        }

        \Session::flash('err_msg', '在庫を更新しました');
        return redirect(route('zaikos'));
    }

        

    

     /**
     * 在庫削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        $zaiko = Zaiko::find($id);
        if (is_null($zaiko)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('zaikos'));
        }

        try {
            // 在庫を削除
            Zaiko::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('zaikos'));
    }

    public function export()
    {
        // 文字エンコーディングを指定
        $encoding = mb_internal_encoding();
        mb_http_output($encoding);


        // 在庫データを取得
        $zaikos = Zaiko::all();

        if ($zaikos->isEmpty()) {
            // 在庫データが存在しない場合の処理
            return back()->with('error', '在庫データがありません。');
        }

        // CSVファイル名
        $fileName = 'inventory.csv';

        // レスポンスヘッダーの設定
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
        

        // 出力バッファリングの開始
        ob_start();

        // 出力ファイルの作成
        $file = fopen('php://output', 'w');

        // ヘッダーレコードを書き込む
        fputcsv($file, [
            mb_convert_encoding('ID', 'SJIS', 'UTF-8'),
            mb_convert_encoding('在庫名', 'SJIS', 'UTF-8'),
            mb_convert_encoding('値段', 'SJIS', 'UTF-8'),
            mb_convert_encoding('個数', 'SJIS', 'UTF-8'),
            mb_convert_encoding('詳細', 'SJIS', 'UTF-8'),
            mb_convert_encoding('発注状態', 'SJIS', 'UTF-8'),
        ]);


        $id = 1; // 初期値を1に設定
        // 在庫データを書き込む
        foreach ($zaikos as $zaiko) {
            fputcsv($file, [
                mb_convert_encoding($id++, 'SJIS', 'UTF-8'),
                mb_convert_encoding($zaiko->name, 'SJIS', 'UTF-8'),
                mb_convert_encoding($zaiko->kakaku, 'SJIS', 'UTF-8'),
                mb_convert_encoding($zaiko->kazu, 'SJIS', 'UTF-8'),
                mb_convert_encoding($zaiko->shosai, 'SJIS', 'UTF-8'),
                mb_convert_encoding($zaiko->jyoukyou, 'SJIS', 'UTF-8'),
            ]);
            
        }

        // ファイルを閉じる
        fclose($file);

        // 出力バッファを取得してクリア
        $csvData = ob_get_clean();

        // レスポンスを作成
        $response = new Response($csvData, 200, $headers);

        return $response;
    }
    
    public function index()
    {
        $zaikoList = Zaiko::all();

        return response()->json($zaikoList);
    }
}

