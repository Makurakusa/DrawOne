<?php

namespace App\Http\Controllers;

//use宣言は外部にあるクラスをPicturesController内にインポートできる。
//この場合、App\Models内のPicturesクラスをインポートしている。
use Illuminate\Http\Request;
use App\Models\Picture;

class PictureController extends Controller
{
    public function index(Picture $picture)//インポートしたPictureをインスタンス化して$postとして使用。
    {
        return view('pictures.index')->with(['pictures' => $picture->getPaginateByLimit()]);  
       //blade内で使う変数'pictures'と設定。'pictures'の中身にgetを使い、インスタンス化した$pictureを代入
    }
    /**
    * 特定IDのpostを表示する
    * 
    * @params Object Post // 引数の$postはid=1のPostインスタンス
    * @return Reposnse post view
    */
    public function show(Picture $picture)
    {
        return view('pictures.show')->with(['picture' => $picture]);
        //'picture'はbladeファイルで使う変数。中身は$pictureはid=1のPictureインスタンス。
    }
    
    public function create()
    {
        return view('pictures.create');
    }
    
    public function store(Request $request, Picture $picture)
    {
        $input = $request['picture'];
        $picture->fill($input)->save();
        return redirect('/pictures/' . $picture->id);
    }
}
