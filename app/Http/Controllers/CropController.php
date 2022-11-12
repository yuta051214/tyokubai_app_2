<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CropRequest;
use App\Models\Crop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crops.index');
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

        return redirect()
            ->route('crops.show', $crop);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
