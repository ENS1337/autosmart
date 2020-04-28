$(document).ready(function() {
    /*Удаление авто*/
	$('.delete').click(function(){
		
		var rel = $(this).attr("rel");
		
		$.confirm({
			'title'		: 'Подтверждение удаления',
			'message'	: 'После удаления восстановление будет невозможно! Продолжить?',
			'buttons'	: {
				'Да'	: {
					'class'	: 'blue',
					'action': function(){
						location.href = rel;
					}
				},
				'Нет'	: {
					'class'	: 'gray',
					'action': function(){}
				}
			}
		});
		
	});
 
    $('#select-links').click(function(){
    $("#list-links,#list-links-sort").slideToggle(200);     
    });
    
    $('.h3click').click(function(){ 
    $(this).next().slideToggle(400); 
    });
});