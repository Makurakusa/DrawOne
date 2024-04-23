<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyRequest;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Picture;
use App\Models\User;

class CommentController extends Controller
{

    public function store(Comment $comment, CommentRequest $request)
    {
        $user_id = Auth::id();
        //getClientOriginalNameでオリジナルの名前が取れる。
        //storeAsメソッドを追加して引数に上で取得したオリジナル名を入れる。
        $comment = new Comment();
        $comment -> body = $request['comment.body'];
        $comment -> picture_id = $request['comment.picture_id'];
        $comment -> user_id = $user_id;
        $comment ->save();
        
        return redirect('/pictures/' . $comment->picture_id);
    }
    
    public function storeReply(Picture $picture, Reply $reply, ReplyRequest $request)
    {
        $user_id = Auth::id();
        //getClientOriginalNameでオリジナルの名前が取れる。
        //storeAsメソッドを追加して引数に上で取得したオリジナル名を入れる。
        $reply = new Reply();
        $reply -> body = $request['reply.body'];
        $reply -> comment_id = $request['reply.comment_id'];
        $reply -> user_id = $user_id;
        $reply ->save();
        
        return redirect('/pictures/' . $picture->id);
    }
    
    public function destroy(Picture $picture, Comment $comment)
    {
        $comment->delete();
        $comment->replies()->delete();
        return redirect('/pictures/' . $picture->id);
    }
    
    public function delete(Picture $picture, Comment $comment, Reply $reply)
    {
        $reply->delete();
        return redirect('/pictures/' . $picture->id);
    }
    
}
