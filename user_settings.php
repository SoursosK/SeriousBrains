<link rel="stylesheet" type="text/css" href="css/settings.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

<div class="container">
  <div class="card-body">
    <h1 class="card-title text-center">User Information</h1>
    <br>
    <div class="form-signin">
      <div class="form-row form-label">
        <div class="custom-control custom-checkbox my-3 ml-3">
          <input type="checkbox" class="custom-control-input" id="change_password" onclick="pass()">
          <label class="custom-control-label" for="change_password">Change Password</label>
        </div>

        <div class="form-label-group col">
          <input type="password" id="new_password" class="form-control" disabled=true placeholder="New Password" required>
          <label for="new_password">New Password</label>
        </div>

        <div class="form-label-group col">
          <input type="password" id="conf_password" class="form-control" disabled=true placeholder="Confirm Password" required>
          <label for="conf_password">Confirm New Password</label>
        </div>

      </div>

      <div class="form-label-group">
        <input type="gender" id="gender" class="form-control" placeholder="Gender" required autofocus>
        <label for="gender">Gender</label>
      </div>

      <div class="form-label-group">
        <input type="city" id="city" class="form-control" placeholder="City" required autofocus>
        <label for="city">City</label>
      </div>

      <div class="form-label-group">
        <input type="birthday" id="birthday" class="form-control datetime" placeholder="Birthday" required autofocus>
        <label for="birthday">Birthday</label>
      </div>

      <div class="form-label-group">
        <input type="education" id="education" class="form-control" placeholder="Education" required autofocus>
        <label for="education">Education</label>
      </div>

      <div class="form-label-group text-center" id="difficulty">

        <div class="custom-control custom-control-inline">
          <label>Select difficulty:</label>
        </div>

        <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" checked=true class="custom-control-input" id="difficulty1" name="difficulty">
          <label class="custom-control-label" for="difficulty1">Easy</label>
        </div>

        <!-- Default inline 2-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="difficulty2" name="difficulty">
          <label class="custom-control-label" for="difficulty2">Intermediate</label>
        </div>

        <!-- Default inline 3-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="difficulty3" name="difficulty">
          <label class="custom-control-label" for="difficulty3">Advanced</label>
        </div>

        <!-- Default inline 4-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="difficulty4" name="difficulty">
          <label class="custom-control-label" for="difficulty4">Gradual (Easy - Advanced)</label>
        </div>

        <!-- Default inline 5-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="difficulty5" name="difficulty">
          <label class="custom-control-label" for="difficulty5">Gradual (Easy - Intermediate)</label>
        </div>
      </div>

      <div id="error" class="form-label-group text-center" style="color:red;">
      </div>

      <div class="form-label-group">
        <input type="password" id="password" class="form-control" placeholder="Password" required>
        <label for="password">Confirm Password</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" onclick="registerCredentials()">Update Info</button>
    </div>
  </div>
</div>