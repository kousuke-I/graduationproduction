<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Waiting;
use Auth;

class WaitingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('Waiting');
       //$Waiting = Waiting::orderBy('id','asc')->get();
       $Waiting = Waiting::where('userid',Auth::user()->userid)
                 ->orderBy('id','asc')
                 ->get();
       //return view('Waiting',[
           //'Waiting' => $Waiting
           //]);
           
       $Waiting_list = Waiting::orderBy('id','asc')->get();
       
       $Waiting_count = Waiting::orderBy('id','asc')->count();
                 
       return view('Waiting')->with([
           'Waiting' => $Waiting,
           'Waiting_list' => $Waiting_list,
           'Waiting_count' => $Waiting_count,
           ]);
       
       //一覧表示用
       

       
    }
    
    public function __construct()
    {
       $this->middleware('auth');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
  $validator = Validator::make($request->all(), [
    'condition' => 'required|max:255',
  ]);
  // バリデーション:エラー
  if ($validator->fails()) {
    return redirect()
      ->route('Waiting.index')
      ->withInput()
      ->withErrors($validator);
  }
  // Eloquentモデル
  $Waiting = new Waiting;
  //$Waiting->userid = $request->userid;
  $Waiting->userid = Auth::user()->userid;
  $Waiting->condition = $request->condition;
  $Waiting->save();
  // ルーティング「Waiting.index」にリクエスト送信（一覧ページに移動）
  return redirect()->route('Waiting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Waiting = Waiting::find($id);
        //$Waiting->delete();
        $Waiting_list = Waiting::find($id);
        $Waiting->delete();
        //$Waiting_list->delete();
        return redirect()->route('Waiting.index');
    }
}
