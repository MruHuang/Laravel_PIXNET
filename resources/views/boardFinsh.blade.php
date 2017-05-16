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