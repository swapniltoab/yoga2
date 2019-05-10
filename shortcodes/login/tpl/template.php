<!-- Login Form - Start -->

<form id ="loginform" name="loginform" method="post" accept-charset="UTF-8">
  <div class="container">

    <h2>Sign In</h2>
    <p>Already have an account ...</p>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="username"><b>EMAIL</b></label>
      <div class="col-md-9">
        <input type="email" id="login_email" class="form-input" name="username" required><br>
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
        <div class="col-md-6">
          <input id= "btn_login" class="btn" type="submit" value="Login">
        </div>
        <div class="col-md-6">
          <a href="javscript:void(0)" class="js-login-forgot-password" >Forgot Your Password?</a>
        </div>
      </div>

  </div>
</form>

<!-- Login Form - End -->


<!-- Forgot Password Form - Start -->

<form id ="forgotPasswordForm" name="forgotPasswordForm" method="post" accept-charset="UTF-8" class="hideElement">
  <div class="container">

    <h2>Forgot Password</h2>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="username"><b>EMAIL</b></label>
      <div class="col-md-9">
        <input type="email" id="forgot_email" class="form-input" name="username" required><br>
        <span class="error-message" id="error_forgot_email" style="color:red"></span>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <?php wp_nonce_field('yoga-forgot-nonce', 'yoga-forgot-nonce', true, true);?>
        <input id="btn_login_forgot_password" class="btn" type="submit" value="Send Reset Link">
      </div>
      <div class="col-md-6">
        <a href="javscript:void(0)" class="js-back-to-login" >Back to sign in</a>
      </div>
    </div>

  </div>
</form>

<!-- Forgot Password Form - End -->