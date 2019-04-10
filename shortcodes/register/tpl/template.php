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
        <input type="text" class="js-required form-input js-text-only" name="city" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="state"><b>STATE</b></label>
      <div class="col-md-9">
        <select id="state" class="form-input js-required" name="state" required>
          <option value="">Select State</option>
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    </select><br>
                                    <span class="error-message" style="color:red"></span>
                                  </div>
                                </div>

    <div class="js-form-control row">
      <label class="col-md-3 form-label" for="zip"><b>Zip</b></label>
      <div class="col-md-9">
        <input type="text" class="js-required form-input js-zip" name="zip" required><br>
        <span class="error-message" style="color:red"></span>
      </div>
    </div>

    <!--<div class="form-check-inline js-form-control row" required>

      <label class="col-md-3 form-label" for="region">
      <b>Region</b>
      </label>

      <div class="col-md-9">
        <div class="form-check-inline">
          <label class="form-check-label" for="region">
            <input type="radio" class="" id="radio1" name="region" value="newyork" checked>New York
          </label>
        </div>

        <div class="form-check-inline">
          <label class="form-check-label" for="region">
            <input type="radio" class="" id="radio2" name="region" value="losangeles">Los Angeles
          </label>
        </div>

        <div class="form-check-inline">
          <label class="form-check-label" for="region">
            <input type="radio" class="" id="radio3" name="region" value="sanfrancisco">San Francisco
          </label>
        </div>
        <span class="error-message" style="color:red"></span>
      </div>
    </div> -->

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