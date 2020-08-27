<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Lab</title>
</head>

<body>
    <img src="/RD5_Assignment/imgs/ray_moore.jpg">
    <H1>Hello! <?= $data->name ?></H1>
    <div>
        <?php if ($data->name) : ?>
            <h1><?= "User Name:" . $data->name ?><br>
            <?php endif; ?>
            <form id="logout" method="post" onsubmit="return checkOut()">
                <input type="submit" class="btn btn-danger" value="登出" />
                <input type="hidden" name="logout" value="true" />
            </form>
            </h1>
            <hr>
    </div>
    <div>
        <p id="description">請選擇交易操作</p>
        <p id="result"></p>
        <form id="actionForm" method="post">
            <!-- <label>請輸入金額</label> -->
            
            <!-- <input type="text" onkeyup="var v=this.value||'';v=v.replace(/[^\d]/g,'');v=parseInt(v,10);if(v<100){this.value=100;}"> -->
            <a id="withdraw"  class="btn btn-danger withdraw" value="提款" >提款</a>
            <a id="deposit"  class="btn btn-danger deposit" value="存款" >存款</a>
            <a id="checkRecords"  class="btn btn-danger checkRecords" value="查詢明細" >查詢明細</a>
            
            <a id="withdraw"  class="btn btn-danger check" >確認提款</a>
            <a id="deposit"  class="btn btn-danger check" >確認存款</a>
            <a id="checkRecords"  class="btn btn-danger check" >查詢明細</a>
            <a id="all"  class="btn btn-danger all" >回操作選單</a>
        </form>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toast.js"></script>

    <script>
        function checkOut() {
            var yes = confirm('你確定要登出嗎？');
            if (yes) {
                alert('下次再見');
                return true;
            } else {
                return false;
            }
        }
        $(document).ready(function() {
            $(".check").hide(); $(".all").hide();
            $('.check').on('click',function(){
                console.log('check');
                $.ajax({
                        type: "POST",
                        url: "/RD5_Assignment/core/Service.php",
                        dataType: "json",
                        data: {
                            userName: <?= $data->name ?>,
                            actionName: $(".check").attr("id"),
                            amount: $("#amount").val()
                        },
                        success: function(data) {
                            if (data.actionName) { //如果後端回傳 json 資料有 nickname
                                $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                                $("#result").html(data.userName + "|" + data.info['actionName'] + "|" + data.info['amount'] + "|" + data.info['status'] + "|" + data.info['accountBalance']);

                                console.log("succ");
                                console.log(data);
                            } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                                $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                                $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                            }

                        },
                        error: function(jqXHR) {
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                            console.log("fail");
                        }
                    })
            })
            $('.all').on('click',function(){
                $(".check").hide();
                $(".all").hide();    
                
                $("#amount").hide();
                $("#result").hide();
                $(".withdraw").show();
                $(".deposit").show();
                $(".checkRecords").show();                
                $("#description").show();

                $('label').remove(); 
                $("#amount").remove();
            })
            $('.withdraw').on('click',function(){
                console.log("click");
                if ( $(".withdraw").attr("value") == "提款") {
                    $(".check").show();
                    $(".all").show();
                    $(".withdraw").hide();
                    $(".deposit").hide();
                    $(".checkRecords").hide();
                    $("#description").hide();
                    
                    //onkeyup="value=value.replace(/[^\d]/g,'+')"
                    $("#actionForm").prepend('<label>請輸入金額</label><input id="amount" type="text" >');
                    //$("#actionForm").append('<a id="withdraw"  class="btn btn-danger check" >確認提款</a>')                    
                } 
            })
            $('.deposit').on('click',function(){
                console.log("click");
                $(".check").show();
                    $(".all").show();
                    $(".deposit").hide();
                    $("#description").hide();
                    $(".withdraw").hide();
                    $(".checkRecords").hide();
                    //onkeyup="value=value.replace(/[^\d]/g,'+')"
                    $("#actionForm").prepend('<label>請輸入金額</label><input id="amount" type="text" >');  
                if ( $(".deposit").attr("value") == "存款") {
                                      
                } 
            })
            
        })
        $("#logout").submit(function(event) {

        });
    </script>
</body>

</html>