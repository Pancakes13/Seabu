<?php
    require("../assets/stylesheets.php");
?>
<!doctype html>
    <body class="bg-light">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="index.html">
                            <img class="align-content" src="../images/seabu-logo.png" alt="">
                        </a>
                    </div>
                    <div class="login-form bg-dark" >
                        <div id="loginError" class="alert alert-danger" role="alert"></div>
                        <form id="login">
                            <div class="form-group">
                                <label style="color:white;">Email address</label>
                                <input name="email" type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label style="color:white;">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                            <div class="register-link m-t-15 text-center">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    require("../assets/scripts.php");
?>
<script>
$(document).ready(function(){
  $("#loginError").hide();
  $('#login').submit(function(e) {
    e.preventDefault(); 
    $.ajax({
      type: "POST",
      url: "../queries/get/loginEmployee.php",
      data: $(this).serialize(),
    }).done(function( data ) {
      if (data == 1) {
        window.location.replace("home.php");
      } else {
        $("#loginError").html(data);
        $("#loginError").show();
      }
    })
  });
});
</script>