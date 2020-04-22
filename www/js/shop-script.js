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
     $('#block-category > ul > li > a').click(function(){
               	        
            if ($(this).attr('class') != 'active'){
                
			$('#block-category > ul > li > ul').slideUp(400);
            $(this).next().slideToggle(400);
            
                    $('#block-category > ul > li > a').removeClass('active');
					$(this).addClass('active');
                    $.cookie('select_cat', $(this).attr('id'));
                    
				}else
                {
                                   
                    $('#block-category > ul > li > a').removeClass('active');
                    $('#block-category > ul > li > ul').slideUp(400);
                    $.cookie('select_cat', '');   
                }                                  
        });
    if ($.cookie('select_cat') != ''){
            $('#block-category > ul > li > #'+$.cookie('select_cat')).addClass('active').next().show();
    }
$('#genpass').click(function(){
$.ajax({type: "POST",url: "/functions/genpass.php",
dataType: "html",
cache: false,
success: function(data) {
            $('#reg_pass').val(data);
        }
    });
});

$('#reload_captcha').click(function(){
$('#block-captcha > img').attr("src","/reg/reg_captcha.php?r="+ Math.random());
});

}); 