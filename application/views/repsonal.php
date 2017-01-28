 
 <style>
 .box-heading{
	     font-weight: 300;
    padding: 10px 10px 10px 0px;
    border-bottom: 1px solid #dddddd;
    position: relative;
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 20px;
 }
 p{
	     margin-top: 0px;
    margin-bottom: 15px;
    line-height: 21px;
    margin: 0 0 10px;
    text-align: justify;
 }
 </style>
 <div id="content" class="col-md-12 col-sm-12">
	<div style='    width: 100%;
    width: 750px;
    margin: 0 auto;
    max-width: 100%;
    background: #fff;
    padding: 17px;
    margin: 15px auto;'>
    <div id="social_login_content_holder"></div>
  <h1 style='    margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;'>Авторизация</h1>
        <div class="row">
        <div class="col-sm-6 margin-b">
            <div class="box-heading">Новый клиент</div>
            <p>Создание учетной записи поможет покупать быстрее. Вы сможете контролировать состояние заказа, а также просматривать заказы сделанные ранее. Вы сможете накапливать призовые баллы и получать скидочные купоны. <BR>А постоянным покупателям мы предлагаем гибкую систему скидок и персональное обслуживание.<BR></p>
            <a href="personal/register" class="btn btn-success">Регистрация</a>
        </div>
        
        <div class="col-sm-6">
            <div class="box-heading">Зарегистрированный клиент</div>
            <p>Войти в Личный Кабинет</p>
           <form action="/personal/login" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label" for="input-email">E-Mail</label>
                <input type="text" name="email" value="" placeholder="E-Mail" id="input-email" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password">Пароль</label>
                <input type="password" name="password" value="" placeholder="Пароль" id="input-password" class="form-control" />
                <a href="personal/forgotten" class="pull-right login-forgotten">Забыли пароль?</a></div>
              <input type="submit" class='btn btn-success'  value="Войти" class="button" />
           </form>
        </div>
      </div>
      </div>
	</div>
	  
	  
	  