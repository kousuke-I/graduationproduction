@extends('layouts.app')
@section('content')
<div class="panel-body">
  <!-- バリデーションエラーの表示に使用するエラーファイル-->
  @include('common.errors')
  <!-- 発券フォーム -->
  <form action="{{ route('Waiting.store') }}" method="POST" class="form-horizontal">
    @csrf
    <div class="form-group">
      <div class="col-sm-6">
       <div>{{ $Waiting_count }}人待ちです。</div>
      </div>



      <!-- 症状 -->
      <div class="col-sm-6">
        <label for="condition" class="col-sm-3 control-label">症状</label>
        <input type="text" name="condition" id="condition" class="form-control">
      </div>
    </div>
    <!-- 発券ボタン -->
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary">発券</button>
      </div>
    </div>
  </form>
  <!-- この下に発券済みリストを表示 -->
  
    <!-- 表示領域 -->
@if (count($Waiting) > 0)
<div class="panel panel-default">
  <div class="panel-heading">あなたの予約</div>
    <div class="panel-body">
      <table class="table table-striped waitings-table">
        <!-- テーブルヘッダ -->
        <thead>
          <th>番号</th>
          <th>診察券番号</th>
          <!--<th>症状</th>-->
          <th>受付けた時間</th>
        </thead>
        <!-- テーブル本体 -->
        
        <tbody>
          @foreach ($Waiting as $Waiting)
          <tr>
            <td class="table-text">
              <div>{{ $Waiting->id }}</div>
            </td>
            <td class="table-text">
              <div>{{ $Waiting->userid }}</div>
            </td>
            <!--<td class="table-text">
              <div>{{ $Waiting->condition }}</div>
            </td>-->
            <td class="table-text">
              <div>{{ $Waiting->created_at }}</div>
            </td>
            <td>
              <!-- 削除ボタン -->
              <form action="{{ route('Waiting.destroy',$Waiting->id) }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">キャンセル</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endif



<!--一覧表示-->
@if (count($Waiting_list) > 0)
<div class="panel panel-default">
  <div class="panel-heading">全体の予約</div>
    <div class="panel-body">
      <table class="table table-striped waitings-table">
        <!-- テーブルヘッダ -->
        <thead>
          <th>番号</th>
          <th>診察券番号</th>
          @can('system-only')
          <th>症状</th>
          @endcan
          <th>受付けた時間</th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          @foreach ($Waiting_list as $Waiting_list)
          <tr>
            <td class="table-text">
              <div>{{ $Waiting_list->id }}</div>
            </td>
            <td class="table-text">
              <div>{{ $Waiting_list->userid }}</div>
            </td>
            @can('system-only')
            <td class="table-text">
              <div>{{ $Waiting_list->condition }}</div>
            </td>
            @endcan
            <td class="table-text">
              <div>{{ $Waiting_list->created_at }}</div>
            </td>
            @can('system-only')
            <td>
              <!-- 削除ボタン -->
              <form action="{{ route('Waiting.destroy',$Waiting_list->id) }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">受診済み</button>
              </form>
            </td>
            @endcan
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>

</div>
@endif
<!-- ここまで発券済みリスト -->
  
  
  </div>
@endsection