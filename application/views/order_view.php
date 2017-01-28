<style>
	.form-order{
		padding:10px;
		background:#fff;
		margin:15px 0px;
	}
	.form-order label
	{
		    font-weight: 400;
		 margin-bottom: 5px;
		     color: #595959;
			     font-size: 14px;
				 font-family: 'Source Sans Pro', sans-serif;
	}
	.form-order span
	{
		color:red;
	}
	.header_order_view h1
	{
		font-weight: 300;
		    font-family: 'Source Sans Pro', sans-serif;
			    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;
	    line-height: normal;

	}
	
	.form-order
	{
	
	
	}
	.block_right_order h1
	{
		font-weight: 300;
    font-family: 'Source Sans Pro', sans-serif;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    /* margin-bottom: 15px; */
    margin-top: 0px;
    padding-top: 5px;
    line-height: normal;
	}
	.block_right_order .text
	{
		    overflow: hidden;
    text-align: justify;
    font-family: 'Open Sans', sans-serif;
    color: rgb(102, 102, 102);
	}
	textarea
	{
		height:100px !important;
	}
	label.error{
		color: red;
	}
	#user_phone {
    width: 100%;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    padding: 8px 8px 8px 36px;
    height: 40px;
    border: 1px solid #ccc;
    font-size: 16px;
    /* color: #363636; */
}
#user_phone:focus {
	outline: none;
	border-color: #363636;
}


input#user_phone:-moz-placeholder {
	color: #363636;
}
input#user_phone::-webkit-input-placeholder {
	color: #363636;
}
.user_phone {
	position: relative;
}
.user_phone:before {
	content: "+38";
	display: block;
	height: 40px;
	color: #363636;
	position: absolute;
	top: 6px;
	left: 7px;
	font-size: 16px;
}
.btn_submit {
	height: 30px;
	position: absolute;
	top: 5px;
	right: 5px;
	background: #363636;
	color: #fff;
	border: none;
	width: 120px;
	cursor: pointer;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}
.btn_submit.disabled {
	color: #363636;
	background: #ccc;
}
</style>
<script src="/js/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	$("#order_form").validate({
        
       rules:{ 
        
            userName:{
                required: true,
                minlength: 3,
                maxlength: 16
            },
            
            userEmail:{
				email:true,
                required: true,
                minlength: 6,
                maxlength: 28
            },
			secondName:{
				required: true,
                minlength: 3,
                maxlength: 25
			},
			userAdress:{
				required: true,
                minlength: 4,
                maxlength: 1600
			}
			,
			user_phone:{
				required: true,
                minlength:15 ,
                maxlength: 86
			}
       },
       
       messages:{
        
            userName:{
                required:"Введите ваше имя",
                minlength: "Имя не может быть меньше трех символов",
                maxlength: "Максимальное число символов - 16"
            },
            
            userEmail:{
                required: "Это поле обязательно для заполнения",
                minlength: "Email должен быть минимум 6 символа",
                maxlength: "Максимальное число символов - 28",
				email:  "Введити корректный mial"
            },
			  secondName:{
                required: "Это поле обязательно для заполнения",
                minlength: "Фамилия не может быть меньше трех символов",
                maxlength: "Максимальное число символов - 16"
            },
			userAdress:{
				required: "Это поле обязательно для заполнения",
                minlength: "Минимум 4 символа",
                maxlength: "Максимальное число символов - 1600"
			},
			user_phone:{
				required: "Это поле обязательно для заполнения"
			}
        
       }
        
    });
});
	   
</script>

<div class='col-md-12 col-xs-12 col-sm-12 form-order'>
	<div class='header_order_view'>
		<h1>Данные о заказчике</h1>
		<p class='alert alert-danger'><?=$data['massage']?></p>
	</div>
	<div class='col-md-8 col-xs-12 col-sm-12'>
		<div class='order_view'>
		<form id='order_form' method='post' action='/cart/order'>
		<?php if(!isset($_SESSION['u_id'])):?>
		  <div class="form-group col-md-6 col-xs-12 col-sm-6">
			<label for="userName">Ваше имя <span>*</span></label>
			<input type="text" class="form-control" id="userName"  name="userName" placeholder="Имя" value='<?=$data['object']['userName']?>'>
		  </div>
		   <div class="form-group col-md-6 col-xs-12 col-sm-6">
			<label for="userSecondName">Ваша Фамилия<span>*</span></label>
			<input type="text" class="form-control" id="secondName"  name="secondName" value='<?=$data['object']['secondName']?>'>
		  </div><br />
		   <div class="form-group col-md-6 col-xs-12 col-sm-6">
			<label for="userEmail">E-mail : <span>*</span></label>
			<input type="email" class="form-control" id="userEmail"  name="userEmail" placeholder="Email" value='<?=$data['object']['userEmail']?>'>
		  </div>
		   <div class="form-group col-md-6 col-xs-12 col-sm-6">
			<label for="user_phone">Телефон<span>*</span></label>
			<div class="user_phone form-group ">
				<input type="tel"  name='user_phone'  required pattern="[0-9_-]{10}" placeholder="(___) ___ __ __" id="user_phone" title="Формат: (096) 999 99 99" value='<?=$data['object']['user_phone']?>'>
			</div>
		  </div>
		  <br />
		  <?php endif;?>
		   <div class="form-group col-md-12 col-xs-12 col-sm-6">
			<label for="userAdress">Адрес:<span>*</span></label>
			<textarea  class="form-control" id="userAdress"  name="userAdress" placeholder='Укажите регион, город и в случае отправки на Новою почту - укажите отделение Новой почты'><?=$data['object']['userAdress']?></textarea>
		  </div>

		  <div class='clear:both'></div>
		    
		   <div class="form-group col-md-12 col-xs-12 col-sm-6">
			<label for="wishes">Пожелания:</label>
			<textarea  class="form-control" id="wishes"  name="wishes" placeholder='Вы можете задать нам вопрос или оставить ваши замечания'></textarea>
		  </div>
		  <div class="form-group col-md-12 col-xs-12 col-sm-6">
			 <input type='submit'  class='pull-right btn btn-success' value='ЗАКАЗАТЬ'>
		  </div>
		 
		</form>
		</div>
	</div>
	
	<div class='col-md-4 col-xs-12 col-sm-12'>
		<div class='block_right_order'>
			<div class='header'>
				<h1>Доставка</h1>
			</div>
			<div class='img pull-left'>
				<img src='/img/delivery.png' alt='delivery'>
			</div>
			<div class='text '>
				<p>Новая Почта (без ограничений по весу и сумме заказа). Так же возможен самовывоз из склада в Одессе.
					другие службы доставки - при заказе от 5000 грн.
				</p>
			</div>
		</div>

		
		
		
		<div class='block_right_order' >
			<div class='header'>
				<h1>Оплата</h1>
			</div>
			<div class='img pull-left'>
				<img src='/img/dollars.png' alt='delivery'>
			</div>
			<div class='text '>
				<p>Вы можете осуществить оплату наличными при получении заказа в любом отделении Новой Почты, а так же после 100% предоплаты на карту ПриватБанка
				</p>
			</div>
		</div>
		
				
		<div class='block_right_order'>
			<div class='header'>
				<h1>Гарантия</h1>
			</div>
			<div class='img pull-left'>
				<img src='/img/darant.png' alt='delivery'>
			</div>
			<div class='text '>
				<p>Беспроблемный возврат / замена товара
				</p>
			</div>
		</div>
		
	</div>
</div>



<script src="/js/jquery.maskedinput.min.js"></script>
<script src="/js/is.mobile.js"></script>
<script src="/js/script2.js"></script>