<?php

namespace App\Http\Controllers;

//use宣言は外部にあるクラスをPicturesController内にインポートできる。
//この場合、App\Models内のPicturesクラスをインポートしている。
use App\Http\Requests\PictureRequest;
use App\Http\Requests\PictureUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Picture;
use App\Models\Theme;
use App\Models\Like;
use App\Models\User;


class PictureController extends Controller
{
    
    // only()の引数内のメソッドはログイン時のみ有効
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
    }
    
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
    
    public function update(PictureUpdateRequest $request, Picture $picture)
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
        $user_id = Auth::id();
        //getClientOriginalNameでオリジナルの名前が取れる。
        $request->file('picture.image')->storeAs('public/'.$dir, $file_name); 
        //storeAsメソッドを追加して引数に上で取得したオリジナル名を入れる。
        $picture = new Picture();
        $picture -> title = $request['picture.title'];
        $picture -> theme_id = $request['picture.theme_id'];
        $picture -> user_id = $user_id;
        $picture -> path = 'storage/' . $dir . '/' . $file_name;
        $picture->save();
        return redirect('/pictures/' . $picture->id);
    }
    
    public function delete(Picture $picture)
    {
        $picture->delete();
        return redirect('/');
    }
    
    //いいね機能
    public function like(Request $request)
    {
        $id=$request->id;
        Like::create([
            'picture_id' => $id,
            'user_id' => Auth::id()
            ]);
        
        session()->flash('作品にいいねをしました！');
        
        return redirect()->back();
    }
    
    public function unlike(Request $request)
    {
        $id=$request->id;
        $like = Like::where('picture_id', $id)->where('user_id', Auth::id())->first();
        $like -> delete();
        
        session()->flash('いいねを取り消しました');
        
        return redirect()->back();
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Picture::query();
        $idCollections = array();
        
        if($keyword) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($keyword, 's');
            // 単語を半角スペースで区切り、配列にする（例："犬 Maukurakusa" → ["犬", "Makurakusa"]）
            $keywordArray = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            
            // foreach($keywordArray as $value) {
            //     $query->WhereHas('user',function ($q) use ($value){
            //                 $q->where('name','LIKE',"%{$value}%");
            //             })
            //         ->orwhere('title', 'LIKE', "%{$value}%");
            //     $queryId = $query -> where('id') ->get();
            //     dd($queryId);
            //     $idCollections[] = $queryId;
            //     $query = Picture::query(); 
            // }
            
            $query->where(function($query) use ($keywordArray) {
            foreach ($keywordArray as $value) {
                    $query->where(function($subQuery) use ($value) {
                        $subQuery->whereHas('user', function ($q) use ($value) {
                            $q->where('name', 'LIKE', "%{$value}%");
                        })->orWhere('title', 'LIKE', "%{$value}%");
                    });
    }
});
            // dd($idCollections);
            
        }
        
        $result = $query -> paginate(2);

        return view('pictures.search')->with(['pictures' => $result, 'keyword' => $keyword]);
    }
    
    //メンターさんの提案で以下のように書き換えましたが、同様の挙動になりました。
    // public function search(Request $request)
    //     {
    //         $keyword = $request->input('keyword');
    //         $query = Picture::query();
            
    //         if($keyword) {
    //             // 全角スペースを半角に変換
    //             $spaceConversion = mb_convert_kana($keyword, 's');
    //             // 単語を半角スペースで区切り、配列にする（例："犬 Maukurakusa" → ["犬", "Makurakusa"]）
    //             $keywordArray = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                
    //             $query->where(function($query) use ($keywordArray) {
    //                 foreach($keywordArray as $value) {
    //                     $query->whereHas('user', function ($q) use ($value) {
    //                             $q->where('name', 'LIKE', "%{$value}%");
    //                         })
    //                         ->orWhere('title', 'LIKE', "%{$value}%");
    //                 }
    //             });
    //         }
            
    //         $result = $query->paginate(2);
        
    //         return view('pictures.search')->with(['pictures' => $result, 'keyword' => $keyword]);
    //     }
    
}
