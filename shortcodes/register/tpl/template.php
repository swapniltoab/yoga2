<form id ="registerform" name="registerform" method="post" accept-charset="UTF-8" style="display:none">

  <div class="container">

    <h1>SIGN UP</h1>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="username"><b>EMAIL</b></label>
      <div class="col-md-9">
        <input type="email" class="js-required form-input js-email" name="username" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="password"><b>PASSWORD</b></label>
      <div class="col-md-9">
        <input type="password" class="js-required form-input js-pass" name="password" id="password1" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" class="col-md-3" for="password_repeat"><b>CONFIRM PASSWORD</b></label>
      <div class="col-md-9">
        <input type="password" class="js-required form-input" name="password_repeat" id="confirm_password" required><br><hr>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="firstName" id="firstName"><b>FIRST NAME</b></label>
      <div class="col-md-9">
        <input type="text" class="js-required form-input js-text-only" name="firstName" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="lastName"><b>LAST NAME</b></label>
      <div class="col-md-9">
        <input type="text" class="js-required form-input js-text-only" name="lastName" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="phone"><b>PHONE NUMBER</b></label>
      <div class="col-md-9">
        <input type="tel" class="js-required form-input js-mob" name="phone" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="address"><b>ADDRESS</b></label>
      <div class="col-md-9">
        <input type="text" class="js-required form-input" name="address" required>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="city"><b>CITY</b></label>
      <div class="col-md-9">
        <input type="text" class="js-required form-input" name="city" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="state"><b>STATE</b></label>
      <div class="col-md-9">
        <select id="state" class="form-input js-required" name="state" required>
          <option value="">Select State</option>
          <?php
          $optionsHTML = '';
          foreach($states as $key => $val) :
              $optionsHTML .= '<option value="'.$key.'">'.$val.'</option>';
          endforeach;
          echo $optionsHTML;
          ?>
        </select><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="zip"><b>Zip</b></label>
      <div class="col-md-9">
        <input type="text" maxlength="5" class="js-required form-input js-zip" name="zip" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="form-group row">

      <label class="col-md-3 form-label" for="birthDate">Date of Birth:</label>

      <div class="col-md-9 wrap-form-grp">

        <div class="js-form-control">
          <select id="selectMonth" class="form-input js-required" name="selectMonth" style="width:auto;" class="form-control">
            <option value="">Month</option>
            <?php
              $months = array("January" => "01",
                  "February" => "02",
                  "March" => "03",
                  "April" => "04",
                  "May" => "05",
                  "June" => "06",
                  "July" => "07",
                  "August" => "08",
                  "September" => "09",
                  "October" => "10",
                  "November" => "11",
                  "December" => "12",
              );
              foreach ($months as $monthname => $month) {?>
            <option class="" value="<?php echo $month ?>"><?php echo $monthname ?></option>
            <?php }?>
          </select>
          <span class="error-message" style="color:red"></span>
        </div>

        <div class="js-form-control">
          <select id="selectDate" class="js-required" name="selectDate" style="width:auto;" class="form-control">
            <option class="" value=" ">D</option>
            <?php for ($i = 1; $i <= 31; $i++) {?>
              <option class="" value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php }?>
          </select>
          <span class="error-message" style="color:red"></span>
        </div>

        <div class="js-form-control">
          <select id="selectYear" class="js-required" name="selectYear" style="width:auto;" class="form-control">
            <?php for ($i = date('Y'); $i >= 1900; $i--) {?>
              <option class="" value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php }?>
          </select>
          <span class="error-message" style="color:red"></span>
        </div>

      </div>

    </div>

    <div class="row">
      <label class="col-md-9 custom-control agreeTerms-check">
        <input type="checkbox" name="agreeTerms" style="margin-bottom:15px" required>I understand and accept <a href="#">Terms & Conditions</a>
      </label><br>
    </div>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9">
        <input id= "btn_register" type="submit" value="Submit" class="btn">
      </div>
    </div>

  </div>

</form>