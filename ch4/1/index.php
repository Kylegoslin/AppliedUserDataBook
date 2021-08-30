<head>
<link rel="stylesheet" href="Bootstrap.min.css" crossorigin="anonymous">
<script src="jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="Bootstrap.js" crossorigin="anonymous"></script>
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
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="index.php">Feedback Dashboard</a>
</nav>
<main role="main">
    <div class="jumbotron">
    <div class="mx-auto" style="width:300px">
        <h1>Login</h1>
        <p> Please enter your username and password to login.</p>
        <form id="login">
        <label><b>Username</b></label>
        <input type="text" id="username"/>
        <label><b>Password</b></label>
        <input type="password" id="password"/>
        <button type="submit">Login</button>
        <span id="message"></span>
         </form>
    
    </div>
    </div>
</main>
</div>
</body>

<script>
$( "#login" ).submit(function( event ) {
    event.preventDefault();
    var un = $("#username").val();
    var pw = $("#password").val();  
    $.post( "login.php", { type:"login", username: un, password: pw })
        .done(function( data ) {
            alert(data);
            if(data == 'success'){
                $(location).attr("href", "dashboard.php");
                console.log('success');
            } else {
                $('#message').text('Login failed, please check your username and password.');
                console.log('failed');
            }
        }); 
});
</script>