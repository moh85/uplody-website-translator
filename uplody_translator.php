<?php
/*********************
 * Uplody Translator version 1.0
 * Developed by Mohammad Atwi @ uplody.com
 * 2020 Open source project
 * You're free to use, edit and share this project
 *********************/

/* if you want, hide errors & warnings */
//error_reporting(0);

/******************** SETTINGS: YOU CAN CHANGE THE VALUE OF EACH CONSTANT ******************/

/* supported languages: lang_code => [name, direction, text_direction] */
define('______UPLODY______LANGS______', 
[
'en' => ['English', 'ltr', 'left'],
'ar' => ['العربية', 'rtl', 'right'],
]);

/* login password */
define('______UPLODY______PASSWORD______', 'password4862458621456247856245');

/* script name: change it according to your needs */
define('______UPLODY______SCRIPT______', 'uplody_translator.php');

/* database file name without (.php): change it according to your needs */
define('______DATABASE______FILE______', '_uplody_lang____');

/* how many flags to show per line in GUI page (based on Bootstrap Grid System). Recommended: 1 / 2 / 3 / 4 */
define('______UPLODY______LIMIT______', 4);

/* script version - no need to change */
define('______VERSION______', '1.0');

/****************************************************************************************** */

/**********************************************************
 * ########################################################
 * ####### DON'T CHANGE ANYTHING AFTER THIS COMMENT #######
 * ########################################################
 *  ******************************************************/

/**************************** CLASS CALL */
if(isset($___ACTIVATE___TRANSLATOR___) && $___ACTIVATE___TRANSLATOR___ == true){
class uplody_translator{
var $fileDb  = __DIR__ . '/'.______DATABASE______FILE______.'.php';
var $isjson = false;
function __construct($opt=false){
$this->isjson = $opt;
//var_dump($opt); die('x');

}
function get($lang=false){
@include $this->fileDb;
if(isset($_uplody_language_text)){
if($lang){
if(in_array($lang, array_keys(______UPLODY______LANGS______))){
$data = [];
foreach($_uplody_language_text as $flag => $value){
$data[$flag] = $value[$lang];
 }
}
else{
die('<div><h5 style="margin:10px;border:4px solid red;padding:17px;font-size:16px;font-family:tahoma"><font color="red">Uplody Translator Error: The selected language not supported in system settings.</font></h5></div>');
  }
 }
else{
$data = $_uplody_language_text;
 }
if($this->isjson){
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);
 }
else{
return $data;
 }
}
else{
die('<div><h5 style="margin:10px;border:4px solid red;padding:17px;font-size:16px;font-family:tahoma"><font color="red">Uplody Translator Error: Database file was not created yet.</font></h5></div>');
  }
 }
}
goto skip______UT______GUI;
}

