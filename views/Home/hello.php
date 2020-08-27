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
        <p id="result"></p>
        <form id="action" method="post">
            <input id="amount" type="text">
            <input  id="withdraw" name="withdraw" class="btn btn-danger" value="提款" />
            <input  id="deposit" name="deposit" class="btn btn-danger" value="存款" />
            <input  id="checkRecords" name="checkRecords" class="btn btn-danger" value="查詢明細" />
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
            $("#withdraw").click(function() {
                $.ajax({
                    type: "POST",
                    url: "/RD5_Assignment/core/Service.php",
                    dataType: "json",
                    data: {
                        actionName: "1",
                        amount: $("#amount").val()
                    },
                    success: function(data) {
                        if (data.actionName) { //如果後端回傳 json 資料有 nickname
                            $("#action")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html(data.sql);
                            
                            console.log("succ");
                        } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                            $("#action")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                        }
                        
                    },
                    error: function(jqXHR) {
                        $("#action")[0].reset(); //重設 ID 為 demo 的 form (表單)
                        $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                        console.log("fail");
                    }
                })
            })
        })
        $("#logout").submit(function(event) {

        });
    </script>
</body>

</html>