//UMS framework with jQuery
$(document).ready(function(){
var lastHash = location.hash;

//Routes
if(location.hash)
{
	Routes(location.hash);
}
//Dashboard
if($('#main_content').length)
{
  if(!localStorage.getItem("token")) 
  {
    loadLogin('index');
  } 
  else 
  {
    loadDashboard(localStorage.getItem("token"));  
  }
}
$(window).bind('hashchange', function() {
	if(location.hash)
	{
		hash=location.hash;
		var rL = lastHash.split(':');
		var rh = hash.split(':');
		if(rh[0]=='#dashboard' && (rh[2] && rh[0]==rL[0] && rh[1]==rL[1]))
		{
			ShowTab('#'+rh[2]);
		}
		else
		{
			Routes(location.hash);
		}
	}
	lastHash = hash;
});
 //SCROLLTOP
$('.scrolltop.collapsed').on('click', function (e){
   		e.preventDefault();
   		$(this).animatescroll();
	});
$('a[href="#"]').on('click', function (e){
	e.preventDefault();
});
$('a[action="tab"]').on('click', function (e){
	e.preventDefault();
	ShowTab($(this).attr('data-target'));
});
$('[data-hash]').on('click', function (e) {
  e.preventDefault();
  $(this).hashchange('click');
});
//comentarios
$('.btn-expand').on("click", function (e){
  var expand = $(this).parent(".comment").find(".expand");
  $(expand).toggleClass("in", 1000, "swing");
   var html = $(this).html();
    $(this).html(
        html == '<i class="fa fa-angle-up"></i> Contraer' ? '<i class="fa fa-angle-down"></i> Expandir' : '<i class="fa fa-angle-up"></i> Contraer');
e.preventDefault();
});
});




function ShowPanel(panelid)
{
  $('.sidebar-nav>li>a').removeClass('active');
  $('a[data-target="'+panelid+'"]').addClass('active');
	$('#main_content div').slideUp('fast', "linear", function(){
		$(this).remove();
	});
	$('#main_content').append($(panelid).html());
	$('#main_content').find('table.datatables').DataTables();
	
	//DataTables(tables);
	
}
function ShowTab(tabid)
{
	$('.nav-tabs a[data-target="'+tabid+'"]').tab('show');
}
function Routes(hash)
{
	var routes = hash.split(':');
	if(routes[0]=='#ums')
	{
		umsRoutes(routes);
	}
	if(routes[0]=='#app')
	{
		appRoutes(routes);
	}
	if(routes[0]=='#dashboard')
	{
		dashboardRoutes(routes);
	}	
}
function appRoutes(route)
{
    if(route[1]=='close')
    {
        if($('body').hasClass('profile'))
        {
          	$('body.profile').toggleClass('profile');
        		$('.profile.sidebar-content').animate({'margin-left':'600px'}, 200, function(){
          		$('.wrapper.profile').toggleClass('open');
          		$('.wrapper.profile').toggleClass('bg');
          		$('.profile.sidebar-content').css('margin-left','0');
        	});
        }
        else
        {
         	$('.row-offcanvas-right').removeClass('active');
        }
    }
    else if(route[1]=='login')
    {

    }
    else
    {
    	if($(document).width()<=750 && !$('.row-offcanvas-right').hasClass('active'))
    	{
				$('.row-offcanvas-right').toggleClass('active');
    	}
    	else if($(document).width()>=751 && !$('body').hasClass('profile'))
    	{
    			$('body').toggleClass('profile');
          			$('.wrapper.profile').toggleClass('open');
          			$('.profile.sidebar-content').css('margin-left','600px');
            		$('.profile.sidebar-content').animate({'margin-left':'0'},300, function(){
            		$('.wrapper.profile').toggleClass('bg');
          		});
    	}
      if(route[1]=='settings')
      {
        if($("#app"+route[2]).hasClass('active'))
        {
          $('#app'+route[2]).removeClass('active');
        }
        else
        {
          $('<a data-target="#app'+route[2]+'"></a>').tab('show');
        }
      }

    	if(route[1]=='content')
      {
        $('a[data-target="#app'+route[2]+'"]').tab('show');
      }
      
    }
/*    if(action[1]=='login')
    {
    	if(action[2]=='facebook')
        {
         	FB.login(function(response) {
            	if (response.status === 'connected') 
            	{
              		FB.api('/me?fields=id,name,email', function(response) {
                		console.log('Successful login for: ' + response.name + '('+response.id+')  email: '+ response.email);
              		});
            	}
            	else 
            	{
              		console.log('Fail login');
            	}  
          	},{scope: 'email'});
        }
    }
*/
}
function dashboardRoutes (routes)
{
  console.log(routes[1]);
  if(routes[1]!='logout')
  {
    ShowPanel('#'+routes[1]);
    if(routes[2])
    {
      ShowTab('#'+routes[2]);
    }
  }
  else
  {
    location.hash="#";
    localStorage.removeItem("token");
    loadLogin();
  }
	
}
function umsRoutes (routes)
{	
	action = routes[1];
	actionid=routes[2];

	if(action=='tab')
	{
		if($('.nav-tabs a[data-target="#'+actionid+'"]').length > 0)
		{
			$('.nav-tabs a[data-target="#'+actionid+'"]').tab('show').animatescroll();
		}
		else
		{
			$('#'+formid).animatescroll();
		}
	}

}

