$(document).keydown(function(e) {
    // ESCAPE key pressed
    if (e.keyCode == 27) {
      if($('body').hasClass('profile'))
      {
        $('<a href="#" data-ums="app.close.wrapper"></a>').AppUMS();
      } 
    }
});
$(document).ready(function(){
//Facebook SDK
/*$.ajaxSetup({ cache: true });
$.getScript('//connect.facebook.net/en_US/sdk.js', function(){
    FB.init({
      appId: '743180439142490',
      version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
    });
  });
$('[data-action="fblogin"]').click(function (e) {
	e.preventDefault();
	if (typeof button !== 'undefined')
	{
		$(button).find('i.fa').toggleClass('fa-spin fa-circle-o-notch fa-warning');
	}
	else
	{
		button = $(this).append(' <i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
	}
	

    FB.login(function(response) {
  		if (response.status === 'connected') 
  		{
    		$(button).addClass('disabled').find('i.fa').toggleClass('fa-spin fa-circle-o-notch fa-check');
  		}
  		else 
  		{
  			$(button).find('i.fa').toggleClass('fa-spin fa-circle-o-notch fa-warning');
  		}
	});
});*/
//Profile Page
$('[data-action="openbox"]').click(function (e) {
  e.preventDefault();
  box=$(this).parent();
  $(box).find('.panel-body').toggle( "slow" );
  $(box).find('.list-group:not(.collapse>.list-group)').toggle( "slow" );
  $(box).find('.panel-footer').toggle( "slow" );
  //$(this).parent().toggleClass('in');
});

//Profile App

$('[data-ums], [data-show]').click(function(e){
  e.preventDefault();
  $(this).AppUMS();
});

});


$.fn.AppUMS = function () 
{
  if($(this).attr('data-ums'))
  {

    var action = $(this).attr('data-ums').split('.');
  
    if(action[0]=='app')
    {
      if(action[1]=='open')
      {
          if(action[2]=='offcanvas')
        {
          $('.row-offcanvas-right').toggleClass('active');
        }
        if (action[2]=='wrapper')
        {
          $('body').toggleClass('profile');
          $('.wrapper.profile').toggleClass('open');
          $('.profile.sidebar-content').css('margin-left','600px');
            $('.profile.sidebar-content').animate({'margin-left':'0'},300, function(){
            $('.wrapper.profile').toggleClass('bg');
          });
        }

      }
      
      if(action[1]=='close')
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
      if(action[1]=='login')
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
    }
  }
  if($(this).attr('data-show'))
  {
    var route  = $(this).attr('data-show').split('.');
    if(route[0]=='app')
    {
      if(route[1]=='content')
      {
        $('a[data-target="#app'+route[2]+'"]').tab('show');
      }
      if(route[1]=='user')
      {
        $('#app'+route[2]+'').collapse('toggle');
      }
    }
  }
}