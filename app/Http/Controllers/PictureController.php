<?php

namespace App\Http\Controllers;

//use宣言は外部にあるクラスをPicturesController内にインポートできる。
//この場合、App\Models内のPicturesクラスをインポートしている。
use App\Http\Requests\PictureRequest;
use Illuminate\Http\Request;
use App\Models\Picture;
use App\Models\Theme;


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
    
    public function create(Request $request, Theme $theme)
    {
        $id=$request->id;
        return view('pictures.create') -> with(['theme' => $theme ->where('id', $id)->first()]);
    }
    
    public function edit(Picture $picture)
    {
        return view('pictures.edit')->with(['picture' => $picture]);
    }
    
    public function update(PictureRequest $request, Picture $picture)
    {
        $input_picture = $request['picture'];
        $picture->fill($input_picture)->save();

        return redirect('/pictures/' . $picture->id);
    }
    
    public function store(Picture $picture, PictureRequest $request)
    {
        $dir = 'storage';
        $file = $request -> file('picture.image');
        $file_name = $file -> hashName();
        //getClientOriginalNameでオリジナルの名前が取れる。
        $request->file('picture.image')->storeAs('public/'.$dir, $file_name); 
        //storeAsメソッドを追加して引数に上で取得したオリジナル名を入れる。
        $picture = new Picture();
        $picture -> title = $request['picture.title'];
        $picture -> theme_id = $request['picture.theme_id'];
        $picture -> path = 'storage/' . $dir . '/' . $file_name;
        $picture->save();
        return redirect('/pictures/' . $picture->id);
    }
    
    public function delete(Picture $picture)
    {
        $picture->delete();
        return redirect('/');
    }
}
