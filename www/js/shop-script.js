$(document).ready(function() {
    /*Правый блок новостей*/
   $("#newsticker").jCarouselLite({
		vertical: true,
		hoverPause:true,
		btnPrev: "#news-prev",
		btnNext: "#news-next",
		visible: 3,
		auto:3000,
		speed:500
	});
    /*Кнопки Вид (Сетка или Список)*/
    $("#style-grid").click(function(){
        $("#block-car-grid").show();
        $("#block-car-list").hide();
        $("#style-grid").attr("src","/images/icon-grid-active.png")
        $("#style-list").attr("src","/images/icon-list.png")
        $.cookie('select_style','grid')
    });
    $("#style-list").click(function(){
        $("#block-car-grid").hide();
        $("#block-car-list").show();
        $("#style-list").attr("src","/images/icon-list-active.png")
        $("#style-grid").attr("src","/images/icon-grid.png")
        $.cookie('select_style','list')
    });
    if($.cookie('select_style') == 'grid'){
        $("#block-car-grid").show();
        $("#block-car-list").hide();
        $("#style-grid").attr("src","/images/icon-grid-active.png")
        $("#style-list").attr("src","/images/icon-list.png")
    }else{
        $("#block-car-grid").hide();
        $("#block-car-list").show();
        $("#style-list").attr("src","/images/icon-list-active.png")
        $("#style-grid").attr("src","/images/icon-grid.png")
    }
    /*Вид сортировки*/
    $("#select-sort").click(function(){
        $("#sorting-list").slideToggle(200);
    });
 });