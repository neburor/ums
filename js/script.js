//UMS framework with jQuery
$(document).ready(function(){


//Routes
if(location.hash)
{
  var lastHash = location.hash;
	Routes(location.hash);
}

$(window).bind('hashchange', function() {
  hash = location.hash;
	if(location.hash)
	{
		Routes(location.hash);
	}
	lastHash = hash;
});
 //SCROLLTOP
$('.scrolltop.collapsed').on('click', function (e){
   		e.preventDefault();
   		$(this).animatescroll();
	});
$('#cta_btn').on('click', function (e){
  if($(document).width()<=750)
  {
    $('html, body').stop().animate({'scrollTop':0},900,'swing');
  }
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
//Avatars
$('.collapse.avatars').on('show.bs.collapse', function () {

  $(this).load($(this).data('content'));
})
});

function Routes(hash)
{
	var routes = hash.split('/');
	if(routes[1]=='ums')
	{
		umsRoutes(routes);
	}
	if(routes[1]=='app')
	{
		appRoutes(routes);
	}	
}
function appRoutes(route)
{
    if(route[2]=='close')
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
    else if(route[2]=='login')
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
      if(route[2]=='settings')
      {
        if($("#app"+route[3]).hasClass('active') && route[4]!='open')
        {
          $('#app'+route[3]).removeClass('active');
        }
        else
        {
          $('<a data-target="#app'+route[3]+'"></a>').tab('show');
        }
      }

    	if(route[2]=='content')
      {
        $('a[data-target="#app'+route[3]+'"]').tab('show');
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
function umsRoutes (routes)
{	
	action = routes[2];
	actionid=routes[3];

	if(action=='tab')
	{
		if($('.nav-tabs a[data-target="#'+actionid+'"]').length > 0)
		{
			$('.nav-tabs a[data-target="#'+actionid+'"]').tab('show').animatescroll();
		}
		else
		{
        $('#'+actionid).animatescroll();	
		}
	}

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
        pregmatch:/^[a-zA-Z0-9 áéíóúüñÁÉÍÓÚÜÑ_@.,/#&+-]*$/, 
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