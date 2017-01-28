	var cound_date_new = 86400*2;	
	
	function switch_img()
	{
		if($(".img_hit").attr('src') == '/img/hit.png')
			$(".img_hit").attr('src','/img/hit2.png')
		else
			$(".img_hit").attr('src','/img/hit.png')
	}


	function checkForm()
	{
		var error = false;
		var a = ($("#register_form input"));
		
		for(var i = 0; i < a.length; i++)
		{
			el = a[i];
			
			if($(el).val().length < 1)
				continue;
			
				if($(el).attr('id') == 'email_register')
			continue;
		
		
		
		
		
		if($(el).val().length < 4)
				{
					
					$(el).parent().parent().removeClass("has-success");
					$(el).parent().parent().addClass("has-error");
					$(el).parent().parent().find('span').removeClass("glyphicon-ok");
					$(el).parent().parent().find('span').addClass("glyphicon-remove");
					error = true;
				}else{
					$(el).parent().parent().addClass("has-success");
					$(el).parent().parent().removeClass("has-error");
					$(el).parent().parent().find('span').addClass("glyphicon-ok");
					$(el).parent().parent().find('span').removeClass("glyphicon-remove");
				}
				
				
		if($(el).attr('id') == 'password_confirmation')
		{
			
			
			if($("#password_confirmation").val() != $("#password").val())
			{
					$(el).parent().parent().removeClass("has-success");
					$(el).parent().parent().addClass("has-error");
					$(el).parent().parent().find('span').removeClass("glyphicon-ok");
					$(el).parent().parent().find('span').addClass("glyphicon-remove");
					$("#password_confirmation").parent().parent().find('label').text('Пароли не совпадают');
					error = true;
			}else{
					$(el).parent().parent().addClass("has-success");
					$(el).parent().parent().removeClass("has-error");
					$(el).parent().parent().find('span').addClass("glyphicon-ok");
					$(el).parent().parent().find('span').removeClass("glyphicon-remove");
					$("#password_confirmation").parent().parent().find('label').text('Повторите пароль');
			}
			
			
			
		}
		}
		
		
		if(!error)
			return false;
	
	}
	


	$('document').ready(function(){
					
												
												
												
												
	
		$("a.form_submit").on('click',function(){
			if($("#tel").val().length < 4)
			{
				alert("Введите номер телефона");
				return false;
			}
		
			$.ajax({
				type: "POST",
				url:'/ajax/sendMassageFast',
				data: $("#contact_form_fast").serialize(),
				success: function(data){
					var msg = '';
					if(data == 1)
					{
						msg = "Ожидайте звонка....";
						$("#for_hide").hide();
						$("#contact_form_fast").trigger('reset');
						setTimeout(function(){
							$("#popup_close").trigger('click');
						},2000);
					}
						
					else{
						msg = "<p class='alert alert-danger'>При отправлении возникла ошибка, повторите немного позже</p>";
					}
						$("#contact_form_fast h3").html(msg);
				}
			});
		});
		
			$("#sort").bind('change',function(){
		var pagee = $("li.active a").text();
			$.ajax({
						type : 'POST',
						url : '/ajax/getItems/page/'+pagee,
						data : $("#filter_items").serialize()+'&'+$("#filter_summ").serialize()+'&'+'sort='+$("#sort").val(),
						success : function(data) {
						//	console.log(data);
												Handlebars.registerHelper('link', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)*parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PLUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)+parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('MINUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)-parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												
												
												Handlebars.registerHelper('DROWNEW', function(text) {
												var date = new Date();
												if(date.getTime()/1000 - parseInt(text)  > cound_date_new)
												  return new Handlebars.SafeString("hidden");
												});
												
												
												
												Handlebars.registerHelper('PODELIT', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)/parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PISATCENU', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													var r = (100-d)/100*p;
												else
													var r = p;
												
												  return new Handlebars.SafeString(r.toFixed());
												});
												
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
													Handlebars.registerHelper('ESTNASKLADE', function(sklad) {
												 
													if(parseInt(sklad) > 0)
													
													return new Handlebars.SafeString("hidden");
												});
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
												
												
												
												Handlebars.registerHelper('STRREPLACE', function(text) {
												 
											//	var text = $(text).text();
													
													return new Handlebars.SafeString(text.substr(0,280));
												});
												
												
													Handlebars.registerHelper('ESTNASKLADEe', function(sklad) {
												 
													if(parseInt(sklad) == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('DISCOUNT', function(DISCOUNT) {
												 
													if(DISCOUNT == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('APPENHTML', function(text) {
												 
													$("#pagination").html(text);
												});
												
												
												
												Handlebars.registerHelper('PODD', function(text) {
													if((typeof text) == 'string'){
													var herr = text.split(';');
													var str = "";
													for(var i =0; i < herr.length; i++)
													{
														str+='<option>'+ herr[i]+'</option>';
													}
													return new Handlebars.SafeString(str);
													}else{
														
														var str = "";
													for(var i = 0; i < text.length; i++)
													{
														str+='<option>'+ text[i]+'</option>';
													}
												//	console.log(str);
													return new Handlebars.SafeString(str);
													}
												});
												
												
												Handlebars.registerHelper('OKRYGLIT', function(text) {
												  text = Handlebars.escapeExpression(text);      //экранирование выражения
											


											//var r = parseFloat(text).toFixed(2));
												  return new Handlebars.SafeString(r);
												});
												
												
							var sour = $("#items").html();
							var template = Handlebars.compile(sour);
							console.log(data);
							var rr = JSON.parse(data);
							
							//console.log(rr.filter);
							var o = { 
										test: rr.items,  
										pagination: rr.pagination 
									}
							
							var zapisi = 'Показаны '+rr.pag_from+' - '+ rr.pag_to + ' из ' + rr.count_fields;
							$(".count_fielsa").html(zapisi);
							
							$("#pagination").html(rr.pagination);
									
									//console.log(data);
					
							var elem = template(o);
							if(rr.items.length == 0)
								elem = "<p class='alert alert-danger'>К сожалению, товара с выбранным фильтром нету</p>";
							$(".products-grid").html(elem);

						},beforeSend: function(){
							$(".products-grid").html('<img style="width:100%;max-width:350px"  src="/images/squares.gif" />');
							$("#pagination ul").remove();
						}
					});
					
	});
	
	
		
		
	$("#register_form input").on('keyup',function(){
		checkForm();
	});
		$("#email_register").on("keyup click change",function(){
				$.ajax({
						type : 'POST',
						url : '/ajax/getUserEmail',
						data : {'email':$(this).val()},
						success : function(data) {
							if(data == 'true')
							{
								$("#email_register").parent().parent().find('label').text('Такой E-mail уже существует');
								$("#email_register").parent().parent().removeClass("has-success");
								$("#email_register").parent().parent().addClass("has-error");
								$("#email_register").parent().parent().find('span').removeClass("glyphicon-ok");
								$("#email_register").parent().parent().find('span').addClass("glyphicon-remove");
						
								
							}else{
								$("#email_register").parent().parent().find('label').text('E-mail');
								$("#email_register").parent().parent().addClass("has-success");
								$("#email_register").parent().parent().removeClass("has-error");
								$("#email_register").parent().parent().find('span').addClass("glyphicon-ok");
								$("#email_register").parent().parent().find('span').removeClass("glyphicon-remove");
							}
						}
					});
		});
		
		


			
	$("#search").on("keyup",function(){
				$.ajax({
						type : 'POST',
						url : '/ajax/getAutoComplete',
						data : {'string':$(this).val()},
						success : function(data) {
							//console.log(data);
							var dars = JSON.parse(data);
							var mass  = new Array();
							var varible;
							var j=0;
						for(var i in dars)
						{
							variable = dars[i];
							mass[j++] = variable.article;
						}
						
						for(var i in dars)
						{
							variable = dars[i];
							mass[j++] = variable.title;
						}
var availableTags = mass;
$( "#search" ).autocomplete({
	source: availableTags
});
						}
					});
		});
		
		
		$(".price_filter").css('display','block');
		$("#view_grid").addClass('active');
		$(".active").css('color','red');
		

			$("body").on("click", "#pagination ul li a,#ranges", function () {
				var pages = $(this).attr('href').split("/");
				var pagee = pages[pages.length-1];
			//	console.log(pagee);
					$.ajax({
						type : 'POST',
						url : '/ajax/getItems/page/'+pagee,
						data : $("#filter_items").serialize()+'&'+$("#filter_summ").serialize()+'&'+'sort='+$("#sort").val(),
						success : function(data) {
						//	console.log(data);
												Handlebars.registerHelper('link', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)*parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PLUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)+parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('MINUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)-parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												Handlebars.registerHelper('DROWNEW', function(text) {
												var date = new Date();
												if(date.getTime()/1000 - parseInt(text)  > cound_date_new)
												  return new Handlebars.SafeString("hidden");
												});
												
												
												Handlebars.registerHelper('PODELIT', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)/parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PISATCENU', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													var r = (100-d)/100*p;
												else
													var r = p;
												
												  return new Handlebars.SafeString(r.toFixed());
												});
												
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
													Handlebars.registerHelper('ESTNASKLADE', function(sklad) {
												 
													if(parseInt(sklad) > 0)
													
													return new Handlebars.SafeString("hidden");
												});
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
												
												
												
												Handlebars.registerHelper('STRREPLACE', function(text) {
												 
												//	var text = $(text).text();
													
													return new Handlebars.SafeString(text.substr(0,280));
												});
												
												
													Handlebars.registerHelper('ESTNASKLADEe', function(sklad) {
												 
													if(parseInt(sklad) == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('DISCOUNT', function(DISCOUNT) {
												 
													if(DISCOUNT == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('APPENHTML', function(text) {
												 
													$("#pagination").html(text);
												});
												
												
												
												Handlebars.registerHelper('PODD', function(text) {
													if((typeof text) == 'string'){
													var herr = text.split(';');
													var str = "";
													for(var i =0; i < herr.length; i++)
													{
														str+='<option>'+ herr[i]+'</option>';
													}
													return new Handlebars.SafeString(str);
													}else{
														
														var str = "";
													for(var i = 0; i < text.length; i++)
													{
														str+='<option>'+ text[i]+'</option>';
													}
												//	console.log(str);
													return new Handlebars.SafeString(str);
													}
												});
												
												
												Handlebars.registerHelper('OKRYGLIT', function(text) {
												  text = Handlebars.escapeExpression(text);      //экранирование выражения
											


											//var r = parseFloat(text).toFixed(2));
												  return new Handlebars.SafeString(r);
												});
												
												
							var sour = $("#items").html();
							var template = Handlebars.compile(sour);
							var rr = JSON.parse(data);
							
							//console.log(rr.filter);
							var o = { 
										test: rr.items,  
										pagination: rr.pagination 
									}
									
							var zapisi = 'Показаны '+rr.pag_from+' - '+ rr.pag_to + ' из ' + rr.count_fields;
							$(".count_fielsa").html(zapisi);
							$("#pagination").html(rr.pagination);
									
									//console.log(data);
					
							var elem = template(o);
							if(rr.items.length == 0)
								elem = "<p class='alert alert-danger'>К сожалению, товара с выбранным фильтром нету</p>";
							$(".products-grid").html(elem);

						},beforeSend: function(){
							$(".products-grid").html('<img style="width:100%;max-width:350px"  src="/images/squares.gif" />');
							$("#pagination ul").remove();
						}
						
						
					});
					
			
			return false;
		});
		//ajax заполнение каталога
		$("#filter_items input,#ranges").bind('click',function(){
			
					$.ajax({
						type : 'POST',
						url : '/ajax/getItems',
						data : $("#filter_items").serialize()+'&'+$("#filter_summ").serialize()+'&'+'sort='+$("#sort").val(),
						success : function(data) {
						//	console.log(data);
												Handlebars.registerHelper('link', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)*parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PLUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)+parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('MINUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)-parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('DROWNEW', function(text) {
												var date = new Date();
												if(date.getTime()/1000 - parseInt(text)  > cound_date_new)
												  return new Handlebars.SafeString("hidden");
												});
												
												Handlebars.registerHelper('PODELIT', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)/parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PISATCENU', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													var r = (100-d)/100*p;
												else
													var r = p;
												
												  return new Handlebars.SafeString(r.toFixed());
												});
												
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
													Handlebars.registerHelper('ESTNASKLADE', function(sklad) {
												 
													if(parseInt(sklad) > 0)
													
													return new Handlebars.SafeString("hidden");
												});
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
												
												
												
												
													Handlebars.registerHelper('ESTNASKLADEe', function(sklad) {
												 
													if(parseInt(sklad) == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('DISCOUNT', function(DISCOUNT) {
												 
													if(DISCOUNT == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('APPENHTML', function(text) {
												 
													$("#pagination").html(text);
												});
												
												Handlebars.registerHelper('STRREPLACE', function(text) {
												 
												 
													//var text = $(text).text();
												
													return new Handlebars.SafeString(text.substr(0,280));
												});
												
												
												
												
												Handlebars.registerHelper('PODD', function(text) {
													if((typeof text) == 'string'){
													var herr = text.split(';');
													var str = "";
													for(var i =0; i < herr.length; i++)
													{
														str+='<option>'+ herr[i]+'</option>';
													}
													return new Handlebars.SafeString(str);
													}else{
														
														var str = "";
													for(var i = 0; i < text.length; i++)
													{
														str+='<option>'+ text[i]+'</option>';
													}
													//console.log(str);
													return new Handlebars.SafeString(str);
													}
												});
												
												
												Handlebars.registerHelper('OKRYGLIT', function(text) {
												  text = Handlebars.escapeExpression(text);      //экранирование выражения
											


											//var r = parseFloat(text).toFixed(2));
												  return new Handlebars.SafeString(r);
												});
												
							
								Handlebars.registerHelper('APPENHTMLFROOB', function(textm,text) {
												var str ="";
												for(var k in textm)
												{
													 str+= "<span id='"+text+k+"'>"+textm[k]+"<a href=''> x </a></span>";
												}
												  return new Handlebars.SafeString(str);
								});


								
								
							var sour = $("#items").html();
							var template = Handlebars.compile(sour);
							
							var sour2 = $("#cetegor").html();
							var template2 = Handlebars.compile(sour2);
							
							
							var rr = JSON.parse(data);
							var o = { 
										test: rr.items,  
										pagination: rr.pagination,
										filter: rr.filter
									}
									
									var zapisi = 'Показаны '+rr.pag_from+' - '+ rr.pag_to + ' из ' + rr.count_fields;
							$(".count_fielsa").html(zapisi);
							$("#pagination").html(rr.pagination);
									
									//console.log(JSON.parse(o.filter));
							var elem = template(o);
							var elem2 = template2(JSON.parse(o.filter));
							if(rr.items.length == 0)
								elem = "<p class='alert alert-danger'>К сожалению, товара с выбранным фильтром нету</p>";
							$(".products-grid").html(elem);
							//console.log(o.filter);
							$(".filters").html(elem2);
							setTimeout(function(){
						
													var i = 0;
											$('#filter_items input:checkbox:checked').each(function(){
												i++;
											});
													if(i > 0)
														$(".filters").append("<span  id='reset_form' style=' background: #fff;'><a style='color: #000;' href=''>Сбросить  все</a></span>");
													else{
														$(".filters").html();
													}

							});

						},
						beforeSend: function(){
							$(".products-grid").html('<img style="width:100%;max-width:250px"  src="/images/squares.gif" />');
							$("#pagination ul").remove();
						},
						complete:function(){
									
				
				
				if($("#view_list").hasClass("active"))
				{
				$(".p_slice").hide();
			$(".p_description").show();
			$(".label-product").addClass('label-product_list');
				$(".label-product").removeClass("label-product");
			
			
			
		
			
			$(".label-product>span").css({
				
					'left': '0'
			});
			
			
			
			$(".product-image").css({
				
					'margin-left':' 33px'
			});
			
			$(".desc_grid-image").css({
				
					   'width': '50%',
				'display': 'inline-block',
				'text-align': 'justify'		});
			
			
		$(".vvv").css({
					'display': 'inline-block',
					'margin-left':'7px'
						});
					
					$(".vvv").addClass('');
			
		$(".desc_grid").css({
				    'width': '67%',
					'text-align': 'justify',
					'display': 'inline-block',
					'overflow': 'hidden',
					'max-height': '110px',
	'border-right':'1px solid'	,'padding-right':'14px'	,
					'vertical-align': 'top'			});
			
			
			
			
			$(this).css('color','red');
			$("#view_grid").css('color','blue');
			
			$(".item").css({
				
				'overflow': 'hidden',
				'text-align': 'left',
				'position': 'relative',
				'margin':' 0 0 20px',
				'width': '100%'
				
			});
			
			$(".grid_wrap").css({
				'padding': '10px'
			});
			
			$(" .product-image, .products-list .product-image").css({
				'width': '210px',
				' display': 'inline-block'
			});

			$(".product-image, .products-list .product-image").css({
				'float': 'left',
				'margin': '0 10px 0 35px',
				'width': '110px',
				'overflow': 'hidden'
				
			});
			
			$(".product-shop, .products-list .product-shop").css({
				'overflow': 'hidden'
			});
			
			$(".product-shop").css({
				'position': 'relative'
			});
				
			}
						}
						
						
					});
					
				
					
					
						


			
			
			

		
		
		
		});
		
		
		
	$(".basket").bind('click',function(){
			$.ajax({
						type : 'POST',
						url : '/ajax/getBasket',
						data : {'insertBasket':1,},
						success : function(data) {
							
							Handlebars.registerHelper('link', function(text, url) {
							  url = Handlebars.escapeExpression(url);      //экранирование выражения
							  text = Handlebars.escapeExpression(text);
							  var r = parseInt(text)*parseInt(url);
							  return new Handlebars.SafeString(r);
							});
							var sour = $("#entry-template").html();
							var template = Handlebars.compile(sour);
							var rr = JSON.parse(data);
							var o = { 
										test: rr.items,  
										bla: rr.summ 
									}
									
									$("#basket_box h1 span").text(rr.summ+' грн');
									$(".basket  span.summ").text(rr.summ);
									$(".basket  span.count").text((1*rr.allitems));

					
							var elem = template(o);
							$("#renderher").html(elem);
							

						}
					});

		
	});
			
			
		setInterval('switch_img()',1000);
		
		$("#toogleFiltr").bind('click',function(){
			$("#filtr").fadeToggle()
			setTimeout(rowss,500);
		});
		
		
		$(".basket").bind('click',function(){
			
			
			
			
			if(!$('#basket_box').is(':visible'))
			{
				$(".basket span").css('color','#fff');
				$(this).css({
					
					'background':'#005387',
					'color':'#fff'
				});
			}else{$(".basket span").css('color','');
				$(this).css({
					
					'background':'',
					'color':''
				});
			}
			
			$("#basket_box").fadeToggle();
		});
		
		
		$("body").bind('click',function(){
			
			setTimeout('new_fcn()',200);
			
			
		});
		
		
		
		
	});

	function new_fcn(){
		if(!$('#basket_box').is(':hover') && !$('.basket').is(':hover')){
			$("#basket_box").fadeOut();
			$(".basket").css({
				'background':'',
				'color':''
			});
			
			$(".basket span").css({
				'background':'',
				'color':''
			});
		}
		
	}

	function rowss(){
		
		if($('#filtr').is(':visible'))
		{
			$("#toogleFiltr i").removeClass("fa-arrow-circle-down");
			$("#toogleFiltr i").addClass("fa-arrow-circle-up");
			
			
		}else{
			
			$("#toogleFiltr i").addClass("fa-arrow-circle-down");
			$("#toogleFiltr i").removeClass("fa-arrow-circle-up");
			
		}
		
	}

	$(function () {
		
		
		$("#btnFilter").hide();
		
		$("#show_search").bind('click',function(){
			$("#seacrh-hide").fadeToggle();
		});

		$("#range").ionRangeSlider({
			hide_min_max: true,
			keyboard: true,
			min: 100,
			force_edges: true,
			max: 800,
			from: 100,
			to: 800,
			type: 'double',
			step: 1,
			onChange: changeSlider,
			grid: true,
			postfix: 'грн'
		});
		
		var sliderss = $("#range").data("ionRangeSlider");
		
		function changeSlider(e){
			$("#slider_from").val(e.from);
			$("#slider_to").val(e.to);
		}
		
		$("#slider_from").bind('keyup',function(){
			
			
			//console.log($("#slider_from").val());
			if(parseInt(($("#slider_from").val())) > parseInt($("#slider_to").val()))
				$("#slider_from").val($("#slider_to").val());
			
			sliderss.update({
				from: $("#slider_from").val()
				
			});
			
		});
		
		$("#slider_to").bind('change',function(){
			
			
			if(parseInt(($("#slider_to").val())) < parseInt($("#slider_from").val()))
				$("#slider_to").val($("#slider_from").val());
			
			sliderss.update({
				to:  $("#slider_to").val()
			});
			
		});
		
		
		
		$("#view_list").bind('click',function(){
			$(this).addClass('active');
			$("#view_grid").removeClass('active');
			$("#view_list").attr('class','active');
			$(".p_slice").hide();
			$(".p_description").show();
			$(".label-product").addClass('label-product_list');
				$(".label-product").removeClass("label-product");
			
			
			
		
			
			$(".label-product>span").css({
				
					'left': '0'
			});
			
			
			
			$(".product-image").css({
				
					'margin-left':' 33px'
			});
			
			$(".desc_grid-image").css({
				
					   'width': '50%',
				'display': 'inline-block',
				'text-align': 'justify'		});
			
			
			$(".vvv").css({
					'display': 'inline-block',
					'margin-left':'7px'
						});
					
					$(".vvv").addClass('');
			
		$(".desc_grid").css({
				    'width': '67%',
					'text-align': 'justify',
					'display': 'inline-block',
					'overflow': 'hidden',
					'max-height': '110px',
	'border-right':'1px solid'	,'padding-right':'14px'	,
					'vertical-align': 'top'			});
			
			
			
			
			
			$(this).css('color','red');
			$("#view_grid").css('color','blue');
			
			$(".item").css({
				
				'overflow': 'hidden',
				'text-align': 'left',
				'position': 'relative',
				'margin':' 0 0 20px',
				'width': '100%'
				
			});
			
			$(".grid_wrap").css({
				'padding': '10px'
			});
			
			$(" .product-image, .products-list .product-image").css({
				'width': '210px',
				' display': 'inline-block'
			});

			$(".product-image, .products-list .product-image").css({
				'float': 'left',
				'margin': '0 10px 0 35px',
				'width': '110px',
				'overflow': 'hidden'
				
			});
			
			$(".product-shop, .products-list .product-shop").css({
				'overflow': 'hidden'
			});
			
			$(".product-shop").css({
				'position': 'relative'
			});
			
			
		});
		
		
		$("#view_grid").bind('click',function(){
			$(this).addClass('active');
			$("#view_list").removeClass('active');
			$(this).css('color','red');
			$("#view_list").css('color','blue');
			$(".p_slice").show();
			$(".p_description").hide();
			$(".item").css({
				
				'overflow': '',
				'text-align': '',
				'position': '',
				'margin':'',
				'width': ''
				
			});
			
			$(".grid_wrap").css({
				'padding': ''
			});
			
			$(" .product-image, .products-list .product-image").css({
				'width': '',
				' display': ''
			});

			$(".product-image, .products-list .product-image").css({
				'float': '',
				'margin': '',
				'width': '',
				'overflow': ''
				
			});
			
			$(".product-shop, .products-list .product-shop").css({
				'overflow': ''
			});
			
			$(".product-shop").css({
				'position': ''
			});
			
			
				$(".label-product_list").addClass('label-product');
				$(".label-product_list").removeClass("label-product_list");
			
			
			
		
			
			$(".label-product>span").css({
				
					'left': ''
			});
			
			
			
			$(".product-image").css({
				
					'margin-left':' '
			});
			
			$(".desc_grid-image").css({
				
					   'width': '',
				'display': '',
				'text-align': ''		});
			
			
			$(".vvv").css({
					'display': '',
					'margin-left':''
						});
					
			$(".vvv").removeClass('pull-right');
			
			$(".desc_grid").css({
				    'width': '',
					'text-align': '',
					'display': '',
					'overflow': '',
					'max-height': '',
					'border-right':'',
					'padding-right':'','vertical-align':''			
			});
			
			
		});
		
		
					

		
		$("body").on("click", ".removs", function () {
			var id = $(this).text();
			var summ = $(this).parent().find('span.summo').text();
			
			
			var summ_all = $(".basket span.summ").text();
			//console.log(summ);
				//console.log(summ_all);
				
			var tek_summ = parseInt(summ_all) - parseInt(summ);
			 $("#basket_box h1 span").text(tek_summ+' грн');
			  $(".basket span.summ").text(tek_summ);
			  
			  
			  $(".basket span.count").text(parseInt($(".basket span.count").text())- parseInt($(this).parent().find('span.cultu').text()));
			  
			  
			//console.log(summ);
	      $(this).parent().remove();
		  $(".id"+id).parent().parent().remove();
		 var ttt = $('#renderher tr').length;
		 if(ttt == 0)
		 {
			 var text = '<p>Корзнина пуста</p>';
			 $('#renderher').html(text);
		 }
		  
		  $.ajax({
						type : 'POST',
						url : '/ajax/unsetCart',
						data : {'id':id},
						success : function(data) {
						}
					});
					
					
					var elementary = $(".basket span.count").text();
		var elementary2 = $(".basket span.summ").text();
		$("p.count span").text(elementary);
		$("p.summ span").text(elementary2);
	    });
		

	});
		$(function() {

		$( '#mi-slider' ).catslider();

	});




	function add_basket(id,title,el) {
		
		$(el).attr("disabled","disabled");
		var im =($(el).parents("div.item"))[0];
		
		
		 var qqq =$(el).parents('.item').find('select')[0];;
		 var qq = $(qqq).val();
		qq = qq.split('_'); 
		var conterss;
		if(qq[0] == 'complect')
		 conterss = qq[1];else conterss = 1;
	 
		var summ4 = $(im).find('span.price').text();
		
			summ4 = parseInt(summ4.split('грн')[0]);
		var summ5 = parseInt($(".basket span.summ").text())*1;
		var summ6 = parseInt(summ4)*conterss+summ5;
		$(".basket span.summ").text(summ6);
		

			
		var imgg =$(im).find('img');
		var img = $(imgg[0]);
		
	//console.log(img);
		var top2= $("div.basket i").offset().top;
		var left2= $("div.basket i").offset().left;
		
			
			
		var top1= $(img).offset().top;
		var left1= $(img).offset().left;
		
		
		$(img).parent().css('overflow','inherit');
		$(img).parents('.item').css('overflow','inherit');
			
		var top = top2-top1-(parseInt($(img).css('height')))/2;
		
	
		var left = left2-left1 +(parseInt($(img).css('width')))/2;
		var arr = true;
		var elemm = $(img).clone();
			$(elemm).css({
					    'z-index': '99999',
						'position': 'absolute',
						'width':'80%'
			});
			
		$(img).before(elemm);
			if(!($("div.basket i").offset().top - $(window).scrollTop() < -10 )){
			$(elemm).animate({ x: left+'px',y: top+'px',scale:'0.00001',opacity:'0.01',rotate:1500},
							{'duration': 800,
								step: function(){
									if(($(elemm).offset().top - $("div.basket").offset().top) < 80 && arr == true){
										
										$("div.basket span.count ").transition(
																	{'font-size':'16px','color':'red'},100,
																	
																 function(){
																	 $(elemm).remove();
																	  var elll =$(el).parents('.item').find('select')[0];;
																	  var df = $(elll).val();
												
																	  df = df.split('_'); 
																	  var conter;
																	 if(df[0] == 'complect')
																		 conter = df[1];else conter = 1;
																	 	$(".basket span.count").text(parseInt($(".basket span.count").text())+parseInt(conter));
																																			$(img).parent().css('overflow','');
																																			var elementary = $(".basket span.count").text();
					
								var elementary2 = $(".basket span.summ").text();
								$("p.count span").text(elementary);
								$("p.summ span").text(elementary2);
																		$(img).parents('.item').css('overflow','');
																		$(el).removeAttr("disabled");

																			$("div.basket span.count ").transition({'font-size':'','color':''},800);
																		}
																	
										
									);  arr =false;
									}
								}
							});
			}else{
				
				
				
					var arr =true;
					
					$(elemm).animate({ x: left+'px',y:-($(window).height()-120)+'px',scale:'0.00001',opacity:'0.01',rotate:1100},
							{'duration': 1000,
								step: function(){
								
								
								},
								complete:function(){
												$("div.basket span.count ").transition(
																	{'font-size':'16px','color':'red'},100,
																	
																 function(){
																	 $(elemm).remove();
																	  var elll =$(el).parents('.item').find('select')[0];;
																	  var df = $(elll).val();
												
																	  df = df.split('_'); 
																	  var conter;
																	 if(df[0] == 'complect')
																		 conter = df[1];else conter = 1;
																	 	$(".basket span.count").text(parseInt($(".basket span.count").text())+parseInt(conter));
																																			$(img).parent().css('overflow','');
																																			var elementary = $(".basket span.count").text();
					
								var elementary2 = $(".basket span.summ").text();
								$("p.count span").text(elementary);
								$("p.summ span").text(elementary2);
																		$(img).parents('.item').css('overflow','');
																		$(el).removeAttr("disabled");

																			$("div.basket span.count ").transition({'font-size':'','color':''},800);
																		}
																	
										
									);  arr =false;
								}
							});
				
				
				
				
				
				
				
				
			}
			

			
			
					
					
					
					var text = '<div id="opovewanie" style="position:fixed">'+title+' ( Размер ' + $("#sss"+id).val()+') добавлен в корзину</div>';
					$(".opovewanie").html(text);
					$("#opovewanie").animate({"opacity":"0"},2000,'swing');
					
					$.ajax({
						type : 'POST',
						url : '/ajax/InsertBasket/id'+id,
						data : {'insertBasket':id,'size':$("#sss"+id).val()},
						success : function(data) {
								Handlebars.registerHelper('link', function(text, url) {
							  url = Handlebars.escapeExpression(url);      //экранирование выражения
							  text = Handlebars.escapeExpression(text);
							  var r = parseInt(text)*parseInt(url);
							  return new Handlebars.SafeString(r);
							});
							var sour = $("#entry-template").html();
							var template = Handlebars.compile(sour);
							var rr = JSON.parse(data);
							var o = { 
										test: rr.items,  
										bla: rr.summ 
									}
									
									

					
							var elem = template(o);
							$("#renderher").html(elem);
							$(".renderher").html(elem);
							
						
						},
						beforeSend:function(){

							
						}
					});
					
						
								
				}
				
			
			
	$(document).ready(function(){
		
	
		
		$("body").on("click", ".filters span a", function () {
			
			
				if(($(this).parent().attr('id')) == 'reset_form')
				{
					$('#filter_items').trigger( 'reset' );

					$(".filters").html('');
				}
					
		
		
			var gg = $( "input[name='"+$(this).parent().attr('id')+"']" );
			gg.prop("checked", false);
			
			
					$.ajax({
						type : 'POST',
						url : '/ajax/getItems',
						data : $("#filter_items").serialize()+'&'+$("#filter_summ").serialize()+'&'+'sort='+$("#sort").val(),
						success : function(data) {
						//	console.log(data);
												Handlebars.registerHelper('link', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)*parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PLUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)+parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('MINUS', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)-parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												
												
												Handlebars.registerHelper('DROWNEW', function(text) {
												var date = new Date();
												if(date.getTime()/1000 - parseInt(text)  > cound_date_new)
												  return new Handlebars.SafeString("hidden");
												});
												
												
												Handlebars.registerHelper('PODELIT', function(text, url) {
												  url = Handlebars.escapeExpression(url);      //экранирование выражения
												  text = Handlebars.escapeExpression(text);
												  var r = parseInt(text)/parseInt(url);
												  return new Handlebars.SafeString(r);
												});
												
												Handlebars.registerHelper('PISATCENU', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													var r = (100-d)/100*p;
												else
													var r = p;
												
												  return new Handlebars.SafeString(r.toFixed());
												});
												
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
													Handlebars.registerHelper('ESTNASKLADE', function(sklad) {
												 
													if(parseInt(sklad) > 0)
													
													return new Handlebars.SafeString("hidden");
												});
												
												Handlebars.registerHelper('OLDCENA', function(discount, price_roz) {
												 
												 var d = parseFloat(discount);
												  var p = parseFloat(price_roz);
												 
												 
												 if(d > 0)
													return new Handlebars.SafeString(p.toFixed()+'&nbsp;грн');
												});
												
												
												
												
												
													Handlebars.registerHelper('ESTNASKLADEe', function(sklad) {
												 
													if(parseInt(sklad) == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('DISCOUNT', function(DISCOUNT) {
												 
													if(DISCOUNT == 0)
														return new Handlebars.SafeString("hidden ");
												});
												
												
												Handlebars.registerHelper('APPENHTML', function(text) {
												 
													$("#pagination").html(text);
												});
												
												
												
												Handlebars.registerHelper('PODD', function(text) {
													if((typeof text) == 'string'){
													var herr = text.split(';');
													var str = "";
													for(var i =0; i < herr.length; i++)
													{
														str+='<option>'+ herr[i]+'</option>';
													}
													return new Handlebars.SafeString(str);
													}else{
														
														var str = "";
													for(var i = 0; i < text.length; i++)
													{
														str+='<option>'+ text[i]+'</option>';
													}
													//console.log(str);
													return new Handlebars.SafeString(str);
													}
												});
												
												
												Handlebars.registerHelper('OKRYGLIT', function(text) {
												  text = Handlebars.escapeExpression(text);      //экранирование выражения
											


											//var r = parseFloat(text).toFixed(2));
												  return new Handlebars.SafeString(r);
												});
												
							
								Handlebars.registerHelper('APPENHTMLFROOB', function(textm,text) {
												var str ="";
												for(var k in textm)
												{
													 str+= "<span id='"+text+k+"'>"+textm[k]+"<a href=''> x </a></span>";
												}
	
												  return new Handlebars.SafeString(str);
								});						
							var sour = $("#items").html();
							var template = Handlebars.compile(sour);
							
							var sour2 = $("#cetegor").html();
							var template2 = Handlebars.compile(sour2);
							
							
							var rr = JSON.parse(data);
							var o = { 
										test: rr.items,  
										pagination: rr.pagination,
										filter: rr.filter
									}
									
									
							$("#pagination").html(rr.pagination);
									
								//	console.log(JSON.parse(o.filter));
							var elem = template(o);
							var elem2 = template2(JSON.parse(o.filter));
							if(rr.items.length == 0)
								elem = "<p class='alert alert-danger'>К сожалению, товара с выбранным фильтром нету</p>";
							$(".products-grid").html(elem);
							//console.log(o.filter);
							$(".filters").html(elem2);
							
							var zapisi = 'Показаны '+rr.pag_from+' - '+ rr.pag_to + ' из ' + rr.count_fields;
							$(".count_fielsa").html(zapisi);
										setTimeout(function(){
						
													var i = 0;
											$('#filter_items input:checkbox:checked').each(function(){
												i++;
											});
													if(i > 0)
														$(".filters").append("<span  id='reset_form' style=' background: #fff;'><a style='color: #000;' href=''>Сбросить  все</a></span>");
													else{
														$(".filters").html();
													}

							});
							
						},
						beforeSend: function(){
							$(".products-grid").html('<img style="width:100%;max-width:250px"  src="/images/squares.gif" />');
							$("#pagination ul").remove();
						},
						complete:function(){
							if($("#view_list").hasClass("active"))
				{
				$(".p_slice").hide();
			$(".p_description").show();
			$(".label-product").addClass('label-product_list');
				$(".label-product").removeClass("label-product");
			
			
			
		
			
			$(".label-product>span").css({
				
					'left': '0'
			});
			
			
			
			$(".product-image").css({
				
					'margin-left':' 33px'
			});
			
			$(".desc_grid-image").css({
				
					   'width': '50%',
				'display': 'inline-block',
				'text-align': 'justify'		});
			
			
		$(".vvv").css({
					'display': 'inline-block',
					'margin-left':'7px'
						});
					
					$(".vvv").addClass('');
			
			$(".desc_grid").css({
				    'width': '67%',
					'text-align': 'justify',
					'display': 'inline-block',
					'overflow': 'hidden',
					'max-height': '110px',
	'border-right':'1px solid'	,'padding-right':'14px'	,
					'vertical-align': 'top'			});
			
			
			
			
			$(this).css('color','red');
			$("#view_grid").css('color','blue');
			
			$(".item").css({
				
				'overflow': 'hidden',
				'text-align': 'left',
				'position': 'relative',
				'margin':' 0 0 20px',
				'width': '100%'
				
			});
			
			$(".grid_wrap").css({
				'padding': '10px'
			});
			
			$(" .product-image, .products-list .product-image").css({
				'width': '210px',
				' display': 'inline-block'
			});

			$(".product-image, .products-list .product-image").css({
				'float': 'left',
				'margin': '0 10px 0 35px',
				'width': '110px',
				'overflow': 'hidden'
				
			});
			
			$(".product-shop, .products-list .product-shop").css({
				'overflow': 'hidden'
			});
			
			$(".product-shop").css({
				'position': 'relative'
			});
				
			}
						}
						
						
					});
					
	return false;
		});
		
		$(".sort").css('display','block');
	});