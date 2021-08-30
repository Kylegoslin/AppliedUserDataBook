<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Dashboard</title>
      <link rel="stylesheet" href="Bootstrap.min.css">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link href="dashboard.css" rel="stylesheet">
      <script src="jquery-3.1.0.min.js"></script>
      <script src="popper.min.js"></script>
      <script src="Bootstrap.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   </head>
   <body>
      <header>
         <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">Campaign</a>
                     <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" id="addViz" href="#addAtt" data-toggle="modal" >Add New Visualisation</a>
                        <a class="dropdown-item" href="#buildCamp" data-toggle="modal" >Build New Campaign</a>
                        <a class="dropdown-item" href="#addElements" data-toggle="modal" >Add Campaign Elements</a>
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Text Analysis</a>
                     <div class="dropdown-menu" aria-labelledby="dropdown02">
                        <a class="dropdown-item" href="#selectRanges" data-toggle="modal" >View Red Flags</a>
                     </div>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      
      
      <div class="container-fluid">
   <div class="row">
      <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
         <ul class="nav nav-pills flex-column">
            <li class="nav-item">
               <a class="nav-link active" href="#">Overview 
               <span class="sr-only">(current)</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Export</a>
            </li>
         </ul>
      </nav>
      <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
      <h1>Dashboard</h1>
      <div id="output">
      </div>
      <section class="row text-center placeholders">
      </section>
   </div>
</div>

