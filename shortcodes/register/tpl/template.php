<form id ="registerform" name="registerform" method="post" accept-charset="UTF-8">  
  <div class="container">
    <h1>SIGN UP</h1>

    <!-- <button>Sign up with Facebook</button><br> -->

    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="username"><b>EMAIL</b></label>
    <div class="col-md-9">
    <input type="email" class="js-required form-input" name="username" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>
    
    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="password"><b>PASSWORD</b></label>
    <div class="col-md-9">
    <input type="password" class="js-required form-input" name="password" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>

    <div class="js-form-control row">
    <label class="col-md-3 form-label" class="col-md-3" for="password_repeat"><b>CONFIRM PASSWORD</b></label>
    <div class="col-md-9">
    <input type="password" class="js-required form-input" name="password_repeat" required><br><hr>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>

    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="firstName" id="firstName"><b>FIRST NAME</b></label>
    <div class="col-md-9">
    <input type="text" class="js-required form-input" name="firstName" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>
    
    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="lastName"><b>LAST NAME</b></label>
    <div class="col-md-9">
    <input type="text" class="js-required form-input" name="lastName" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>

    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="phone"><b>PRIMARY PHONE NUMBER</b></label>
    <div class="col-md-9">
    <input type="tel" class="js-required form-input" name="phone" required><br>
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

    <div class="js-form-control js-required row">
    <label class="col-md-3 form-label" for="state"><b>STATE</b></label>
    <div class="col-md-9">
    <select id="state" class="form-input" name="state" required>
    <option value="selectstate">Select State</option>
    <option value="AL">Alabama</option>
    </select><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>

    <div class="js-form-control row">
    <label class="col-md-3 form-label" for="zip"><b>Zip</b></label>
    <div class="col-md-9">
    <input type="text" class="js-required form-input" name="zip" required><br>
    <span class="error-message" style="color:red"></span>
    </div>
    </div>             

      <div class="form-check-inline js-form-control row" required>
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
      </div>

      <div class="form-group js-form-control row">
        <label class="col-md-3 form-label" for="birthDate">Date of Birth:</label>
        <div class="col-md-9">
          <select id="selectMonth" class="form-input" name="selectMonth" style="width:auto;" class="form-control">
            <option>Month</option>
              <?php 
                // $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
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
                                "December" => "12"
                                );
                foreach ($months as $monthname => $month) {?>
                <option class="" value="<?php echo $month?>"><?php echo $monthname ?></option>
                <?php } ?>
          </select>

          <select id="selectDate" name="selectDate" style="width:auto;" class="form-control">
            <option>D</option>
              <?php for ($i = 1; $i <= 31; $i++) {?>
                <option class=""><?php echo $i ?></option>
                <?php }?>
          </select>

          <select id="selectYear" name="selectYear" style="width:auto;" class="form-control">
            <?php for ($i = 2019; $i >= 1900; $i--) {?>
                <option class=""><?php echo $i ?></option>
                <?php }?>
          </select>
          <span class="error-message" style="color:red"></span>
          </div>
      </div>
      
      <div class="row">
        <div class="col-md-2"></div>
      <label class="col-md-9 custom-control">
        <input type="checkbox" name="agreeTerms" style="margin-bottom:15px" required>I understand and accept Terms & Conditions
      </label><br>
       </div>

      <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9">
      <input id= "btn_register" type="submit" value="Submit">
      </div>
      </div>
  </div>
</form>