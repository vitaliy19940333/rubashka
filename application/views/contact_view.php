<script src="/js/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	
	$("#form_feedback").on('submit',function(){
		if(!($("#form_feedback label").hasClass('error')))
		{
			$.ajax({
				type : 'POST',
				url: '/ajax/sendMassage',
				data: $(this).serialize(),
				success: function(data){
					var msg = '';
					if(data == 1)
					{
						msg = "<p class='alert alert-success'>Ваше сообщение успешно отправлено</p>";
						$("#form_feedback").trigger('reset');
					}
						
					else{
						msg = "<p class='alert alert-danger'>При отправлении возникла ошибка, повторите немного позже</p>";
					}
						$(".form_feedback #result").html(msg);
					
				}
			});
		}
		return false;
		
	});
	
	
	$("#form_feedback").validate({
        
       rules:{ 
        
            fio:{
                required: true,
                minlength: 3,
                maxlength: 70
            },
        
			email:{
				email:true,
				required: true,
                minlength: 4,
                maxlength: 1600
			}
			,
			massage_from_site:{
				required: true,
                minlength:10 ,
                maxlength: 4000
			}
       },
       
       messages:{
        
            fio:{
                required: "Это поле обязательно для заполнения",
                minlength: "Имя не может быть меньше трех символов",
                maxlength: "Максимальное число символов - 70"
            },
            email:{
                required: "Это поле обязательно для заполнения",
                minlength: "Email должен быть минимум 6 символа",
                maxlength: "Максимальное число символов - 28",
				email:  "Введити корректный mial"
            },
			massage_from_site:{
				required: "Это поле обязательно для заполнения",
				minlength: "Минимум 10 символjd",
                maxlength: "Максимальное число символов - 4000"
			}
        
       }
        
    });


});
	   
</script>
<style>
h1{
	    margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;
}
h2{
	    margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 20px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;
}
</style>
<br />
<div class='col-md-3 hidden-sm hidden-xs'>
	<div class='top_sales hidden-sm hidden-xs'>
		<?php include "top_sales.php"?>
	</div>
</div>
<div class='col-md-9 col-sm-12 col-xs-12'style='background:#fff'>
	<div class='col-md-12 col-xs-12 col-sm-12'>
		<h1>Связаться с нами</h1>
	</div>
	<div class='col-md-6 col-xs-12 col-sm'>
		<p>График работы менеджеров:</p>
		<p>CБ - ЧТ 08:00 - 20:00</p>
		<p>Заказы на сайте можно делать круглосуточно, без выходных.</p>
		<h2>Телефоны:</h2>
		<p><i class='fa fa-phone-square' aria-hidden='true'></i> +38 (063) 050 - 50 - 50</p>
		<p><i class='fa fa-phone-square' aria-hidden='true'></i> +38 (063) 76 - 31 - 493</p>
		<h2>Почта:</h2>
		<p><i class="fa fa-envelope" aria-hidden="true"></i> emerson-odessa@mail.ru</p>
	</div>
	<div class='col-md-6 col-xs-12 col-sm'>
		<div class='form_feedback'>
			<h2>напишите нам:</h2>
			<div id='result'></div>
			<form id='form_feedback'>
				<div class="form-group">
				  <label for="FIO">ФИО:</label>
				  <input type="text" class="form-control"  name='fio'>
				</div>
				<div class="form-group">
				  <label for="email">E-mail:</label>
				  <input type="email" class="form-control" name='email'>
				</div>
			
				<div class="form-group">
					 <label for="txt">Текст сообщения:</label>
				     <textarea class="form-control" name='massage_from_site'></textarea>
				</div>
				<div class="checkbox">
				   <button type="submit" class="btn btn-default" style="float: right">Отправить</button>
				</div>
			</form>
		</div>
	</div>
</div>