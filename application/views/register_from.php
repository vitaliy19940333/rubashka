<script src="/js/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	$("#register_form").validate({
        
       rules:{ 
        
            first_name:{
                required: true,
                minlength: 3,
                maxlength: 16
            },
            
            last_name:{
				
                required: true,
                minlength: 3,
                maxlength: 28
            },
			phone:{
				required: true,
                minlength: 5,
                maxlength: 25
			},
			email:{
				email:true,
				required: true,
                minlength: 4,
                maxlength: 1600
			}
			,
			password:{
				required: true,
                minlength:4 ,
                maxlength: 86
			},
			password_confirmation:{
				required: true,
                minlength:4 ,
                maxlength: 86
			}
       },
       
       messages:{
        
            first_name:{
                required: "Это поле обязательно для заполнения",
                minlength: "Имя не может быть меньше трех символов",
                maxlength: "Максимальное число символов - 16"
            },
			 last_name:{
                required: "Это поле обязательно для заполнения",
                minlength: "Фамилия не может быть меньше трех символов",
                maxlength: "Максимальное число символов - 16"
            },
            
            email:{
                required: "Это поле обязательно для заполнения",
                minlength: "Email должен быть минимум 6 символа",
                maxlength: "Максимальное число символов - 28",
				email:  "Введити корректный mial"
            },
			  phone:{
                required: "Это поле обязательно для заполнения",
                minlength: "Введите корректный телефон",
                maxlength: "Введите корректный телефон"
            },
			password:{
				required: "Это поле обязательно для заполнения",
                minlength: "Минимум 4 символа",
                maxlength: "Максимальное число символов - 1600"
			},
			password_confirmation:{
				required: "Это поле обязательно для заполнения",
				minlength: "Минимум 4 символа",
                maxlength: "Максимальное число символов - 1600"
			}
        
       }
        
    });
});
	   
</script>
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form onsubmit='checkForm()'  id='register_form' name='form_register' action='/personal/register' method='post' style='    background: #fff;
    padding: 15px;
    margin: 10px;' role="form">
			<h2 style=' margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;'>Регистрация</h2>
	<p style='color:red'><?=$data?></p>

			
			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">Ваше имя:</label>
				  <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
					<input type="text" class="form-control" name="first_name" id="first_name" aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">Ваша фамилия:</label>
				  <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
					<input type="text" class="form-control" name="last_name" id="last_name" aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			
			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">Телефон:</label>
				  <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
					<input type="text" class="form-control" name="phone" id="phone"  aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">E-mail:</label>
				  <div class="input-group">
					<span class="input-group-addon">@</span>
					<input type="text" class="form-control" name="email" id="email_register"  aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputError2Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">Пароль:</label>
				  <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
					<input type="password" class="form-control"name="password" id="password"  aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">Повторите пароль:</label>
				  <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
					<input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-12"><input type="submit" value="Зарегистрироваться" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
			</div>
		</form>
	</div>
 </div>
</div>
	
	

