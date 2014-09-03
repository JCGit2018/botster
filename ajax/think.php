<?php

require_once '../bootstrap.php';

function mtime()
{
	$exploded = explode(" ", microtime());
	return $exploded[0] + $exploded[1];
}

$start = mtime();

//Connect to database
db_connect();

// Continue session
session_start();

//Instantiate botster object
$botster = (new Lenton\Botster\Factory\Botster)->make();

//Check if conversation ID is set
if(!isset($_SESSION['conversation_id']))
{
	$botster->error('Conversation ID is not set.');
}
//$botster->log('Conversation ID: '.$_SESSION['conversation_id']);

//Set conversation object
$botster->conversation = new Lenton\Botster\Conversation($_SESSION['conversation_id']);

//Get input
if(isset($_GET['input']))
{
	$input = $_GET['input'];
}
else
{
	if(($previous_message = $botster->conversation->getMessage(0)) === false || $previous_message['author'] != 1) exit();
	$input = $previous_message['message'];
}
$botster->log('Input: '.$input);

//Analyse input
$analysed_input = $botster->analyseInput($input);

//Get output for each sentence
foreach($analysed_input['sentences'] as $key => $sentence)
{
	//Skip loop if filtered input is empty
	if($sentence['filtered'] == '') continue;

	//Check for a preprogrammed response
	if(($output = $botster->checkCommand($sentence)) !== false)
	{
		$analysed_input['sentences'][$key]['output'] = $output;
		$analysed_input['sentences'][$key]['search'] = 'command';
		continue;
	}
	
	//Check if sentence is a stopword
	if($botster->checkStopword($sentence['filtered']))
	{
		$analysed_input['sentences'][$key]['output'] = $botster->failSearch();
		$analysed_input['sentences'][$key]['search'] = 'fail';
		continue;
	}
	
	//If input not said before and sentence isn't spam
	if(!$analysed_input['said'] && !$sentence['spam'])
	{
		//Learn sentence
		$botster->learnSentence($sentence['filtered']);

		//If both messages are one sentence
		if(
			count($analysed_input['sentences']) == 1 &&
			count($previous_sentences = $botster->splitSentences($botster->conversation->getMessage(0, 0))) == 1
		)
		{
			//Filter previous sentence
			$previous_sentences[0] = $botster->filterSentence($previous_sentences[0]);

			//Create or strengthen connection
			$botster->learnConnection($previous_sentences[0], $sentence['filtered']);
		}
	}

	//Do strict search
	if(($output = $botster->searchBrain($sentence)) !== false)
	{
		$analysed_input['sentences'][$key]['output'] = $output;
		$analysed_input['sentences'][$key]['search'] = 'strict';
		continue;
	}

	//Do light search
	if(($output = $botster->searchBrain($sentence, false)) !== false)
	{
		$analysed_input['sentences'][$key]['output'] = $output;
		$analysed_input['sentences'][$key]['search'] = 'light';
		continue;
	}

	//Default to fail search
	$analysed_input['sentences'][$key]['output'] = $botster->failSearch();
	$analysed_input['sentences'][$key]['search'] = 'fail';
}

ob_start(); print_r($analysed_input); $dump = ob_get_contents(); ob_end_clean();
$botster->log("Analysed Input:\n".$dump);

//Choose sentences
if(($message = $botster->chooseSentences($analysed_input['sentences'])) == '') exit();
$botster->log('Output: '.$message);

$finish = mtime();

$execution_time = $finish - $start;
$botster->log('Script executed in ' . $execution_time . ' seconds.');

//Say output
$botster->say($message);

if(isset($_GET['input'])) echo '<pre>'.htmlentities($botster->log).'</pre>';
