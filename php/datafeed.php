<?php
include_once("dbconfig.php");
include_once("functions.php");
session_start();
function addCalendar($st, $et, $sub, $ade){
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s',time() - 3600*date('I'));
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
     $tarea='Tarea';
    $date = date("Y-m-d").' '.$hora;
    $registro= $date.' por '.$_SESSION['k_username'];
    $sql = "insert into `actividades` (`subject`, `starttime`, `endtime`, `isalldayevent`, `user`, `tarea`, `fecha_reg_ta`, `fecha_mod_ta`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($_SESSION['k_username'])."', '"
      .mysql_real_escape_string($tarea)."', '"
      .mysql_real_escape_string($registro)."', '"
      .mysql_real_escape_string($registro)."')";
    //echo($sql);
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Agregado con Exito';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


function addDetailedCalendar($st, $et, $con, $emp, $sub, $ade, $dscr, $loc, $est, $user, $dur, $ta){
    
     date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i',time() - 3600*date('I'));
  $ret = array();
  
  try{
    $db = new DBConnection();
    $db->getConnection();
    $date = date("Y-m-d").' '.$hora;
    $registro= $date.' por '.$_SESSION['k_username'];
    if($_POST['options']=='Actividad'){
        $color="-5";
    }
    if($_POST['options']=='Reunion'){
        $color="12";
    }
    if($_POST['options']=='Llamada'){
        $color="9";
    }
    
    
    $sql = "insert into `actividades` (`id_contacto`, `id_empresa`, `subject`, `starttime`, `endtime`, `isalldayevent`, `description`, `location`, `color`, `estado`, `user`, `duracion`, `tarea`, `fecha_reg_ta`, `fecha_mod_ta`) values ('"
      .mysql_real_escape_string($con)."', '"
      .mysql_real_escape_string($emp)."', '"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($color)."', '"
      .mysql_real_escape_string($est)."', '"
      .mysql_real_escape_string($user)."', '"
      .mysql_real_escape_string($dur)."', '"
      .mysql_real_escape_string($ta)."', '"
      .mysql_real_escape_string($registro)."', '"
      .mysql_real_escape_string($registro)."')";
    //echo($sql);
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Agregado con Exito';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
  
}

function listCalendarByRange($sd, $ed){
  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2JsTime($sd);
  $ret["end"] = php2JsTime($ed);
  $ret['error'] = null;
  try{
    $db = new DBConnection();
    $db->getConnection();
    if($_SESSION['k_username']=='admin'){
       
       $sql = "select * from `actividades` where `starttime` between '"
    
      .php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'"; 
    }else{
    $sql = "select * from `actividades` where user='".$_SESSION['k_username']."' and `starttime` between '"
    
      .php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'";
    }
    if(isset($_POST['mostrar'])){
        $sql = "select * from `actividades` where user='".$_POST['mostrar']."' and `starttime` between '"
    
      .php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'";
    }
    $handle = mysql_query($sql);
    //echo $sql;
    while ($row = mysql_fetch_object($handle)) {
      if($row->estado != 'Completada' && $row->tarea != 'Visita'){
      $ret['events'][] = array(
        $row->Id,
        $row->Subject,
        php2JsTime(mySql2PhpTime($row->StartTime)),
        php2JsTime(mySql2PhpTime($row->EndTime)),
        $row->IsAllDayEvent,
        0, //more than one day event
        
        0,//Recurring event,
        $row->Color,
        1,//editable
        $row->Location, 
        
        $row->Description,
        ''//$attends
      );
    }}
	}catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
  //echo $st . "--" . $et;
  return listCalendarByRange($st, $et);
}

function updateCalendar($id, $st, $et){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update `actividades` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "' "
      . "where `Id`=" . $id;
    //echo $sql;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function updateDetailedCalendar($id, $st, $et, $sub, $con, $emp, $user, $est, $ade, $dscr, $loc, $tz){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update `actividades` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "', "
      . " `subject`='" . mysql_real_escape_string($sub) . "', "
      . " `id_contacto`='" . mysql_real_escape_string($con) . "', "
      . " `id_empresa`='" . mysql_real_escape_string($emp) . "', "
      . " `user`='" . mysql_real_escape_string($user) . "', "
      . " `estado`='" . mysql_real_escape_string($est) . "', "
      . " `isalldayevent`='" . mysql_real_escape_string($ade) . "', "
      . " `description`='" . mysql_real_escape_string($dscr) . "', "
      . " `location`='" . mysql_real_escape_string($loc) . "' "

      . "where `id`=" . $id;
    //echo $sql;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function removeCalendar($id){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "delete from `actividades` where `Id`=" . $id;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}




header('Content-type:text/javascript;charset=UTF-8');
$method = $_GET["method"];
switch ($method) {
    case "add":
        $ret = addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"]);
        break;
    case "list":
        $ret = listCalendar($_POST["showdate"], $_POST["viewtype"]);
        break;
    case "update":
        $ret = updateCalendar($_POST["calendarId"], $_POST["CalendarStartTime"], $_POST["CalendarEndTime"]);
        break; 
    case "remove":
        $ret = removeCalendar( $_POST["calendarId"]);
        break;
    case "adddetails":
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if(isset($_GET["id"])){
            $ret = updateDetailedCalendar($_GET["id"], $st, $et, 
                $_POST["Subject"], $_POST["contacto"], $_POST["empresa"], $_POST["user"], $_POST["estado"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["timezone"]);
        }else{
            if($st > $et){ $ret['Msg'] = 'La Fecha Inicial es Mayor que la Fecha Final';}else{
            $ret = addDetailedCalendar($st, $et,                    
                $_POST["contacto"], $_POST["empresa"], $_POST["Subject"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["estado"], $_POST["user"], $_POST["duracion"], $_POST["options"], $_POST["timezone"]);
        } }       
        break; 


}
echo json_encode($ret); 



?>