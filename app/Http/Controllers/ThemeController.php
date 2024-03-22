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
    public function create()
    {
        return view('themes.create');
    }
    public function store(Request $request, Theme $theme)
    {
        $input = $request['theme'];
        $theme->fill($input)->save();
        return view('pictures.create');
    }
}
