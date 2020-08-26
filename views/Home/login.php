

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/jquery.toast.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Document</title>
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col-sm-3">
        &nbsp;
      </div>
      <div class="col-sm-6">
        <span>&nbsp;</span>
        <h1> 登入 <?= ($date->flag)?"失敗":"失敗"?></h1>
        <form method="post" >
          <div class="form-group row">
            <label for="account" class="col-4 col-form-label">帳號</label>
            <div class="col-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                  </div>
                </div>
                <input id="account" name="account" type="text" aria-describedby="accountHelpBlock" class="form-control">
              </div>
              <span id="accountHelpBlock" class="form-text text-muted">輸入帳號</span>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="password" class="col-4 col-form-label">密碼</label>
            <div class="col-8">
              <input id="password" name="password" type="text" aria-describedby="passwordHelpBlock" class="form-control">
              <span id="passwordHelpBlock" class="form-text text-muted">輸入密碼</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
        
      </div>
      <div class="col-sm-3">
        &nbsp;
      </div>     
    </div>
    
  </div>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.toast.js"></script>

  <script>
  </script>


</body>

</html>