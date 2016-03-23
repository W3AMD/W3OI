<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<nav class="navbar navbar-default navbar-fixed-top"><body style="padding-top: 70px">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">W3OI Home</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member Editor<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Add</a></li>
            <li><a href="#">Update</a></li>
            <li><a href="#">Add Payment Record</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search For Member">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
  <div class="row">
<form method="post" name="membersform" class="col-sm-5 col-md-3" id="memberseditorform">
<label for="textfield">Member ID:</label>
  <input type="text" name="textfield" id="memberid">
  <h5><strong>Name Information:</strong></h5>
  <label for="textfield">Prefix:</label>
  <input type="text" name="textfield" id="nameprefix">
  <label for="textfield">First:</label>
  <input type="text" name="textfield" id="namefirst">
  <label for="textfield">Middle:</label>
  <input type="text" name="textfield" id="namemid">
  <label for="textfield">Last:</label>
  <input type="text" name="textfield" id="namelast">
  <label for="textfield">Suffix:</label>
  <input type="text" name="textfield" id="namesuffix">
  <br>
  <label for="checkbox">Silent Key </label>
  <input type="checkbox" name="checkbox" id="membersilent">
  <br>
  <label for="checkbox">Paid </label>
  <input type="checkbox" name="checkbox" id="memberpaid">
</form>
    <div class="col-md-4">
<form method="post" name="membersform" class="col-md-12" id="memberseditorform">
      <h5><strong>Address Information:</strong></h5>
      <label for="textfield">Address 1:</label>
      <input name="textfield" type="text" class="glyphicon-text-width" id="addr1">
      <label for="textfield">Address 2:</label>
      <input type="text" name="textfield" id="addr2">
      <br><label for="textfield">City:</label>
      <input type="text" name="textfield" id="addrcity">
      <br><label for="textfield">State:</label>
      <input type="text" name="textfield" id="addrstate">
      <br><label for="textfield">Zip:</label>
      <input type="text" name="textfield" id="addrzip">
</form>
</div>
<form method="post" name="membersform" class="col-md-4" id="memberseditorform">
      <h5><strong>License Information:</strong></h5>
      <label for="textfield">Callsign:</label>
  <input name="textfield" type="text" class="glyphicon-text-width" id="licensecall">
      <br>
      <label for="textfield">Class:</label>
      <input name="textfield" type="text" class="glyphicon-text-width" id="licsenseclass
      ">
      <br>
      <h5><strong>Member Last Update:</strong></h5>
      <label for="textfield">Last Update:</label><input type="date">
</form>
</nav>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
