@extends('layouts.HomePage')

@section('title', 'PIXENT')

@section('content_title')
    <div class="titleName col-xs-4">
        猜數字
     </div>
    <div class='titleAnsGuessNumber col-xs-3'>
        答案提示 :{{ $Guess }}個數字
    </div>
    <div class='titleAnsGuessNumber col-xs-5 raw'>
        <a type='button' class ='btn btn-info col-xs-5' href="{{ route('restartGame', ['Guess'=>$Guess] ) }}">
            重新遊戲
        </a>
    </div>
    
@stop

@section('content_central')
    <form method="POST" class="form-inline col-xs-12"  action="{{ action('GuessNumberController@postAns',[
        'Guess'=>$Guess,
        'GuessNumber'=>$GuessNumber,
        'Anshistory'=>$Anshistory
        ])}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="inputGuess" class="sr-only"></label>
            <input type="number" class="form-control" id="inputGuess" name="inputGuess"  placeholder="請輸入不重複的數字">
        </div>
        <button type="submit" class="btn btn-default">Go</button>
    </form>
    <div class='GuessNumberAns  col-xs-12'>
        {{ $InputGuess }}
    </div>
@stop

@section('content_bottom')
        <div class="panel panel-default col-xs-6" style="height: 190px">
          <div class="panel-body">
            {!! $Anshistory !!}
          </div>
        </div>
        
        <a type='button' class ='btn btn-info' href="{{  action('GuessNumberController@Download', [
        'Guess'=>$Guess,
        'GuessNumber'=>$GuessNumber,
        'Anshistory'=>$Anshistory
        ] )   }}">
                下載作答記錄
        </a>
@stop