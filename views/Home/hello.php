<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="/RD5_Assignment/css/style.css" rel="stylesheet">
    <link href="/RD5_Assignment/css/bootstrap.min.css" rel="stylesheet">
    <link href="/RD5_Assignment/css/jquery.toast.css" rel="stylesheet">
    <title>Lab</title>
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                &nbsp;
            </div>
            <div class="col-sm-6">
                <img src="/RD5_Assignment/imgs/ray_moore.jpg">
                <H1>Hello! <?= $data->name ?></H1>
                <div>                    
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
                        <a id="withdraw" class="btn-a btn btn-primary withdraw" value="提款">提款</a>
                        <a id="deposit" class="btn-a btn btn-success deposit" value="存款">存款</a>
                        <a id="checkRecords" class="btn-a btn btn-info checkRecords" value=1>查詢明細</a>
                    </form>
                    <button id="check" class="btn btn-danger check">確認</button>
                    <button id="all" class="btn btn-info all">回操作選單</button>
                </div>
                <div id="transactionInfoTable">

                </div>
            </div>
            <div class="col-sm-3">
                &nbsp;
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toast.js"></script>

    <script>
        //登出確認 
        function checkOut() {
            var yes = confirm('你確定要登出嗎？');
            if (yes) {
                alert('下次再見');
                return true;
            } else {
                return false;
            }
        }
        //生成明細表
        function doTable(data) {
            var rowElements = [];

            rowElements.push(
                $("<table id='info'></table>")
                .addClass("table table-striped")
                //.append('<tr><th scope="col">明細表</th></tr>')
                .append($('<thead></thead>').append('<tr><th scope="col">時間</th><th scope="col">使用者名稱</th><th scope="col">單筆金額</th><th scope="col">操作</th><th scope="col">狀態</th><th scope="col">存款</th></tr>'))
            );
            $("#transactionInfoTable").append(rowElements);
            for (let i = 0; i < data.length; i++) {
                if (!data[i]['amount']) {
                    data[i]['amount'] = data[i]['status'] = "-";
                }
                var tableElements = $("<tr><td>" + data[i]['datatime'] + "</td><td>" + data[i]['account'] + "</td>" +
                    "<td>" + data[i]['amount'] + "</td>" + "<td>" + data[i]['actionName'] + "</td>" + "<td>" + data[i]['status'] + "</td>" + "<td>" + data[i]['accountBalance'] + "</td></tr>")
                tableElements.appendTo("#info");
            }
        }

        $(document).ready(function() {
            $(".check").hide();
            $(".all").hide();
            //確認執行操作
            $('.check').on('click', function() {
                console.log('check');
                $.ajax({
                    type: "POST",
                    url: "/RD5_Assignment/core/Service.php",
                    dataType: "json",
                    data: {
                        userName: <?= $data->name ?>,
                        actionName: $("#check").val(),
                        amount: $("#amount").val()
                    },
                    success: function(data) {
                        if (data.actionName) { //如果後端回傳 json 資料有 nickname
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html(data.info['status']);
                            alert(data.info['actionName'] + " $" + data.info['amount'] + " 【" + data.info['status'] + "】");
                            console.log("succ");
                            console.log(data);
                        } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                            console.log(errorMsg);
                        }

                    },
                    error: function(jqXHR) {
                        $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                        $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                        console.log("fail");
                    }
                })
            })
            //回功能選單
            $('.all').on('click', function() {
                $(".check").hide();
                $(".all").hide();

                $("#amount").hide();
                $("#result").hide();
                $(".withdraw").show();
                $("#deposit").show();
                $("#checkRecords").show();
                $("#description").show();
                $("#enterAmount").remove();
                // $('label').remove(); 
                // $("#amount").remove();
                $("#result").empty();
            })
            //提款
            $('.withdraw').on('click', function() {
                console.log("click");
                $(".check").show();
                $(".all").show();
                $(".deposit").hide();
                $("#description").hide();
                $(".withdraw").hide();
                $(".checkRecords").hide();
                $("#check").val("withdraw");
                $("#result").show();
                console.log($("#check").val());
                //onkeyup="value=value.replace(/[^\d]/g,'+')"
                $("#actionForm").prepend('<div id = "enterAmount"><label>請輸入提款金額</label><input id="amount" type="text" onkeyup="value=value.replace(/[^\\d]/g,' + "'')" + '"></div>');

            })
            //存款
            $('.deposit').on('click', function() {
                console.log("click");
                $("#result").show();
                $(".check").show();
                $(".all").show();
                $(".deposit").hide();
                $("#description").hide();
                $(".withdraw").hide();
                $(".checkRecords").hide();
                $("#check").val("deposit");
                //onkeyup="value=value.replace(/[^\d]/g,'+')"
                $("#actionForm").prepend('<div id = "enterAmount"><label>請輸入存款金額</label><input id="amount" type="text" onkeyup="value=value.replace(/[^\\d]/g,' + "'')" + '"></div>');

            })
            //查看明細
            $('.checkRecords').on('click', function() {
                console.log("click");
                $("#result").show();
                //if($('.checkRecords').attr("value"))
                console.log("test", $('.checkRecords').attr("value"));
                if ($('.checkRecords').attr("value")==1) {
                    $('.checkRecords').attr("value",0);
                    $.ajax({
                        type: "POST",
                        url: "/RD5_Assignment/core/Service.php",
                        dataType: "json",
                        data: {
                            userName: <?= $data->name ?>,
                            actionName: $(".checkRecords").attr("id")
                        },
                        success: function(data) {
                            if (data.TransactionInfo) {
                                console.log(data.TransactionInfo);
                                doTable(data.TransactionInfo);
                            }

                        },
                        error: function(jqXHR) {
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                            console.log("fail");
                        }
                    })
                }else{
                    $('.checkRecords').attr("value",1);
                    $("#transactionInfoTable").empty();
                }


            })

        })
        $("#logout").submit(function(event) {

        });
    </script>
</body>

</html>