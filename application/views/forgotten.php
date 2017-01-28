
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form onsubmit='checkForm()'  id='register_form' name='form_register' action='/personal/forgotten' method='post' style='    background: #fff;
    padding: 15px;
    margin: 10px;' role="form">
			<h2 style=' margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;'>Востановление пароля</h2>
	<p style='color:red'><?=$data['massage']?></p>

			
			<p class='alert alert-warning'>В качестве безопасности, пароли всех клиентов захэшированы, следовательно вам на почту будет выслан новый пароль - случайно сгенерированный, вы сможете его изменить в личном кабинете</p>

			<div class='col-md-12 col-xs-12 col-sm-6'>
				<div class="form-group has-success has-feedback">
				  <label class="control-label" for="inputGroupSuccess1">Введите ваш e-mail</label>
				  <div class="input-group">
					<span class="input-group-addon">@</span>
					<input type="text" class="form-control" name="email_registers" id="email_registers"  aria-describedby="inputGroupSuccess1Status">
				  </div>
				  <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
				  <span id="inputError2Status" class="sr-only">(success)</span>
				</div>
			</div>
			
			
			
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-12"><input type="submit" value="ВОССТАНОВИТЬ" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
			</div>
		</form>
	</div>
 </div>
</div>
	
	
<script>
				$("#email_registers").on("keyup",function(){
					
				$.ajax({
						type : 'POST',
						url : '/ajax/getUserEmail',
						data : {'email':$(this).val()},
						success : function(data) {
							
							if(data == 'false')
							{
								$("#email_registers").parent().parent().find('label').text('Такого E-mail не существует');
								$("#email_registers").parent().parent().removeClass("has-success");
								$("#email_registers").parent().parent().addClass("has-error");
								$("#email_registers").parent().parent().find('span').removeClass("glyphicon-ok");
								$("#email_registers").parent().parent().find('span').addClass("glyphicon-remove");
						
								
							}else{
								$("#email_registers").parent().parent().find('label').text('Есть такой E-mail');
								$("#email_registers").parent().parent().addClass("has-success");
								$("#email_registers").parent().parent().removeClass("has-error");
								$("#email_registers").parent().parent().find('span').addClass("glyphicon-ok");
								$("#email_registers").parent().parent().find('span').removeClass("glyphicon-remove");
							}
						}
					});
		});
		
</script>
