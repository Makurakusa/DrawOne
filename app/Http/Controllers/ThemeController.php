<?php

namespace App\Http\Controllers;

//use宣言は外部にあるクラスをPicturesController内にインポートできる。
//この場合、App\Models内のPicturesクラスをインポートしている。
use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function index(Theme $theme)//インポートしたThemeをインスタンス化して$postとして使用。
    {
        return $theme->get();//$themeの中身を戻り値にする。
    }
}
