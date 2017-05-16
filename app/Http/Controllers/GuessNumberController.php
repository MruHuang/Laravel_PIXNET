<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Route;
use Validator;
use View;

class GuessNumberController extends Controller
{
	public function RepeatGame($Guess=4) {

		$arraylong = 1;
		$AnsArray = array();
		$AnsArray[0] = rand(0,9);
		$AnsNumber = "";

		while($arraylong != $Guess+1){
			$RandomNumber = rand(0,9);
			if(!in_array($RandomNumber,$AnsArray)){
				$AnsArray[$arraylong] = $RandomNumber;
				$arraylong++;
			}
		}

		for($forNumber = 0; $forNumber < $Guess; $forNumber++){
			$AnsNumber = $AnsNumber.$AnsArray[$forNumber];
		}
		
    	return View::make('board',[
    		'GuessNumber'=>$AnsNumber,
    		'Guess'=>$Guess,
    		'InputGuess'=>null,
    		'Anshistory'=>'作答記錄'
		]);
    }

    public function Download(
    	$Guess = 4,
    	$GuessNumber,
    	$Anshistory
	) {

    	$file_name = "Anshistory.txt";
		$file_path = "txt/Anshistory.txt";

		$AnsFile = fopen($file_path, 'w');
		fwrite($AnsFile, str_replace('<br>', "\r\n", $Anshistory));
		fclose($AnsFile);
		$file_size = filesize($file_path);

		header('Content-Type: application/force-download');
		header('Content-Length: ' . $file_size);
		header('Content-Disposition: attachment; filename="' . $file_name . '";');
		header('Content-Transfer-Encoding: binary');
		readfile($file_path);
    }
    public function postAns(
    	$Guess,
    	$GuessNumber = 0,
    	$Anshistory,
    	Request $Request
	) {	
    	$AnsA = 0;
    	$AnsB = 0;
    	$Numbercheck = 0;
    	$GuessAns = str_split($GuessNumber, 1);
    	$WriteAns = str_split($Request->input('inputGuess'), 1);
    	$Writehistory = explode('<br>', $Anshistory);
    	$errortext = null;

    	if($Guess == count($WriteAns)){
	    	for($arraylong = 0; $arraylong < $Guess; $arraylong++){
	    		for($arraylong2 = 0; $arraylong2 < $Guess; $arraylong2++){
	    			if($GuessAns[$arraylong] == $WriteAns[$arraylong2]){
	    				if($arraylong == $arraylong2)
	    					$AnsA++;
	    				else
	    					$AnsB++;
	    			}
	    		}
	    	}

	    	for($arraylong = 0; $arraylong < count($Writehistory); $arraylong++){
				$Writehistory2 = explode(' : ', $Writehistory[$arraylong]);
	    		if ($Request->input('inputGuess') == $Writehistory2[0]){
	    			$errortext = '此答案已經輸入過了';
	    			$Numbercheck = 1;
	    		}
	    	}

	    	for($arraylong = 0; $arraylong < $Guess; $arraylong++){
	    		for($arraylong2 = $arraylong + 1; $arraylong2 < $Guess; $arraylong2++){
	    			if($WriteAns[$arraylong] == $WriteAns[$arraylong2]){
	    				$errortext = '請輸入'.$Guess.'個不重複的數字';
	    				$Numbercheck = 1;
	    			}
	    		}
    		}
    	}else{
    		$errortext = '請輸入'.$Guess.'個不重複的數字';
			$Numbercheck = 1;
    	}

    	if($Request->input('inputGuess') == $GuessNumber){
    		return View::make('boardFinsh',[
	    		'GuessNumber'=>$GuessNumber,
	    		'Guess'=>$Guess,
	    		'InputGuess'=>'您輸入的答案是'.$Request->input('inputGuess').' : '.$AnsA.'A'.$AnsB.'B',
	    		'Anshistory'=>$Anshistory.'<br>'.$Request->input('inputGuess').' : 正解'
			]);
    	}else if ($Numbercheck == 0){
	    	return View::make('board',[
	    		'GuessNumber'=>$GuessNumber,
	    		'Guess'=>$Guess,
	    		'InputGuess'=>'您輸入的答案是'.$Request->input('inputGuess').' : '.$AnsA.'A'.$AnsB.'B',
	    		'Anshistory'=>$Anshistory.'<br>'.$Request->input('inputGuess').' : '.$AnsA.'A'.$AnsB.'B'
			]);
    	}else{
    		return View::make('board',[
	    		'GuessNumber'=>$GuessNumber,
	    		'Guess'=>$Guess,
	    		'InputGuess'=>$errortext,
	    		'Anshistory'=>$Anshistory
			]);
    	}
    }
}