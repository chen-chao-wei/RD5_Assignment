<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/jquery.toast.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet"> -->
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
      <?= var_dump($data->flag);?>
      <div class="col-sm-6">
        <span>&nbsp;</span>
        <h1> <?= ($data->flag)?"":"重複" ?>註冊 </h1>
        <form method="post" onsubmit="return checkID()">
          <div class="form-group row">
            <label for="account" class="col-4 col-form-label">帳號</label>
            <div class="col-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                  </div>
                </div>
                <input required id="account" name="account" type="text" aria-describedby="accountHelpBlock" class="form-control">
              </div>
              <span id="accountHelpBlock" class="form-text text-muted">輸入帳號</span>
            </div>
          </div>
          <div class="form-group row">
            <label for="personID" class="col-4 col-form-label">身分證</label>
            <div class="col-8">
              <input required id="personID" name="personID" type="text" class="form-control" aria-describedby="personIDHelpBlock">
              <span id="personIDHelpBlock" class="form-text text-muted">輸入身分證</span>
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-4 col-form-label">密碼</label>
            <div class="col-8">
              <input required id="password" name="password" type="password" aria-describedby="passwordHelpBlock" class="form-control">
              <span id="passwordHelpBlock" class="form-text text-muted">輸入密碼</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button  name="submit" type="submit" class="btn btn-primary">Submit</button>
             
            </div>
          </div>
        </form>

      </div>
      <div class="col-sm-3">
        &nbsp;
      </div>
    </div>
    <button  onclick="checkID()"> 1</button>
  </div>
  
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/jquery.toast.js"></script>
 
  <script>

    function checkID() {
      
      var idStr = $("#personID").val();      
      // 依照字母的編號排列，存入陣列備用。
      var letters = new Array('A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M',
        'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
        'X', 'Y', 'W', 'Z', 'I', 'O');
      // 儲存各個乘數
      var multiply = new Array(1, 9, 8, 7, 6, 5,
        4, 3, 2, 1);
      var nums = new Array(2);
      var firstChar;
      var firstNum;
      var lastNum;
      var total = 0;
      // 撰寫「正規表達式」。第一個字為英文字母，
      // 第二個字為1或2，後面跟著8個數字，不分大小寫。
      var regExpID = /^[a-z](1|2)\d{8}$/i;
      // 使用「正規表達式」檢驗格式
      if (idStr.search(regExpID) == -1) {
        // 基本格式錯誤
        alert("請仔細填寫身份證號碼");
        return false;
      } else {
        // 取出第一個字元和最後一個數字。
        firstChar = idStr.charAt(0).toUpperCase();
        lastNum = idStr.charAt(9);
      }
      // 找出第一個字母對應的數字，並轉換成兩位數數字。
      for (var i = 0; i < 26; i++) {
        if (firstChar == letters[i]) {
          firstNum = i + 10;
          nums[0] = Math.floor(firstNum / 10);
          nums[1] = firstNum - (nums[0] * 10);
          break;
        }
      }
      // 執行加總計算
      for (var i = 0; i < multiply.length; i++) {
        if (i < 2) {
          total += nums[i] * multiply[i];
        } else {
          total += parseInt(idStr.charAt(i - 1)) *
            multiply[i];
        }
      }
      // 和最後一個數字比對
      if ((10 - (total % 10)) != lastNum) {
        alert("身份證號碼寫錯了！");
        return false;
      }
      return true;
    }
  </script>


</body>

</html>