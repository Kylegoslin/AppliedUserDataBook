<head>
<link rel="stylesheet" href="Bootstrap.min.css" crossorigin="anonymous">
<script src="jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" 
        crossorigin="anonymous">
</script>
<script src="Bootstrap.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
}
button {
    background-color: grey;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
button:hover {
    opacity: 0.8;
}
</style>
</head>     
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="#">Feedback Dashboard</a>
    </nav>
<main role="main">
<div class="jumbotron">
<div class="mx-auto" style="width:300px">
    <h1>Register</h1>
    <p> Register for a new account</p>
    <form id="register">
        <label><b>Username</b></label>
        <input type="text" id="username"/>
        <label><b>E-mail Address</b></label>
        <input type="text" id="email"/>
        <label><b>Password</b></label>
        <input type="password" id="password1"/>
        <label><b>Repeat Password</b></label>
        <input type="password" id="password2"/>
        <button type="submit">Register</button>
        <span id="message"></span>
    </form>
</div>
</div>
</main>
</div>


<div class="modal" id="nowRegistered" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="width:100%">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                style="width:100px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are now registered.</p>
        <p>Click to login!</a></p>
      </div>
      <div class="modal-footer">
       
        <a href="index.php" class="btn btn-primary" role="button">Login!</a>
      </div>
    </div>
  </div>
</div>

<script>
$( "#register" ).submit(function( event ) {
    var valid = true;
    event.preventDefault();
    // Username
    var un = $("#username").val();  
    if(un == "" ){
        $('#message').append('Username blank.<br>');
        valid = false;
    }
    // Email
    var email = $("#email").val();  
    if(email == "" ){
        $('#message').append('E-mail blank. <br>');
        valid = false;
    } 
    // Password
    var pw1 = $("#password1").val();
    var pw2 = $("#password2").val();  
    if(pw1 == "" || pw2 == ""){
        $('#message').append('Password blank.<br>');
        valid = false;
    }
    if(pw1 != pw2){
        $('#message').append('Sorry your passwords do not match.<br>');
        valid = false;
    } 
    // If valid, then perform the post request 
    if(valid == true){
        $.post( "ajax.php", { type:"register", username: un, password: pw1, 
                                      email: email })
        .done(function( data ) {
        if(data == 'registered'){
            // Show modal   
            $("#nowRegistered").modal();
    
        } else {
            $('#message').text('Sorry registration failed.');
        }
       }); 
}
 
});
</script>