$(document).ready(function () {
	$(".navi a").click(function () {
		var butone = $(this).attr("href");
		$(".navi a").not(this).removeClass("botoniac");
		$(this).addClass("botoniac");
		$(".conteni > div").not(butone).slideUp();
		$(butone).slideDown();
		return false;
	});
});


$(document).ready(function(){
$('.minic').click(function(){
  $(this).siblings('.minico').slideToggle(900);
});
});