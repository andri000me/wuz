$(document).ready(function(){

	// SLIDER
	setInterval(function(){
		kanan();
	}, 7000);

	var jumSlide = $(".slider ul li").length;
	var widthSlide = $(".slider ul li").width();
	var heightSlide = $(".slider ul li").height();
	var widthUl = jumSlide * widthSlide;

	$(".slider").css({height : heightSlide, width : widthSlide});
	$(".slider ul").css({width : widthUl, marginLeft : - widthSlide});
	$(".slider ul li:last-child").prependTo(".slider ul");

	function kiri(){
		$(".slider ul").animate({left: + widthSlide} , 700, function(){
			$(".slider ul li:last-child").prependTo(".slider ul");
			$(".slider ul").css({'left': ''});
		});
	}

	function kanan(){
		$(".slider ul").animate({left: - widthSlide} , 700, function(){
			$(".slider ul li:first-child").appendTo(".slider ul");
			$(".slider ul").css({'left' : ''});
		});
	}


	// CONTROLLER SLIDER
	$('.previous').click(function(){
		kiri();
	});

	$('.next').click(function(){
		kanan();
	});


	// ICON SOCMED
	$('.mini-logo').hover(function(){

		switch($(this).attr('id')){
			case "1":
			$(' #1').animate({opacity:'0.5'});
			$('#1').addClass('shake');
			setTimeout(function(){
				$('#1').removeClass('shake');
				$(' #1').animate({opacity:'1'});
			},700);
			break;

			case "2":
			$(' #2').animate({opacity:'0.5'});
			$('#2').addClass('shake');
			setTimeout(function(){
				$('#2').removeClass('shake');
				$(' #2').animate({opacity:'1'});
			},700);
			break;

			case "3":
			$(' #3').animate({opacity:'0.5'});
			$('#3').addClass('shake');
			setTimeout(function(){
				$('#3').removeClass('shake');
				$(' #3').animate({opacity:'1'});
			},700);
			break;

			default:
			$(' #4').animate({opacity:'0.5'});
			$('#4').addClass('shake');
			setTimeout(function(){
				$('#4').removeClass('shake');
				$(' #4').animate({opacity:'1'});
			},700);
		}
	},
    function() {
      console.log($(this));
    });


    // SMOOTHSCROLL
  	$('a[href*=\\#]').on('click', function(a){
  		a.preventDefault();

  		var tg = $(this).attr('href');
  		$('html, body').animate({
  			scrollTop : $(tg).offset().top
  		},700, function(){
  			location.hash = tg;
  		});
  		return false;
  	});

});


$(window).scroll(function(){
	if($(window).scrollTop()>1000){
		$('.ku').addClass('mini-shake');
	}

	setTimeout(function(){
		$('.ku').removeClass('mini-shake')
	},3000);
});
