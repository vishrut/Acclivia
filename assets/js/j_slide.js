function reset_window0()
{
 $('.pollSlider-button0').animate({"margin-right": '-=200'});
  $('.pollSlider-button1').animate({"margin-right": '+=200'});
   $('.pollSlider-button2').animate({"margin-right": '+=200'});
    $('.pollSlider-button3').animate({"margin-right": '+=200'});
}

function reset_window1()
{
 $('.pollSlider-button1').animate({"margin-right": '-=200'});
  $('.pollSlider-button0').animate({"margin-right": '+=200'});
   $('.pollSlider-button2').animate({"margin-right": '+=200'});
    $('.pollSlider-button3').animate({"margin-right": '+=200'});
}

function reset_window2()
{
 $('.pollSlider-button2').animate({"margin-right": '-=200'});
  $('.pollSlider-button1').animate({"margin-right": '+=200'});
   $('.pollSlider-button0').animate({"margin-right": '+=200'});
    $('.pollSlider-button3').animate({"margin-right": '+=200'});
}

function reset_window3()
{
 $('.pollSlider-button3').animate({"margin-right": '-=200'});
  $('.pollSlider-button1').animate({"margin-right": '+=200'});
   $('.pollSlider-button2').animate({"margin-right": '+=200'});
    $('.pollSlider-button0').animate({"margin-right": '+=200'});
}

$(document).ready(function()
{
  $('.pollSlider-button0').click(function() {
    if($(this).css("margin-right") == "200px")
    {
        $('.pollSlider0').animate({"margin-right": '-=200'});
		reset_window0()
       
    }
    else
    {
        $('.pollSlider0').animate({"margin-right": '+=200'});
        $('.pollSlider-button0').animate({"margin-right": '+=200'});
		$('.pollSlider-button1').animate({"margin-right": '-=200'});
		$('.pollSlider-button2').animate({"margin-right": '-=200'});
		$('.pollSlider-button3').animate({"margin-right": '-=200'});
    }
	


  });
 });     



$(document).ready(function()
{
  $('.pollSlider-button1').click(function() {
    if($(this).css("margin-right") == "200px")
    {
        $('.pollSlider1').animate({"margin-right": '-=200'});
       
		reset_window1()
    }
    else
    {
        $('.pollSlider1').animate({"margin-right": '+=200'});
        $('.pollSlider-button1').animate({"margin-right": '+=200'});
		 $('.pollSlider-button2').animate({"margin-right": '-=200'});
		  $('.pollSlider-button3').animate({"margin-right": '-=200'});
		   $('.pollSlider-button0').animate({"margin-right": '-=200'});
    }


  });
 });     



$(document).ready(function()
{
  $('.pollSlider-button2').click(function() {
    if($(this).css("margin-right") == "200px")
    {
        $('.pollSlider2').animate({"margin-right": '-=200'});
      
		reset_window2()
    }
    else
    {
        $('.pollSlider2').animate({"margin-right": '+=200'});
        $('.pollSlider-button2').animate({"margin-right": '+=200'});
		  $('.pollSlider-button1').animate({"margin-right": '-=200'});
		    $('.pollSlider-button3').animate({"margin-right": '-=200'});
			  $('.pollSlider-button0').animate({"margin-right": '-=200'});
    }


  });
 });     




$(document).ready(function()
{
  $('.pollSlider-button3').click(function() {
    if($(this).css("margin-right") == "200px")
    {
        $('.pollSlider3').animate({"margin-right": '-=200'});
       
		reset_window3()
    }
    else
    {
        $('.pollSlider3').animate({"margin-right": '+=200'});
        $('.pollSlider-button3').animate({"margin-right": '+=200'});
		  $('.pollSlider-button0').animate({"margin-right": '-=200'});
		    $('.pollSlider-button1').animate({"margin-right": '-=200'});
			  $('.pollSlider-button2').animate({"margin-right": '-=200'});
    }


  });
 });     


