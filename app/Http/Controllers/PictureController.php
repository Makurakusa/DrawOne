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
}
