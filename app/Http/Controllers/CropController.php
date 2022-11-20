<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CropRequest;
use App\Models\Crop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function index($id)
    {
        $crops = Crop::where('user_id', $id)->get();  // 疲れた〜
        // dd($crops);
        return view('crops.index', compact('crops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * * @param  \App\Http\Requests\CropRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CropRequest $request)
    {
        $crop = new Crop($request->all());
        $crop->user_id = $request->user()->id;

        $file = $request->file('image');
        $crop->image = date('YmdHis') . '_' . $file->getClientOriginalName();

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録
            $crop->save();

            // 画像アップロード
            if (!Storage::putFileAs('images/crops', $file, $crop->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // 急遽追加した処理
        $user = Auth::user();

        return redirect()
            ->route('users.crops.index', $user)
            ->with('notice', '記事を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crop = Crop::find($id);
        // dd($crop);
        return view('crops.edit', compact('crop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CropRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CropRequest $request, $id)
    {
        $crop = crop::find($id);

        if ($request->user()->cannot('update', $crop)) {
            return redirect()->route('crops.index', $crop)
                ->withErrors('自分の記事以外は更新できません');
        }

        $file = $request->file('image');
        if ($file) {
            $delete_file_path = 'images/crops/' . $crop->image;
            $crop->image = date('YmdHis') . '_' . $file->getClientOriginalName();
        }
        $crop->fill($request->all());

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 更新
            $crop->save();

            if ($file) {
              // 画像アップロード
            if (!Storage::putFileAs('images/crops', $file, $crop->image)) {
                  // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
            }
              // 画像削除
            if (!Storage::delete($delete_file_path)) {
                  //アップロードした画像を削除する
                Storage::delete('images/crops/' . $crop->image);
                  //例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // 急遽追加した処理
        $user = Auth::user();

        return redirect()->route('users.crops.index', $user)
            ->with('notice', '記事を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crop = Crop::find($id);

        // トランザクション開始
        DB::beginTransaction();
        try {
            $crop->delete();

            // 画像削除
            if (!Storage::delete('images/crops/' . $crop->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの削除に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        $user = Auth::user();
        return redirect()->route('users.crops.index', $user)
            ->with('notice', '記事を削除しました');
    }
}
