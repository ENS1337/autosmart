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
    
    loadcart();
    
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
    /*Слайдинг блока категорий*/
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
    /*Генерация пароля пароля*/
    $('#genpass').click(function(){
    $.ajax({
    type: "POST",
    url: "/functions/genpass.php",
    dataType: "html",
    cache: false,
    success: function(data) {
            $('#reg_pass').val(data);
        }
    });
});
/*Обновить капчу*/
$('#reload_captcha').click(function(){
$('#block-captcha > img').attr("src","/reg/reg_captcha.php?r="+ Math.random());
});
$('.top-auth').toggle(
       function() {
           $(".top-auth").attr("id","active-button");
           $("#block-top-auth").fadeIn(200);
       },
       function() {
           $(".top-auth").attr("id","");
           $("#block-top-auth").fadeOut(200);  
       }
    );

/*Показать/скрыть пароль*/
$('#button-pass-hide-show').click(function(){
 var statuspass = $('#button-pass-hide-show').attr("class");
  
    if (statuspass == "pass-hide")
    {
       $('#button-pass-hide-show').attr("class","pass-show");
       
     			            var $input = $("#auth_pass");
			                var change = "text";
			                var rep = $("<input placeholder='Пароль' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
        
    }else
    {
        $('#button-pass-hide-show').attr("class","pass-hide");
        
     			            var $input = $("#auth_pass");
			                var change = "password";
			                var rep = $("<input placeholder='Пароль' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;        
       
    }
    


});
/*Кнопка входа на сайт*/
$("#button-auth").click(function() {        
 var auth_login = $("#auth_login").val();
 var auth_pass = $("#auth_pass").val();
 
 if (auth_login == "" || auth_login.length > 30 ){
    $("#auth_login").css("borderColor","#FDB6B6");
    send_login = 'no';
    }else {
    $("#auth_login").css("borderColor","#DBDBDB");
    send_login = 'yes'; 
 }
 
 if (auth_pass == "" || auth_pass.length > 15 ){
    $("#auth_pass").css("borderColor","#FDB6B6");
    send_pass = 'no';
    }else { 
    $("#auth_pass").css("borderColor","#DBDBDB");  
    send_pass = 'yes'; 
 }
    
 if ($("#rememberme").prop('checked')){
    auth_rememberme = 'yes';
    }else {
        auth_rememberme = 'no'; 
    }

 if ( send_login == 'yes' && send_pass == 'yes' ){ 
  $("#button-auth").hide();
  $(".auth-loading").show();
    
  $.ajax({
  type: "POST",
  url: "/include/auth.php",
  data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
  dataType: "html",
  cache: false,
  success: function(data) {

  if (data == 'yes_auth'){
      location.reload();
  }else{
      $("#message-auth").slideDown(400);
      $(".auth-loading").hide();
      $("#button-auth").show();  
  }  
}
});
}  
});
/*Окно востановления пароля*/
$('#remindpass').click(function(){    
			$('#input-email-pass').fadeOut(200, function() {  
            $('#block-remind').fadeIn(300);
			});
});
$('#prev-auth').click(function(){
			$('#block-remind').fadeOut(200, function() {  
            $('#input-email-pass').fadeIn(300);
			});
});
$('#button-remind').click(function(){
    
 var recall_email = $("#remind-email").val();
 
 if (recall_email == "" || recall_email.length > 20 )
 {
    $("#remind-email").css("borderColor","#FDB6B6");

 }else 
 {
   $("#remind-email").css("borderColor","#DBDBDB");
   
   $("#button-remind").hide();
   $(".auth-loading").show();
    
  $.ajax({
  type: "POST",
  url: "/include/remind-pass.php",
  data: "email="+recall_email,
  dataType: "html",
  cache: false,
  success: function(data) {
  if (data == 'yes'){
     $(".auth-loading").hide();
     $("#button-remind").show();
     $('#message-remind').attr("class","message-remind-success").html("На ваш e-mail выслан пароль.").slideDown(400);
     
     setTimeout("$('#message-remind').html('').hide(),$('#block-remind').FadeOut(300),$('#input-email-pass').show()", 3000);
     }else{
      $(".auth-loading").hide();
      $("#button-remind").show();
      $('#message-remind').attr("class","message-remind-error").html(data).slideDown(400);
      }
      }
      }); 
     }
  });
  
/*Блок Пользователя и кнопка выход*/ 
$('#auth-user-info').toggle(
       function() {
           $("#block-user").fadeIn(100);
       },
       function() {
           $("#block-user").fadeOut(100);
       }
    );


$('#logout').click(function(){
    
    $.ajax({
    type: "POST",
    url: "/include/logout.php",
    dataType: "html",
    cache: false,
    success: function(data) {
        if (data == 'logout') location.reload(); 
        }
    }); 
});
/*Поле поиска, вывод результатов поиска*/
$('#input-search').bind('textchange', function () {
                 
 var input_search = $("#input-search").val();

if (input_search.length >= 3 && input_search.length <= 32)
{
 $.ajax({
  type: "POST",
  url: "/include/search.php",
  data: "text="+input_search,
  dataType: "html",
  cache: false,
  success: function(data) {

 if (data > '')
 {
     $("#result-search").show().html(data); 
 }else{
    
    $("#result-search").hide();
 }

      }
}); 

}else
{
  $("#result-search").hide();    
}

});
    //Шаблон проверки email на правильность
function isValidEmailAddress(emailAddress) {
var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}
 // Контактные данные
  $('#confirm-button-next').click(function(event){   

   var order_fio = $("#order_fio").val();
   var order_email = $("#order_email").val();
   var order_phone = $("#order_phone").val();
   var order_address = $("#order_address").val();
   
 if (!$(".order_delivery").is(":checked"))
 {
    $(".label_delivery").css("color","#E07B7B");
    send_order_delivery = '0';

 }else { $(".label_delivery").css("color","black"); send_order_delivery = '1';

  
  // Проверка ФИО 
 if (order_fio == "" || order_fio.length > 50 )
 {
    $("#order_fio").css("borderColor","#FDB6B6");
   send_order_fio = '0';
   
 }else { $("#order_fio").css("borderColor","#DBDBDB");  send_order_fio = '1';}

  
 //проверка email
 if (isValidEmailAddress(order_email) == false)
 {
    $("#order_email").css("borderColor","#FDB6B6");
  send_order_email = '0';   
 }else { $("#order_email").css("borderColor","#DBDBDB"); send_order_email = '1';}
  
 // Проверка телефона
 
  if (order_phone == "" || order_phone.length > 25)
 {
    $("#order_phone").css("borderColor","#FDB6B6");
    send_order_phone = '0';   
 }else { $("#order_phone").css("borderColor","#DBDBDB"); send_order_phone = '1';}
 
 // Проверка Адресса
 
  if (order_address == "" || order_address.length > 150)
 {
    $("#order_address").css("borderColor","#FDB6B6");
    send_order_address = '0';   
 }else { $("#order_address").css("borderColor","#DBDBDB"); send_order_address = '1';}
  
} 
 // Глобальная проверка
 if (send_order_delivery == "1" && send_order_fio == "1" && send_order_email == "1" && send_order_phone == "1" && send_order_address == "1")
 {
    // Отправляем форму
   return true;
 }
event.preventDefault();
});
/*Добавление автомобилей в корзину по нажатию на корзину*/
$('.add-cart-style-list,.add-cart-style-grid,.add-cart,.random-add-cart').click(function(){
              
 var  tid = $(this).attr("tid");

 $.ajax({
      type: "POST",
      url: "/include/addtocart.php",
      data: "id="+tid,
      dataType: "html",
      cache: false,
      success: function(data) {
  }
});

});

function loadcart(){
    $.ajax({
        type: "POST",
        url: "/include/loadcart.php",
        dataType: "html",
        cache: false,
        success: function(data) {
        loadcart();
    
  if (data == "0")
  {
    $("#block-basket > a").html("Корзина пуста");
	}else
    {
    $("#block-basket > a").html(data);
    }
  }
});    
       
}

 function fun_group_price(intprice) {  
    // Группировка цифр по разрядам
  var result_total = String(intprice);
  var lenstr = result_total.length;
  
    switch(lenstr) {   
      case 5: {
      groupprice = result_total.substring(0,2)+" "+result_total.substring(2,5);
        break;
      }
      case 6: {
      groupprice = result_total.substring(0,3)+" "+result_total.substring(3,6); 
        break;
      }
      case 7: {
      groupprice = result_total.substring(0,1)+" "+result_total.substring(1,4)+" "+result_total.substring(4,7); 
        break;
      }
      case 8:{
      groupprice = result_total.substring(0,2)+" "+result_total.substring(2,3)+" "+result_total.substring(3,3);
        break;
      }
      default: {
      groupprice = result_total;  
      }
}  
    return groupprice;
}
/*Проверка нажатия кнопки "Нравится"*/
$('#likegood').click(function(){
          
 var tid = $(this).attr("tid");
 
 $.ajax({
  type: "POST",
  url: "/include/like.php",
  data: "id="+tid,
  dataType: "html",
  cache: false,
  success: function(data) {  
  
  if (data == 'no')
  {
    alert('Вы уже голосовали!');
  }  
   else
   {
    $("#likegoodcount").html(data);
   }

}
});
});  
 
}); 