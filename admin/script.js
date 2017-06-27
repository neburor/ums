//UMS framework with jQuery
var lastHash = location.hash;
$(document).ready(function(){

//Dashboard
if(sessionStorage.getItem("token")){
  loadDashboard();
}else if(localStorage.getItem("token")){
  sessionStorage.setItem("token",localStorage.getItem("token"));
  sessionStorage.setItem("domain",localStorage.getItem("domain"));
  progressbar = $('#progress-content>.progress-bar');
   $.ajax({
      async: false,
      type: "POST",
      url: "ums/admin/login.php",
      cache: false,
      data: { token: localStorage.getItem("token")},
      xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            $(progressbar).html(Math.round(percentComplete * 100) + "%");
            $(progressbar).width(Math.round(percentComplete * 100)+ "%");
          }
        }, false);
        return xhr;
      }
    }).done(function( html ) {
      $(progressbar).width(0);
      loadDashboard();
    });
}else{
  loadLogin('index');
}

//Routes
if(location.hash)
{
  lastHash= '#';
  Routes(location.hash);
} else if(sessionStorage.getItem("token")){
  location.hash='#/dashboard';
}

$(window).bind('hashchange', function() {
	if(location.hash)
	{
		Routes(location.hash);
	}
	lastHash = location.hash;
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

});

function ShowPanel(route)
{
  progressbar = $('#progress-content>.progress-bar');
  lastcontent = $('#main_content div:first-child');
  $('.sidebar-nav>li>a').removeClass('active');
  $('a[data-target="#'+route[1]+'"]').addClass('active');
  $.ajax({
      type: "POST",
      url: "ums/admin/api.php",
      cache: false,
      data: { token: sessionStorage.getItem("token"), domain: sessionStorage.getItem("domain"), content: route[1] },
      xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    $(progressbar).html(Math.round(percentComplete * 100) + "%");
                    $(progressbar).width(Math.round(percentComplete * 100)+ "%");
                  }
                  }, false);
                return xhr;
            }
    }).done(function( html ) {
      $(progressbar).width(0);
      if(html!='error')
      {
        $('#main_content').append('<div>'+html+'</div>');
        $(lastcontent).slideUp('fast', "linear", function(){
        $(this).remove();
        });
        if(route[2])
            {
              ShowTab(route);
            }
        $('#main_content').find('[data-hash]').on('click', function (e) {
          e.preventDefault();
          $(this).hashchange('click');
        });
        $('#main_content').find('[data-action]').on('click', function (e){
          e.preventDefault();
          $(this).actions();
        });
        $('#main_content').find('a[href="#"]').on('click', function (e) {
          e.preventDefault();
        });
        $('#main_content').find('.form.reply').formreply(); 
      }  
    });
	
	//$('#main_content').append($(panelid).html());

	//$('#main_content').find('table.datatables').DataTables();
	
	//DataTables(tables);
	
}
function ShowTab(route)
{
  progressbar = $('#progress-content>.progress-bar');
  $.ajax({
      type: "POST",
      url: "ums/admin/api.php",
      cache: false,
      data: { token: sessionStorage.getItem("token"), domain: sessionStorage.getItem("domain"), content: route[1]+'-'+route[2] },
      xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    $(progressbar).html(Math.round(percentComplete * 100) + "%");
                    $(progressbar).width(Math.round(percentComplete * 100)+ "%");
                  }
                  }, false);
                return xhr;
            }
    }).done(function( html ) {
      $(progressbar).width(0);
      if(html!='error')
      {
        $('#'+route[1]+'-'+route[2]).empty().append('<div>'+html+'</div>');
        $('.nav-tabs a[data-target="#'+route[1]+'-'+route[2]+'"]').tab('show');
        $('#'+route[1]+'-'+route[2]).find('[data-hash]').on('click', function (e) {
          e.preventDefault();
          $(this).hashchange('click');
        });
        $('#'+route[1]+'-'+route[2]).find('[data-action]').on('click', function (e){
          e.preventDefault();
          $(this).actions();
        });
        $('#'+route[1]+'-'+route[2]).find('a[href="#"]').on('click', function (e) {
          e.preventDefault();
        });
        $('#'+route[1]+'-'+route[2]).find('.form.reply').formreply(); 
      }  
    });
	
}
function Routes(hash)
{
  var routes = hash.split('/');
  if(routes[1]!='logout')
  {
    var rL = lastHash.split('/');
    var rh = routes;
    if(rh[2] && rh[1]==rL[1])
    {
      ShowTab(routes);
    }
    else
    {
      ShowPanel(routes);
    }
  }
  else
  {
    logout();
  }
	
}

function logout ()
{
  location.hash="#";
  localStorage.removeItem("token");
  sessionStorage.removeItem("token");
  localStorage.removeItem("domain");
  sessionStorage.removeItem("domain");
  document.cookie = 'token="";expires="-1"; path=/';
  loadLogin();
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
    var rh = location.hash.split('/');
    if(rh[2])
    {
      ShowTab(rh);
    }
    else
    {
      Routes(location.hash);
    }
  }
}

