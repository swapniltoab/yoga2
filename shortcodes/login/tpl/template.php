<form id ="loginform" name="loginform" method="post" accept-charset="UTF-8">

  <div class="container">

    <h2>Sign In</h2>
    <p>Already have an account ...</p>

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

    <div class="row rememberme-sec">
      <div class="">
        <input type="checkbox" class="rememberme" name="rememberme" value="true"><br>
      </div>
      <label class="" for="rememberme"><b>Remember Me</b></label>
    </div>

      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-9">
          <input id= "btn_login" class="btn" type="submit" value="Login">
        </div>
      </div>

  </div>

</form>
