<?php
/**
 * @version 1.0 2018-08-24
 * @copyright Jorge castro C.
 */
define('MVCONE_NAMESPACEBASE','base'); //todo: we should configure those variables.
define('MVCONE_NOSESSION',false); //todo: we should configure those variables.
define('MVCONE_DEFAULTCONTROLLER','home');  //todo: we should configure those variables.
define('MVCONE_DEFAULTACTION','index');  //todo: we should configure those variables.

if (!MVCONE_NOSESSION) @session_start();

include __DIR__."/app_start/App.php";

$app=new App(); // or you could use AppStatic::example();

// todo: here we should do the includes and to read and write the session.
include __DIR__."/controller/HomeController.php"; // todo: its an example

// why we are closing it? It's because, the session locks a session file.
// , so every concurrent call (using the same session) is pooled.
if (!MVCONE_NOSESSION) session_write_close();

$controller=@$_GET['_controller'];
$controller=(!ctype_alnum($controller))?MVCONE_DEFAULTCONTROLLER:$controller;
$op=MVCONE_NAMESPACEBASE.'\\controller\\'.$controller."Controller";
$action=@$_REQUEST['_action'];
$action=(!ctype_alnum($action))?MVCONE_DEFAULTACTION:$action; // the default action is Index.
$event=request('_event');
$id=request('_id');
if (empty($event) && empty($id)) {
    $event_id=request('_event_id',null);
    if ($event_id===null) {
        // event id is not defined, id is not defined and event_id is not defined, then we use default values
        $event='';
        $id=0;
    } else {
        // event_id is defined.
        $arr=explode('_',$event_id.'_');
        $event=$arr[0];
        $id=$arr[1];
    }
}

$idparent=request('_idparent',"");
$idref=request('_idref',""); // reference. it could be used globally.

if ($controller=="") {
    echo "No operation defined";
}

function request($id,$default=null) {
    return isset($_POST[$id])?$_POST[$id]:(isset($_GET[$id])?$_GET[$id]:$default);
}

if (!class_exists($op)) {
    throw new Exception("incorrect operator [$controller] ");
}
$controller = new $op();
$action2=$action."Action";
if (method_exists($controller,$action2)) {
    $controller->{$action2}($event, $id, $idparent);
} else {
    throw new Exception("incorrect action [$action] for [$controller]");

}




