<form id ="loginform" name="loginform" method="post" accept-charset="UTF-8" style="display:none">  
  <div class="container">
    <h1>Login</h1>

    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="username"><b>EMAIL</b></label>
    <div class="col-md-9">
    <input type="email" class="form-input" name="username" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>
    
    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="password"><b>PASSWORD</b></label>
    <div class="col-md-9">
    <input type="password" class="form-input" name="password" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>

      <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9">
      <input id= "btn_login" type="submit" value="Login">
      </div>
      </div>
  </div>
</form>