$.fn.animatescroll = function ()
{
	$('html, body').stop().animate({'scrollTop':$(this).offset().top},900,'swing')
}
$.fn.actions = function ()
{
  action = $(this).attr('data-action');
  if(action=='domain')
  {
    domain=$(this).attr('data-content');
    sessionStorage.setItem("domain", domain);
    if(localStorage.getItem("domain"))
    {
      localStorage.setItem("domain", domain);
    }
    Routes(location.hash);
    $('button.domainname').empty().append('<i class="fa fa-globe fa-2x"></i>');
    $('a.domainname').empty().append('<i class="fa fa-globe fa-2x"></i> ' + domain);
  }
  if(action=='active' || action=='archive' || action=='ban')
  {
    content = $(this).attr('data-content');
    source = $(this).attr('data-source');
    type = content.split(':')[0]
    element = $(this).parent().parent().parent().parent('.'+type);
    progressbar = $(element).find('.progress-bar');
    $.ajax({
      type: "POST",
      url: "ums/admin/api.php",
      cache: false,
      data: { token: localStorage.getItem("token"), domain: localStorage.getItem("domain"), action: action, content: content, source: source},
      xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            $(progressbar).html(Math.round(percentComplete * 100) + "%");
            $(progressbar).width(Math.round(percentComplete * 100)+ "%");
          }
        }, false);
        return xhr;
      }
    }).done(function( html ) {
      $(progressbar).width(0);
      $(element).slideUp('fast', "linear", function(){
        $(element).remove();
        });
    });
  }
}
$.fn.formreply = function(option) 
{
  $(this).on("submit", function(event) {
    event.preventDefault();
    if($(this).find('input[name="message"]').length)
    {
      type = 'message';
    }
    if($(this).find('input[name="comment"]').length || $(this).find('textarea[name="comment"]').length)
    {
      type = 'comment';
    }
    //Elementos del formulario
    var status = [];
    var inputWarning = null;
    response=$(this).find('div.response');
    btncontrol=$(this).find('button[type="submit"]');
    element = $(this).parent().parent().parent().parent('.list-group-item');
    if($(this).find('.progress-bar').length) {
      progressbar=$(this).find('.progress-bar');
    } else {
      progressbar = $(element).find('.progress-bar');
    }
    
    //Inputs de los formularios para verificar si existen y si son correctas
    $($(this).find('input,textarea,select')).each(function(){
      $(this).parent().parent().removeClass('has-error');
        if($(this).is(':disabled')){}
        else 
        {
          if($(this).attr('type')!='checkbox'){
            status[$(this).attr('name')]=Checkinputs($(this),Validations($(this).attr('name')));
            console.log($(this).attr('name')+'|'+status[$(this).attr('name')]+':'+$(this).val());
            if($(this).attr('type')!='hidden' && status[$(this).attr('name')]!='valid'){
              $(this).parent().parent().addClass('has-error');
              inputWarning++;
            } 
          }
        }
    }); 
    if(inputWarning){
      $(response).empty().append(Feedback(status));
    }
    else
    {
      var form = new FormData($(this)[0]);
      form.append('domain',sessionStorage.getItem('domain'));
      form.append('token',sessionStorage.getItem('token'));
      //Envio del formulario con AJAX
        $.ajax({
            type: "POST",
            url: "ums/admin/api.php",
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
                  }
                  }, false);
                return xhr;
            },
            beforeSend: function(){
              $(btncontrol).append(' <i class="fa fa-cog fa-spin"></i>').attr("disabled","disabled");
            }
         }).done(function(data) {
      $(progressbar).width(0);
      $(element).slideUp('fast', "linear", function(){
        $(element).remove();
        });
    }).fail(function(data){
      $(btncontrol).find('i.fa-spin').remove();
      $(btncontrol).removeAttr("disabled");
      $(response).empty().append(FeedbackAlert({'error':'El servidor no responde.'}));
    });
    }
  });
}
$.fn.Login = function() 
{
  $(this).on("submit", function(event) {
    event.preventDefault();
    //Elementos del formulario
    var status = [];
    var inputWarning = null;
    var autologin = null;
    if($(this).find('input[name="autologin"]').is(":checked"))
    {
      autologin='on';
    }
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
                  if(autologin)
                  {
                    localStorage.setItem("token", data.token);
                    localStorage.setItem("domain", data.domains);
                  }
                  sessionStorage.setItem("token", data.token);
                  sessionStorage.setItem("domain", data.domains);
                  loadDashboard('#/dashboard');
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
    $('#main_content').append('<div class="col-sm-8 col-md-6 col-lg-4 col-md-push-2 col-lg-push-3 col-xs-12 xxs-nopadding">          <div class="site-wrapper"><div class="site-wrapper-inner">          <div class="form-group text-center">            <img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" class="logo">          </div>          <form class="form col-xs-12 xxs-nopadding" role="form" action="#" method="POST" id="login_form">           <div class="progress">              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            </div>            <input type="hidden" name="formid" value="app_settings-login">            <input type="hidden" name="formtype" value="login">            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-at"></i></span>                <input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">              </div>            </div>            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>                <input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">              </div>            </div>            <div class="form-group col-xs-12">              <label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>            </div>            <div class="form-group col-xs-12 response"></div>              <div class="form-group col-xs-12">                <button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>              </div>          </form>          </div></div>        </div>').find('.form').Login();
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
          $('#main_content').append('<div class="col-sm-8 col-md-6 col-lg-4 col-md-push-2 col-lg-push-3 col-xs-12 xxs-nopadding">          <div class="site-wrapper"><div class="site-wrapper-inner">          <div class="form-group text-center">            <img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" class="logo">          </div>          <form class="form col-xs-12 xxs-nopadding" role="form" action="#" method="POST" id="login_form">           <div class="progress">              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            </div>            <input type="hidden" name="formid" value="app_settings-login">            <input type="hidden" name="formtype" value="login">            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-at"></i></span>                <input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">              </div>            </div>            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>                <input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">              </div>            </div>            <div class="form-group col-xs-12">              <label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>            </div>            <div class="form-group col-xs-12 response"></div>              <div class="form-group col-xs-12">                <button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>              </div>          </form>          </div></div>        </div>').find('.form').Login();
          });
        }
        else
        {
          $('#main_content').append('<div class="col-sm-8 col-md-6 col-lg-4 col-md-push-2 col-lg-push-3 col-xs-12 xxs-nopadding">          <div class="site-wrapper"><div class="site-wrapper-inner">          <div class="form-group text-center">            <img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" class="logo">          </div>          <form class="form col-xs-12 xxs-nopadding" role="form" action="#" method="POST" id="login_form">           <div class="progress">              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            </div>            <input type="hidden" name="formid" value="app_settings-login">            <input type="hidden" name="formtype" value="login">            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-at"></i></span>                <input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">              </div>            </div>            <div class="form-group col-xs-12 ">              <div class="input-group">                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>                <input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">              </div>            </div>            <div class="form-group col-xs-12">              <label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>            </div>            <div class="form-group col-xs-12 response"></div>              <div class="form-group col-xs-12">                <button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>              </div>          </form>          </div></div>        </div>').find('.form').Login();
        }  
      });
      $(this).remove();
    });
  }
}
function loadDashboard(hash)
{
  if(hash){
    location.hash=hash;
  }
  $.ajax({
      type: "POST",
      url: "ums/admin/api.php",
      data: { token: sessionStorage.getItem("token"), domain: sessionStorage.getItem("domain"), content: "navbar" }
    }).done(function( html ) {
      $('#navbar').append(html);
      $('#navbar').find('[data-hash]').on('click', function (e) {
        e.preventDefault();
        $(this).hashchange('click');
      });    
      $('#navbar').find('[data-offcanvas="offcanvas-left"]').click(function () {
        $('.row-offcanvas-left').toggleClass('active');
      });
      $('#navbar').find('[data-offcanvas="offcanvas-right"]').click(function () {
        $('.row-offcanvas-right').toggleClass('active');
      });
     $('#navbar').find('a[href="#"]').on('click', function (e){
      e.preventDefault();
      });
     $('#navbar').find('[data-action]').on('click', function (e){
      e.preventDefault();
      $(this).actions();
     });
    });  
  $.ajax({
      type: "POST",
      url: "ums/admin/api.php",
      data: { token: sessionStorage.getItem("token"), domain: sessionStorage.getItem("domain"), content: "sidebar-left" }
    }).done(function( html ) {
      $('#sidebar-offcanvas-left').append(html);
      $('#sidebar-offcanvas-left').find('[data-hash]').on('click', function (e) {
        e.preventDefault();
        $(this).hashchange('click');
        $('.row-offcanvas-left').removeClass('active');
      });
      $('#sidebar-offcanvas-left').find('a[href="#"]').on('click', function (e){
        e.preventDefault();
      });
      
    });
    $.ajax({
      type: "POST",
      url: "ums/admin/api.php",
      data: { token: sessionStorage.getItem("token"), domain: sessionStorage.getItem("domain"), content: "sidebar-right" }
    }).done(function( html ) {
      $('#sidebar-offcanvas-right').append(html);
      $('#sidebar-offcanvas-right').find('[data-hash]').on('click', function (e) {
        e.preventDefault();
        $(this).hashchange('click');
        $('.row-offcanvas-right').removeClass('active');
      });
      $('#sidebar-offcanvas-right').find('a[href="#"]').on('click', function (e){
        e.preventDefault();
      });
      $('#sidebar-offcanvas-right').find('[data-action]').on('click', function (e){
      e.preventDefault();
      $(this).actions();
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
  if(input == 'toid')
  {
    validations['minlength'] = 1;
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
  if(input == 'comment')
  {
    validations['display']='Comentario';
    validations['maxlength'] = 1024;
  }
  if(input == 'message')
  {
    validations['display']='Mensaje';
    validations['maxlength'] = 1024;
  }
   if(input == 'reply')
  {
    validations['display']='Respuesta';
    validations['maxlength'] = 1024;
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