function DataTables ()
{
   
	$(this).DataTable({
      "scrollX": true,
      "order": [[ 1, "desc" ]],
      "sPaginationType": "full_numbers", "aLengthMenu": [5, 10, 25], "iDisplayLength": 5,
      
      "oLanguage": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "",
    "sSearchPlaceholder": "Buscar...",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     ">",
        "sPrevious": "<"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
            }

    });
}

$.fn.DataTables = function ()
{
	
	$(this).DataTable({
		"responsive": true,
      "order": [[ 1, "desc" ]],
      "sPaginationType": "full_numbers", "aLengthMenu": [5, 10, 25], "iDisplayLength": 5,
      
      "oLanguage": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "",
    "sSearchPlaceholder": "Buscar...",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     ">",
        "sPrevious": "<"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
            }

    });
}
$.fn.hashchange = function (click)
{
	if('#'+$(this).attr('data-hash') != location.hash)
	{
    location.hash=$(this).attr('data-hash');
  }
  else if(click=='click')
  {
    Routes(location.hash);
  }
}

$.fn.animatescroll = function ()
{
	$('html, body').stop().animate({'scrollTop':$(this).offset().top},900,'swing')
}
$.fn.Login = function() 
{
  $(this).on("submit", function(event) {
    event.preventDefault();
    //Elementos del formulario
    var status = [];
    var inputWarning = null;
    autologin=$(this).find('input[name="autologin"]').val();
    result=$(this).find('div.response');
    btncontrol=$(this).find('button[type="submit"]');
    progress=$(this).find('.progress');
    progressbar=$(this).find('.progress-bar');
    //Inputs de los formularios para verificar si existen y si son correctas
    $($(this).find('input,textarea,select')).each(function(){
      $(this).parent().parent().removeClass('has-error');
        if($(this).is(':disabled')){}
        else 
        {
          if($(this).attr('type')!='checkbox'){
            status[$(this).attr('name')]=Checkinputs($(this),Validations($(this).attr('name')));


            if($(this).attr('type')!='hidden' && status[$(this).attr('name')]!='valid'){
              $(this).parent().parent().addClass('has-error');
              inputWarning++;
            } 
          }
        }
    }); 
    if(inputWarning){
      $(result).empty().append(Feedback(status));
    }
    else
    {
      var form = new FormData($(this)[0]);
      
      //Envio del formulario con AJAX
        $.ajax({
            type: "POST",
            url: "ums/admin/login.php",
            dataType: "json",
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                $(progressbar).html(Math.round(percentComplete * 100) + "%");
                $(progressbar).width(Math.round(percentComplete * 100)+ "%");
                console.log(percentComplete);
                }
                }, false);
            return xhr;
            },
            beforeSend: function(){
              $(btncontrol).append(' <i class="fa fa-cog fa-spin"></i>').attr("disabled","disabled");
            },
            success: function(data){
                if(data.token === undefined)
                {
                  $(result).empty().append(FeedbackAlert(data.alert)); 
                }
                else
                {
                  if(autologin=='on')
                  {
                    localStorage.setItem("token", data.token);
                  }
                  loadDashboard(data.token);
                }  
            },
            error: function(){ 
              $(result).empty().append(FeedbackAlert({'error':'El servidor no responde.'})); 
            },
            complete: function(data){
              $(progressbar).width(0);
              $(btncontrol).find('i.fa-spin').remove();
              $(btncontrol).removeAttr("disabled");
            }
         });
    }
  });
}
function loadLogin(options)
{
  if(options=='index')
  {
    $('#main_content').append('<div class="col-sm-8 col-md-6 col-lg-4 col-md-push-2 col-lg-push-3 col-xs-12 xxs-nopadding">          <div class="site-wrapper"><div class="site-wrapper-inner">          <div class="form-group text-center">            <img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png">          </div>          <form class="form col-xs-12 xxs-nopadding" role="form" action="#" method="POST" id="login_form">           <div class="progress">              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            </div>            <input type="hidden" name="formid" value="app_settings-login">            <input type="hidden" name="formtype" value="login">            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-at"></i></span>                <input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">              </div>            </div>            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>                <input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">              </div>            </div>            <div class="form-group col-xs-12">              <label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>            </div>            <div class="form-group col-xs-12 response"></div>              <div class="form-group col-xs-12">                <button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>              </div>          </form>          </div></div>        </div>').find('.form').Login();
  }
  else
  {
    $('#sidebar-offcanvas-left>nav, #sidebar-offcanvas-right>nav').animate({'width':'0'}, 200, function(){
      $('#navbar>nav').animate({'height':'0'}, 200, function(){
        $(this).remove();
        if($('#main_content>div').length)
        {
          $('#main_content>div').slideUp('fast', "linear", function(){
          $(this).remove();
          $('#main_content').append('<div class="col-sm-8 col-md-6 col-lg-4 col-md-push-2 col-lg-push-3 col-xs-12 xxs-nopadding">          <div class="site-wrapper"><div class="site-wrapper-inner">          <div class="form-group text-center">            <img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png">          </div>          <form class="form col-xs-12 xxs-nopadding" role="form" action="#" method="POST" id="login_form">           <div class="progress">              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            </div>            <input type="hidden" name="formid" value="app_settings-login">            <input type="hidden" name="formtype" value="login">            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-at"></i></span>                <input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">              </div>            </div>            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>                <input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">              </div>            </div>            <div class="form-group col-xs-12">              <label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>            </div>            <div class="form-group col-xs-12 response"></div>              <div class="form-group col-xs-12">                <button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>              </div>          </form>          </div></div>        </div>').find('.form').Forms();
          });
        }
        else
        {
          $('#main_content').append('<div class="col-sm-8 col-md-6 col-lg-4 col-md-push-2 col-lg-push-3 col-xs-12 xxs-nopadding">          <div class="site-wrapper"><div class="site-wrapper-inner">          <div class="form-group text-center">            <img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png">          </div>          <form class="form col-xs-12 xxs-nopadding" role="form" action="#" method="POST" id="login_form">           <div class="progress">              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            </div>            <input type="hidden" name="formid" value="app_settings-login">            <input type="hidden" name="formtype" value="login">            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-at"></i></span>                <input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">              </div>            </div>            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>                <input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">              </div>            </div>            <div class="form-group col-xs-12">              <label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>            </div>            <div class="form-group col-xs-12 response"></div>              <div class="form-group col-xs-12">                <button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>              </div>          </form>          </div></div>        </div>').find('.form').Login();
        }  
      });
      $(this).remove();
    });
  }
}
function loadDashboard()
{
  $('#main_content>div').slideUp('fast', "linear", function(){
    $(this).remove();
  });
  $('#main_content').append('<div class="col-xs-12"><h1>Contenido principal</h1></div>');
  $('#sidebar-offcanvas-right').append('<nav class="sidebar sidebar-offcanvas-right">      <ul class="nav sidebar-nav">        <li><a href="#" data-content="#profile" data-target="#profile-home" data-hash="dashboard:profile:profile-home"><i class="fa fa-globe"></i> coleccionotrosmundos.org</a></li>                <li><a href="#" data-content="#profile" data-target="#profile-messages" data-hash="dashboard:profile:profile-messages"><img src="img/img_logo_pyb.png"> PitbullsAndBullys</a></li>                <li><a href="#" data-content="#profile" data-target="#profile-comments" data-hash="dashboard:profile:profile-comments"><img src="http://www.librosyrevistas.org/img/favicon.png"> Libros y Revistas</a></li>        <li role="separator" class="divider"></li>        <li><a href="#" data-content="#profile" data-target="#profile-config" data-hash="dashboard:profile:profile-config"><i class="fa fa-cog"></i> Preferencias</a></li>        <li role="separator" class="divider"></li>        <li><a href="#" data-hash="dashboard:logout"><i class="fa fa-sign-out"></i> Salir</a></li>      </ul>    </nav>');
  $('#sidebar-offcanvas-left').append('<nav class="sidebar sidebar-offcanvas-left">      <ul class="nav sidebar-nav">        <li class="">            <a href="#" data-target="#dashboard" data-hash="dashboard:dashboard"><span class="icon"><i class="fa fa-globe"></i></span> Dashboard</a>        </li>        <li class="">            <a href="#" data-target="#users" data-hash="dashboard:users"><span class="icon"><i class="fa fa-users"></i></span> Usuarios</a>        </li>        <li class="">            <a href="#" data-target="#messages" data-hash="dashboard:messages"><span class="icon"><i class="fa fa-envelope"></i></span> Mensajes</a>        </li>        <li class="">            <a href="#" data-content="#comments" data-hash="dashboard:comments"><span class="icon"><i class="fa fa-commenting"></i></span> Comentarios </a>        </li>        <li class="#">            <a href=""><span class="icon"><i class="fa fa-list-alt"></i></span> Encuestas </a>        </li>        <li class="#">            <a href="#"><span class="icon"><i class="fa fa-newspaper-o"></i></span> Clasificados </a>        </li>      </ul>    </nav>');
  $('#navbar').append('<nav class="navbar navbar-inverse navbar-static-top">    <div class="container-fluid">      <div class="navbar-header">        <button type="button" class="navbar-toggle collapsed pull-left" data-offcanvas="offcanvas-left">          <i class="fa fa-bars fa-2x"></i>        </button>        <a class="navbar-brand" href="http://ums.hostingmex.com.mx/"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web"></a>        <button type="button" class="navbar-toggle collapsed pull-right" data-offcanvas="offcanvas-right">          <img src="img/pic.jpg" class="img-rounded">        </button>      </div>      <div class="navbar-collapse collapse">        <ul class="nav navbar-nav navbar-right">          <li><a href="#"><i class="fa fa-envelope"></i></a></li>          <li>            <a href="#" class="dropdown-toggle img-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><img src="img/pic.jpg" class="img-rounded"> Nebur Oirad <span class="caret"></span></a>              <ul class="dropdown-menu sidebar-right">                <li><a href="#" data-content="#profile" data-target="#profile-home" data-hash="dashboard:profile:profile-home"><i class="fa fa-user"></i> Mi Perfil</a></li>                <li><a href="#" data-content="#profile" data-target="#profile-messages" data-hash="dashboard:profile:profile-messages"><i class="fa fa-envelope"></i> Mensajes</a></li>                <li><a href="#" data-content="#profile" data-target="#profile-comments" data-hash="dashboard:profile:profile-comments"><i class="fa fa-commenting"></i> Comentarios</a></li>                <li role="separator" class="divider"></li>                <li><a href="#" data-content="#profile" data-target="#profile-config" data-hash="dashboard:profile:profile-config"><i class="fa fa-cog"></i> Preferencias</a></li>                <li role="separator" class="divider"></li>                <li><a href="#" data-hash="dashboard:logout"><i class="fa fa-sign-out"></i> Salir</a></li>              </ul>          </li>        </ul>       </div>    </div>  </nav>');
  //OFFCANVAS
$('[data-offcanvas="offcanvas-right"]').click(function () {
    $('.row-offcanvas-right').toggleClass('active');
});
$('[data-offcanvas="offcanvas-left"]').click(function () {
    $('.row-offcanvas-left').toggleClass('active');
});
$('[data-hash]').on('click', function (e) {
  e.preventDefault();
  $(this).hashchange('click');
});
//MENU
var sidebar_left = $('.sidebar-offcanvas-left').find('a');
var sidebar_right = $('.sidebar-offcanvas-right').find('a');

  $(sidebar_left).each(function(){
      $(this).on('click', function(){
        $('.row-offcanvas-left').removeClass('active');
      });
    
  });
  $(sidebar_right).each(function(){
      $(this).on('click', function(){
        $('.row-offcanvas-right').removeClass('active');
      });
    
  });
}
function Feedback(feedback)
{
  var inputWarning = null;
  var textWarning = "";
  if(feedback['alert'])
  {
    htmlalert=FeedbackAlert(feedback['alert']);
  }
  else
  {
    for (var key in feedback) {
      if(key!='button' && key!='alert'){
        if(feedback[key]!='valid' && feedback[key]!='norequired') {
          inputWarning++;

          if(inputWarning>1)
          {
            textWarning = textWarning + ', ';
          }
          textWarning = textWarning + Validations(key)['display'];
        }
      }
    }
    if(inputWarning>0)
    {

      htmlalert=FeedbackAlert({'warning':'Los siguientes campos son incorrectos: ' + textWarning});
    }
  }

  return htmlalert;
}
function FeedbackAlert(alert)
{
  for (var key in alert) {
    if(key=='warning')
    {
      htmlalert='<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> Error ! </b> '+alert[key]+'</div>';
    }
    if(key=='error')
    {
      htmlalert='<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> Error ! </b> '+alert[key]+'</div>';
    }
    if(key=='success')
    {
      htmlalert='<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> OK ! </b> '+alert[key]+'</div>';
    }
  }
  return htmlalert;
}
function Validations(input)
{
  var validations = {
        display:input, 
        pregmatch:/^[a-zA-Z0-9 áéíóúüñÁÉÍÓÚÜÑ]*$/, 
        minlength:4,
        maxlength:64,
        required:true
      };
  if(input == 'formid' ||
     input == 'formtype' ||
     input == 'callback')
  {
    validations['pregmatch']=/^[\w.-]+$/;
  }
  if(input == 'name' ||
     input == 'username')
  {
    validations['display']='Nombre';
  }
  if(input == 'email' ||
     input == 'useremail')
  {
    validations['display']='Correo';
    validations['pregmatch']=/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/;
  }
  if(input == 'pass' ||
     input == 'userpass')
  {
    validations['display']='Contraseña';
  }

  return validations;
}
function Checkinputs(input,validations)
{
  var status='';
  if(validations['required'] && $(input).val()!='')
  {
      if($(input).val().length < validations['minlength'] || $(input).val().length > validations['maxlength'])
      {
        status='nolength';
      }
      else
      {
        if(validations['pregmatch'])
        {  
          if(validations['pregmatch'].test($(input).val()))
          {
            status='valid'; 
          }
          else 
          {
            status='nopregmatch';
          }
        }
        else
        {
          status='valid';
        }
      } 
  }
  else if(!validations['required'])
  {
    status='norequired';
  }
  else if($(input).val()=='')
  {
    status='nodata';
  }

  return status;
}