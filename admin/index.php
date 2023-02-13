<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 
<script src="js/jquery.min.js"></script>  
  <script src="js/jquery.validate.js"></script> 
	<script src="js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="simple-login-container">
    <h2>GAT ADMINPANEL</h2>
	<form method="post" action="ajax/login.php" name="login">
		<div class="row">
			<div class="col-md-12 form-group">
				<input type="text" name="email" id="log_email" class="form-control" id="formGroupExampleInput" placeholder="Username and Email">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group">
				<input type="password" name="password" id="password" class="form-control" id="formGroupExampleInput2" placeholder="Password">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" style="
    text-align: center;
">
				<button type="submit" class="btn btn-primary Main_btn_color" id="signup">Login</button>
			</div>
		</div>
    </form>
</div>
<script>
	//login
    $(function() { 
      $("form[name='login']").validate({ 
        rules: {  
          email: {
            required: true, 
            email: true,
            remote: {
              url:"ajax/check_email_exist.php",
              type: "post", 
              data: {
                email: function() {
                return $( "#log_email" ).val();
                }
              }
            }
          },
          password: "required", 
        }, 
        messages: { 
          email: {
            required: "Please enter a valid email address",
            remote: "Email id not exist"
          },
          password: " Please enter your password", 
        }, 
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(), 
                success: function(response) { 
                  //$("#login_otp_message_popup").modal("show"); 
                   window.setTimeout(function(){location.assign("dashboard.php")}, 2000);
                }            
            });
        }
      });
    }); 
</script>
<style>
body{
    background-color:#636569;
    font-size:14px;
    color:#fff;
}
.simple-login-container{
    width:300px;
    max-width:100%;
    margin:50px auto;
}
.simple-login-container h2{
    text-align:center;
    font-size:20px;
}

.simple-login-container .btn-login{
    background-color:#FF5964;
    color:#fff;
}
a{
    color:#fff;
}
</style>