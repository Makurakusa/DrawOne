<?php

namespace App\Http\Controllers;

//use宣言は外部にあるクラスをPicturesController内にインポートできる。
//この場合、App\Models内のPicturesクラスをインポートしている。
use App\Http\Requests\ThemeRequest;
use App\Models\Theme;
use App\Models\Picture;
use App\Http\Controllers\PictureController;

class ThemeController extends Controller
{
    public function index(Theme $theme)//インポートしたThemeをインスタンス化して$postとして使用。
    {
        return $theme->get();//$themeの中身を戻り値にする。
    }
    
    public function show(Theme $theme)
    {
        return view('themes.show')->with(['theme' => $theme]);
        //'picture'はbladeファイルで使う変数。中身は$pictureはid=1のPictureインスタンス。
    }
    
    public function create()
    {
        return view('themes.create');
    }
    public function store(ThemeRequest $request, Theme $theme)
    {
        $theme = new theme();
        $theme -> title = $request['theme.title'];
        $theme -> save();
        $id=$theme->id;
        return redirect('/themes/' . $id);
    }
}
