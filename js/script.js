$(document).ready(function(){
//Facebook SDK
$.ajaxSetup({ cache: true });
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
});

});