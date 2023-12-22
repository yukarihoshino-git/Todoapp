<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    //
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む
        
        // $folder = Auth::user()->folders();
        // dd($folder);
        
        Auth::user()->folders()->save($folder);
        
    
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

}
