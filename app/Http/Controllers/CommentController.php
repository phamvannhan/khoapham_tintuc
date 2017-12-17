<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    public function getDelete($id)
    {
    	$comment = Comment::find($id);
    	$comment->delete();
    	
    		return view('admin.tintuc.sua')->with('tbXoaBL','Bạn đã xoá bình luận thành công !');
    	//bo redirect
    	
    	
    }
}
