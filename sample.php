<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>Sistema Integral xxx</title>
<link href="css/css/dailog.css" rel="stylesheet" type="text/css" />
    <link href="css/css/calendar.css" rel="stylesheet" type="text/css" /> 
    <link href="css/css/dp.css" rel="stylesheet" type="text/css" />   
    <link href="css/css/alert.css" rel="stylesheet" type="text/css" /> 
    <link href="css/css/main.css" rel="stylesheet" type="text/css" /> 
    

    <script src="src/jquery.js" type="text/javascript"></script>  
    
    <script src="src/Plugins/Common.js" type="text/javascript"></script>    
    <script src="src/Plugins/datepicker_lang_US.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>

    <script src="src/Plugins/jquery.alert.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
    <script src="src/Plugins/wdCalendar_lang_US.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.calendar.js" type="text/javascript"></script>   
    
    <script type="text/javascript">
        $(document).ready(function() {     
           var view="week";          
           
            var DATA_FEED_URL = "php/datafeed.php";
            var op = {
                view: view,
                theme:3,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,    
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror, 
                autoload:true,
                url: DATA_FEED_URL + "?method=list",  
                quickAddUrl: DATA_FEED_URL + "?method=add", 
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"        
            };
            var $dv = $("#calhead");
            var _MH = document.documentElement.clientHeight;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];

            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar").noSelect();
            
            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){                          
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     } 
            });
            function cal_beforerequest(type)
            {
                var t="Cargando datos ...";
                switch(type)
                {
                    case 1:
                        t="Cargando datos ...";
                        break;
                    case 2:                      
                    case 3:  
                    case 4:    
                        t="La petición está en proceso ...";                                   
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();    
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("Success!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }              
               
            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    OpenModelWindow(url,{ width: 600, height: 600, caption:"CRM" ,onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }    
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                alert(str);               
            }    
            function Delete(data,callback)
            {           
                
                $.alerts.okButton="Ok";  
                $.alerts.cancelButton="Cancel";  
                hiConfirm("Está seguro de eliminar este evento", 'Confirmar',function(r){ r && callback(0);});           
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
                
            });
            
            //Add a new event
            $("#faddbtn").click(function(e) {
                var url ="../edit.php";
                OpenModelWindow(url,{ width: 600, height: 600, caption: "Crear nuevo calendario"});
            });
            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
        });
    </script>    
</head>
<body>
    <div>

      <div id="calhead" style="padding-left:1px;padding-right:1px;">          
            <div class="cHead"><div class="ftitle">CRM</div>
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Cargando Datos...</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Lo siento, no se pudo cargar sus datos, por favor intente más tarde</div>
            </div>          
            
            <div id="caltoolbar" class="ctoolbar">
              <div class="fbutton">
                  <div><a href="../sample.php" target="_blank" id="services" class="top_link"> <span title='Click para ver el calendario en pantalla completa' class="addcal">

                Pantalla Completa             
                </span></a></div>
            </div>
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='Haga clic aquí para volver a hoy ' class="showtoday">
                Hoy</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
                <div><span title='Dia' class="showdayview">Dia</span></div>
            </div>
              <div  id="showweekbtn" class="fbutton fcurrent">
                <div><span title='Semana' class="showweekview">Semana</span></div>
            </div>
              <div  id="showmonthbtn" class="fbutton">
                <div><span title='Mes' class="showmonthview">Mes</span></div>

            </div>
            <div class="btnseparator"></div>
              <div  id="showreflashbtn" class="fbutton">
                <div><span title='Actualizar' class="showdayflash">Actualizar</span></div>
                </div>
             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="Anterior"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="Siguiente" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">Cargando</span>

                    </div>
                
            </div>
             <div class="btnseparator"></div>
             <div  id="" class="fbutton">
                <div><span title='Morado: Indica todas las actividades' class="morado"><font color="black">Actividad</font></span></div>
                </div>
             <div class="btnseparator"></div>
             <div  id="" class="fbutton">
                <div><span title='Verde: Indica todas  las Llamadas' class="verde"><font color="black">Llamada</font></span></div>
                </div>
             <div class="btnseparator"></div>
             <div  id="" class="fbutton">
                <div><span title='Naranja: Indica todas las Reuniones' class="naranja"><font color="black">Reunión</font></span></div>
                </div>
            
             <div class="btnseparator"></div>
         
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:1px;">

        <div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor">
            &nbsp;</div>
        <div id="dvCalMain" class="calmain printborder">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <div class="t2 chromeColor">

            &nbsp;</div>
        <div class="t1 chromeColor">
            &nbsp;
        </div>   
        </div>
     
  </div>
    
</body>
</html>
<?php