/**************************** SCRIPT GUI */
function ______________uplodyTranslatorGUI(){
$languages = ______UPLODY______LANGS______;
$password = ______UPLODY______PASSWORD______;
$scriptName  = ______UPLODY______SCRIPT______;
$wordsPerRow = ______UPLODY______LIMIT______;
$postPrefix  = '_____________';
$wordsPerRow = (12 / $wordsPerRow);
(isset($_REQUEST['password']) && $_REQUEST['password'] == $password) ? '' : die("
<head><title>Uplody Translator GUI | Login</title></head>
<body style='background:#eee;text-align:center;font-family:tahoma'>
<br><h2>Uplody Translator | Login</h2><form action='' method='get'><input autocomplete='off' style='padding:9px' name='password' placeholder='Password'><input type='submit' style='padding:8px;margin-left:5px' value='Login'></form></body>");
$langs = ''; foreach($languages as $k => $v){ $langs .= "<option data-select-".htmlentities($k)." value='".htmlentities($k)."'>".htmlentities($v[0])."</option>"; }
$language = '';
if(isset($_REQUEST['language']) && strlen($_REQUEST['language'])>0 && in_array($_REQUEST['language'], array_keys($languages))){
$language = $_REQUEST['language'];
}
else{
if(isset($_REQUEST['api_language'])); 
else {
die("
<head><title>Uplody Translator GUI | Choose Language</title></head>
<body style='background:#eee;text-align:center;font-family:tahoma'>
<br><h2>Uplody Translator | Choose Language</h2>
Please enter a valid language code:<br><br><form action='./".htmlentities($scriptName)."' method='get'><input type='hidden' style='padding:9px' name='password' value='".htmlentities($password)."'><select style='padding:9px' name='language'>".$langs."</select><input style='padding:8px;margin-left:5px' type='submit' value='Go'></form></body>");
  }
}

$scriptUrlPass = "./".htmlentities($scriptName)."?password=".htmlentities($password);
$scriptUrl = "./".htmlentities($scriptName)."?password=".htmlentities($password).'&language='.htmlentities($language);
$database = __DIR__ . '/'.______DATABASE______FILE______.'.php';

/************************* HELP */
if(isset($_REQUEST['help'])){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Uplody Translator v<?=htmlentities(______VERSION______)?> Help</title>
<style>pre b{color:firebrick}</style>
</head>
<body style="font-family:tahoma;margin:15px">
<h2>Uplody Translator v<?=htmlentities(______VERSION______)?> Help</h2>
<a href="./<?=$scriptUrl?>">Back</a>
<br>
<br>
<hr>
<p>
<font color="green"><b>Uplody Translator Usage</b></font> 
<pre style="background:#eee;padding:8px;border:1px solid #ccc">
// add this code to your top page
$___ACTIVATE___TRANSLATOR___ = true; 
include_once('uplody_translator.php');

// create new "uplody_translator" object
$translator = new uplody_translator;

// ******************** usage #1

// to get all languages data
$data = $translator->get();

// to get flag value e.g. English ~ return an <b>ARRAY</b> e.g. ['en' => 'word', 'fr' => 'mot']
$word = $data['my_flag']['en'];

// ******************** usage #2

// to get a specific language data by language code (based on your script settings)
$data = $translator->get('en');

// to get flag value of selected language code ~ return a <b>STRING</b> e.g. "word"
$word = $data['my_flag'];

// ******************** usage #3

// to get data in JSON format just add "json" value when you create the object
$translator = new uplody_translator('json');
// show json data
$translator->get();
.
.
.
</pre>
<br>
<font id="api" color="green"><b>Uplody Translator API</b></font> 
<h5>Add / Update Text</h5>
<pre style="background:#eee;padding:8px;border:1px solid #ccc">
GET / POST
~ <?=htmlentities(______UPLODY______SCRIPT______)?>?password=<b>[PASSWORD]</b>&api_language=<b>[LANGUAGE_CODE]</b>&flag[]=<b>my_flag_1</b>&word[]=<b>my_word_1</b>
</pre>
<br>
* Example #1 (add website name flag with name to English version):
<pre style="background:#eee;padding:8px;border:1px solid #ccc">
GET / POST
~ <?=htmlentities(______UPLODY______SCRIPT______)?>?password=<b>123456789</b>&api_language=<b>en</b>&flag[]=<b>website_name</b>&word[]=<b>uplody</b>
</pre>
<br>
* Example #2 (add multiple flags and words to English version):
<pre style="background:#eee;padding:8px;border:1px solid #ccc">
GET / POST
~ <?=htmlentities(______UPLODY______SCRIPT______)?>?password=<b>123456789</b>&api_language=<b>en</b>&flag[]=<b>website_name</b>&word[]=<b>uplody</b>&flag[]=<b>slogan</b>&word[]=<b>great code ... great mind</b>
</pre>
<br>
* Example #3 (add multiple flags and words to English and Arabic versions):
<h6 style="margin-top:8px;margin-bottom:0px">* send multiple requests but in order: you must wait each request response to send the next one to avoid conflict.</h6>
<pre style="background:#eee;padding:8px;border:1px solid #ccc">
- Request #1: GET / POST
~ <?=htmlentities(______UPLODY______SCRIPT______)?>?password=<b>123456789</b>&api_language=<b>en</b>&flag[]=<b>website_name</b>&word[]=<b>uplody</b>&flag[]=slogan&word[]=great code ... great mind

- Request #2: GET / POST
~ <?=htmlentities(______UPLODY______SCRIPT______)?>?password=<b>123456789</b>&api_language=<b>ar</b>&flag[]=<b>website_name</b>&word[]=<b>uplody</b>&flag[]=<b>slogan</b>&word[]=<b>great code ... great mind</b>
</pre>
* Example #4 (delete one/multiple records by flag - in all languages):
<h6 style="margin-top:8px;margin-bottom:0px">* you must send any valid "api_language" code.</h6>
<pre style="background:#eee;padding:8px;border:1px solid #ccc">
GET / POST
~ <?=htmlentities(______UPLODY______SCRIPT______)?>?password=<b>123456789</b>&api_language=<b>en</b>&flag[]=<b>website_name</b>&delete=<b>true</b>
</pre>
</p>
<br><br>
<h6>by <a href="https://uplody.com">Mohammad Atwi | www.uplody.com</a></h6>
<br>
</body>
<?php
exit;
}

/***************************** API */

function saveAll($database, $alldata){
return file_put_contents($database, '<?php $_uplody_language_text= ' . var_export($alldata, true) . ';');
}

/******************************** ADD NEW TEXT ******************************/
if(isset($_REQUEST['delete']) && isset($_REQUEST['flag']) && isset($_REQUEST['single'])){
@include_once $database;
if(isset($_uplody_language_text[$_REQUEST['flag']])){
unset($_uplody_language_text[$_REQUEST['flag']]);
saveAll($database, $_uplody_language_text);
  }
header('Content-Type: application/json');
echo json_encode(['error' => true, 'message' => 'Invalid language code. Available languages: ' . implode(', ', array_keys($languages))]); exit;
}

if(isset($_REQUEST['api_language'])){
$apiLang = $_REQUEST['api_language'];

if(!in_array($_REQUEST['api_language'], array_keys($languages))){
$msg = json_encode(['error' => true, 'message' => 'Invalid language code. Available languages: ' . implode(', ', array_keys($languages))]);
}
else{

if(isset($_REQUEST['flag'])
&& (isset($_REQUEST['word']) || isset($_REQUEST['delete']))
&& is_array($_REQUEST['flag'])
&& (@is_array($_REQUEST['word']) || isset($_REQUEST['delete']))
&& sizeof($_REQUEST['flag']) > 0
&& (@sizeof($_REQUEST['word']) > 0 || isset($_REQUEST['delete']))
&& (sizeof($_REQUEST['flag']) == @sizeof($_REQUEST['word']) || isset($_REQUEST['delete']))
){

@include_once $database;

$added = 0;
foreach($_REQUEST['flag'] as $k => $wordFlag){
$word = @$_REQUEST['word'][$k];
//if(){
if(isset($_REQUEST['delete'])){
unset($_uplody_language_text[$wordFlag]);
}
else{
if(strlen($wordFlag) == 0){ $wordFlag = uniqid(); }
$_uplody_language_text[$wordFlag][$apiLang] = $word;
foreach($languages as $otherLang => $vl){ 
if(!isset($_uplody_language_text[$wordFlag][$otherLang]) && $apiLang !== $otherLang){
$_uplody_language_text[$wordFlag][$otherLang] = '';
  }
 }
}
$added++;
 // }
}

$newCount = sizeof($_uplody_language_text);

if(saveAll($database, $_uplody_language_text)){
$msg = json_encode(['error' => false, 'message' => 'Data was saved in: \'' . $database . '\' file - The updated database flags number is: ' . $newCount]);
}


}
else{
$msg = json_encode(['error' => true, 'message' => 'Invalid parameters. Required parameters: \'flag\' & \'word\' [Type: Array > 0] - Accepted as: GET & POST']);
}

}

if(isset($_REQUEST['ignoreAPI'])){
echo 'Modified: ' . $added . ' records. (You must refresh the page to see changes when using the GUI)';
}
else{
header('Content-Type: application/json');
echo $msg;
}

exit;
}

/***************************** API */


/**************** NORMAL SAVE */
if(isset($_REQUEST['uplody_t'])){
@include_once $database;
foreach($_REQUEST as $key => $word){
  foreach($languages as $langkey => $info){
  if(strpos($key, 'translate' . $postPrefix . $langkey . $postPrefix) === 0
  ){
  $wordInfo = explode($postPrefix, $key);
  $wordCode = $wordInfo[1];
  $wordFlag = $wordInfo[2];
  $_uplody_language_text[$wordFlag][$wordCode] = $word;
  }
 }
}

$alldata = $_uplody_language_text;
if(saveAll($database, $alldata)){
echo 'Saved: ' . sizeof($_uplody_language_text) . ' records.';
}
exit;
}

$isTableMode = isset($_GET['table']);

@include_once $database;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Uplody Translator v<?=htmlentities(______VERSION______)?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  *{box-shadow: none !important;}
  #filterall label{font-size: 15px;}
  #filterall textarea{height:50px;font-size: 15px;padding: 5px;}
  .xccc{width:100%;display: inline-block;background: white;padding: 5px;padding-top: 1px;margin-bottom: 5px;display:none;border-radius: 20px;}
  .xccc input{width: 100%;background: none;padding: 0;border: none !important;text-align: center;}
  .xccc input:focus{border: none !important;color:blue}
  .xccc input:focus, textarea:focus, select:focus{outline: none;}
  .sgh{position: relative; background: #eee;border-radius: 9px;}
  .sgh .del{position: absolute; top: -4px; right: -8px; font-size: 13px; background: red; width: 19px; text-align: center; border-radius: 50%; color: white;text-decoration: none;padding-left: 1px;display:none}
  <?php if(!$isTableMode){ ?>
  .sgh:hover .del{display:block}
  .sgh:hover .xccc{display:block}
  .res:hover .sgh { background: #99f96d; }
  <?php } ?>
  .scode{margin-bottom: 0px;margin-top: 11px;background: #ccc;padding: 7px;}
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="<?=htmlentities($scriptUrlPass)?>">Uplody Translator</a>

  <ul class="navbar-nav">
  <li class="nav-item">     </li>
  <li class="nav-item"><a class="nav-link" href="./<?=htmlentities($scriptUrl)?>">Editor Mode</a></li>
  <li class="nav-item">     </li>
  <li class="nav-item"><a class="nav-link" href="./<?=htmlentities($scriptUrl)?>&table=yes">Table Mode</a></li>
  <li class="nav-item">     </li>
  <li class="nav-item"><a class="nav-link" href="./<?=htmlentities($scriptUrl)?>&help=yes#api">API</a></li>
  <li class="nav-item">     </li>
  <li class="nav-item"><a class="nav-link" href="./<?=htmlentities($scriptUrl)?>&help=yes">Help</a></li>
  <li class="nav-item">     </li>
  <li class="nav-item"><a class="nav-link" href="./<?=htmlentities($scriptName)?>">Logout</a></li>
  </ul>

</nav>

<div class="container col-md-12" style="margin-top:30px">
<form id="_save_" method="post" action="<?=$scriptUrl?>">
  <input value="1" type="hidden" name="uplody_t">
  <div class="row" id="filterall">
  <div class="col-md-12">
  <div class="col-md-12 mb-4">
  <div class="row">
  <div class="col-md-2">
  <select id="tp" class="form-control">
  <?= str_replace('data-select-'.$language, 'selected="selected"', $langs) ?>
  </select>
  </div>
  <div class="col-md-9">
  <input id="filter" placeholder="Search: words -or- flag:my_flag" class="form-control text-center">
  </div>
  <div class="col-md-1">
  <button class="btn btn-info" type="button" data-toggle="modal" data-target="#add-text" style="width:100%">Add</button>
  </div>
  <div class="col-md-12"><br><hr></div>
  </div>
  </div>
  </div>
    <?php 
    $isTableMode ? $wordsPerRow = 6 : '';
    if(isset($_uplody_language_text) && is_array($_uplody_language_text) && sizeof($_uplody_language_text) > 0){
    foreach($_uplody_language_text as $flag => $word){
    ?>
    <div data-id="r-<?=htmlentities($flag)?>" class="col-md-<?=htmlentities($wordsPerRow)?> res">
    <div class="col-md-12">
    <div class="p-3 pb-3 sgh">
    <a class="del" data-flag="<?=htmlentities($flag)?>" href="#!">&#10005;</a>
    <span class="xccc"><input class="txt2" onclick="select()" value="<?=htmlentities($flag)?>"></span>
    <?php 
    $c = 0;
    if($isTableMode){ echo '<table class="table"><thead><th>Lang</th><th>Flag</th><th>Text</th></thead><tbody>'; }
    foreach($languages as $lng => $value){
    if(isset($word[$lng])){ 
    $value = $word[$lng];
    if(!$isTableMode){
    ?>
    <label class="text-<?=htmlentities($languages[$lng][2])?>" 
    data-lang="<?=htmlentities($lng)?>" 
    style="width:100%" dir="<?=htmlentities($languages[$lng][1])?>"><?=htmlentities($languages[$lng][0])?></label>
    <textarea name="translate<?=$postPrefix?><?=htmlentities($lng)?><?=$postPrefix?><?=htmlentities($flag)?>" class="form-control txt text-<?=htmlentities($languages[$lng][2])?>" dir="<?=htmlentities($languages[$lng][1])?>"><?=htmlentities(@$value)?></textarea>
    <?= $c == (sizeof($languages)-1) ? '' : '<br>'?>
    <?php 
    }
    else { 
    ?>
    <tr>
    <td><?=htmlentities($lng)?></td>
    <td>
    <input onclick="select()" readonly="" class="form-control txt txt2" value="&lt;?= $data['<?=htmlentities($flag)?>'] ?&gt;">
    </td>
    <td><input onclick="select()" readonly="" value="<?=htmlentities(@$value)?>" class="form-control txt txt2"></td>
    </tr>
    <?php
    }
      }
    $c++;
    }
    if($isTableMode){ echo '</tbody></table>'; }

    ?>

    </div>
    <br>
    </div>
    </div>
    <?php 
      } 
    }
    else{
    echo ' <div class="col-md-12"><div class="col-md-12">No data yet, please add some.</div></div>';
    } 
    ?>
  </div>
  <div class="row mt-5">
  <div class="col-md-12 mt-5">
  <br>
  <br>
  <br>
  <br>
  <?php if(!$isTableMode){ ?>
  <button id="_btn_" class="btn btn-success" style="position:fixed;bottom:30px;right:30px" type="submit">Save</button>
  <?php } ?>
  </div>
  </div>
  </form>
</div>

<div class="modal" id="add-text">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Text</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form id="_save_api_" method="post" action="<?=$scriptUrl?>&ignoreAPI">
      <input type="hidden" name="api_language" value="<?=htmlentities($language)?>">
      <div class="row">
      <div class="col-md-12 mb-2">
      <label>Flag (must be unique) - Leave empty for random flag</label>
      <input class="form-control" name="flag[]" placeholder="Flag">
      </div>
      <div class="col-md-12 mb-3">
      <label>Text</label>
      <textarea class="form-control" name="word[]" placeholder="Text"></textarea>
      </div>
      <div class="col-md-12 mb-2">
      <button class="btn btn-primary" id="_btn_2" style="width:100%">Save</button>
      <h6 class="mt-3"><small>* This form is based on the script <a href="<?=$scriptUrl?>&help=yes#api">API</a> - you can make your own multiple form version.</small></h6>
      </div>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

<script>
$("#tp").on("change", function() {
window.location.href = './<?=$scriptUrlPass?>&language=' + this.value
});

$(document).on("click", ".del", function(e){
e.preventDefault();
var flag = $(this).data('flag');
if(confirm("Delete this record? (in all languages)")){
$.post("<?=$scriptUrl?>", {'flag': flag, 'delete': true, 'single': true}, function(res){
console.log('Uplody Translator ~ Target: ' + flag + ' ~ Delete Response: ' + res);
});
$('[data-id="r-'+flag+'"]').remove();
}
});

$(document).ready(function(){
  $("#filter").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    if(value.indexOf('flag:') > -1){
    var sel = '.txt2';
    var tp = 'f';
    value = value.replace('flag:', '');
     }
    else{
    var sel = '.txt,.txt2';    
    var tp = 'w';
     }
    $("#filterall .res").filter(function() {
    var th = this;
    var counter = 0;
    $(sel, th).each(function(){
    var txt = this.value;
    if(tp == 'w'){
    $(th).toggle(txt.toLowerCase().indexOf(value) > -1);
    if(txt.toLowerCase().indexOf(value) > -1){ return false; }
    }
    else{
    $(th).toggle(txt.toLowerCase() == value);
    if(txt.toLowerCase() == value){ return false; }
    }

    });       
    });
  });
});

$(document).on('submit', '#_save_', function(e){
e.preventDefault();
var form = $(this);
var url = form.attr('action');
$('#_btn_').attr('disabled', true).text('...');
$.ajax({
  type: "POST",
  url: url,
  data: form.serialize(),
  success: function(data){
  alert(data);
  $('#_btn_').removeAttr('disabled').text('Save');
  }
 });
});

$(document).on('submit', '#_save_api_', function(e){
e.preventDefault();
var form = $(this);
var url = form.attr('action');
$('#_btn_2').attr('disabled', true).text('...');
$.ajax({
  type: "POST",
  url: url,
  data: form.serialize(),
  success: function(data){
  alert(data);
  $('#_btn_2').removeAttr('disabled').text('Save');
  }
 });
});
</script>
</body>
</html>
<?php 
}
______________uplodyTranslatorGUI(); 

skip______UT______GUI:
?>
