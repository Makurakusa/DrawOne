<?php

namespace App\Http\Controllers;

//use宣言は外部にあるクラスをPicturesController内にインポートできる。
//この場合、App\Models内のPicturesクラスをインポートしている。
use App\Http\Requests\ThemeRequest;
use App\Models\Theme;
use App\Models\Picture;

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
    public function store(ThemeRequest $request, Theme $theme)
    {
        $input = $request['theme'];
        $theme->fill($input)->save();
        return redirect()->route('pictures.create');
    }
}
