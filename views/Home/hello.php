<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <link href="/RD5_Assignment/css/bootstrap.min.css" rel="stylesheet">
    <link href="/RD5_Assignment/css/jquery.toast.css" rel="stylesheet">
    <link href="/RD5_Assignment/css/style.css" rel="stylesheet">
    <title>Lab</title>
</head>

<body>
    <div class="container-fluid">
       
        <div class="row ">
            <div class="col-md-12" id="bank-body">
                <div class="row">
                    
                    <div class="col pull-right" id = "bank-navs">
                        <h1>Hello! <?= $data->name ?></h1>
                        <form id="logout" method="post" onsubmit="return checkOut()">
                            <input type="submit" class="btn btn-danger" value="登出" />
                            <input type="hidden" name="logout" value="true" />
                        </form>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div id="tabs" class="col-md-12">
                <div >
                    <!-------------------- nav START ------------------------>
                    <ul class="nav nav-tabs">
                        <li id="pre" class="nav-item active">
                            <a class="nav-link active show" href="#tab1" data-toggle="tab">帳戶</a>
                        </li>
                        <li class="nav-item">
                            <a id="checkRecords" class="nav-link" href="#tab2" data-toggle="tab">交易明細</a>
                        </li>
                    </ul>
                    <!-------------------- nav   END ------------------------>
                    <div class="tab-content">
                        <!-------------------- TAB1 START ------------------------>
                        <div class="tab-pane active text-center" id="tab1">
                            <div id="div-img-action" class="jumbotron ">
                                <h3 id="description">請選擇交易操作</h3>
                                <div class="row align-items-center  text-center"></div>
                                <div class="row" style="background-color: white; padding:5% " >
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img class="img-thumbnail" href="#modal-container-transaction" data-toggle="modal" alt="Bootstrap Thumbnail First" src="/RD5_Assignment/imgs/bank/atm.png" onclick="setWithdraw()" />

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img class="img-thumbnail" href="#modal-container-transaction" data-toggle="modal" alt="Bootstrap Thumbnail Second" src="/RD5_Assignment/imgs/bank/money-bag.png" onclick="setDeposit()" />

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img class="img-thumbnail" alt="Bootstrap Thumbnail Third" data-toggle="modal" src="/RD5_Assignment/imgs/bank/investing-cheque.png" />

                                        </div>
                                    </div>
                                </div>
                                <div class=row>&nbsp;&nbsp;</div>
                                <div class=row style="background-color: white; padding:5%">
                                    <div class="col-md-4">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-4">
                                        <img class="img-fluid rounded " alt="Bootstrap Thumbnail Second" src="\RD5_Assignment\imgs\bank\bank.png" />
                                        <h2>
                                            Hello, world!
                                        </h2>
                                        <p>
                                            1
                                        </p>
                                        <p>
                                            2
                                        </p>
                                        <p>
                                            3
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        &nbsp;
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-------------------- TAB2   END ------------------------>
                        <!-------------------- TAB2 START ------------------------>
                        <div class="tab-pane" id="tab2">

                            <div id="transactionInfoTable">

                            </div>
                        </div>
                        <!-------------------- TAB2   END ------------------------>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-------------------- MODAL START ------------------------>
    <div class="modal fade" id="modal-container-transaction" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class=" modal-header">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <img id="modal-img" class="img-thumbnail" href="#modal-container-transaction" data-toggle="modal" alt="Bootstrap Thumbnail First" onclick="setWithdraw()" />
                        </div>
                        <div class="text-center col-8">
                            <h1 class="modal-title" id="myModalLabel"></h1>
                        </div>
                    </div>
                    <button id="modal-close" type="button" class="close" onclick="actionComplete()" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="actionForm" method="post">
                        <div id="enterAmount" class="text-center">
                            <label id="myModalBodyLabel"></label>
                            <input id="amount" type="text" onkeyup="value=value.replace(/[^\d]/g,'')">
                            <p id="result"></p>
                        </div>
                    </form>
                </div>
                <div class="progress">
                    <div id="progress-bar" class="progress-bar  progress-bar-striped progress-bar-animated bg-info" style="width: 0;">&nbsp;
                    </div>
                </div>
                <div class="modal-footer">

                    <button id="check" type="button" class="btn btn-primary" onclick="checkAction()">
                        確認
                    </button>
                    <button id="modal-cancel" type="button" class="btn btn-secondary" onclick="actionComplete()" data-dismiss="modal">
                        取消
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-------------------- MODAL   END ------------------------>
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
            let rowElements = [];
            let tableClassArr = ["class='tab-checkRecord'", "class='tab-withdraw'", "class='tab-deposit'"];
            let isAmount = ["-", "$"];
            // let isAmount=1;
            let idx = 0;
            rowElements.push(
                $("<table id='tab-info'></table>")
                .addClass("table ")
                //.append('<tr><th scope="col">明細表</th></tr>')
                .append($('<thead></thead>').append('<tr><th scope="col">時間</th><th scope="col">使用者名稱</th><th scope="col">單筆金額</th><th scope="col">操作</th><th scope="col">狀態</th><th scope="col">存款</th></tr>'))
            );
            $("#transactionInfoTable").append(rowElements);
            for (let i = 0; i < data.length; i++) {
                if (!data[i]['amount']) {
                    data[i]['amount'] = data[i]['status'] = isAmount[0];
                } else {
                    data[i]['amount'] = isAmount[1] + data[i]['amount'];
                }
                if (data[i]['actionName'] == 'checkRecords') {
                    idx = 0;
                } else if (data[i]['actionName'] == 'withdraw') {
                    idx = 1;
                } else {
                    idx = 2;
                }
                var tableElements = $("<tr " + tableClassArr[idx] + "><td>" + data[i]['datatime'] + "</td><td>" + data[i]['account'] + "</td>" +
                    "<td>" + data[i]['amount'] + "</td>" + "<td>" + data[i]['actionName'] + "</td>" + "<td>" + data[i]['status'] + "</td>" + "<td>" + isAmount[1] + data[i]['accountBalance'] + "</td></tr>")
                tableElements.appendTo("#tab-info");
            }
        }

        $(document).ready(function() {

            $(".check").hide();
            $(".all").hide();

            function sleep(time) {
                return new Promise((resolve) => setTimeout(resolve, time));
            }
            //查詢明細
            $("#checkRecords").on('click', function() {
                console.log("click");

                $("#result").show();
                //if($('.checkRecords').attr("value"))
                $.ajax({
                    type: "POST",
                    url: "/RD5_Assignment/core/Service.php",
                    dataType: "json",
                    data: {
                        userName: "<?= $data->name ?>",
                        actionName: "checkRecords"
                    },
                    success: function(data) {
                        if (data.TransactionInfo) {
                            console.log(data.TransactionInfo);
                            doTable(data.TransactionInfo);
                            console.log("doTable");
                        }
                        console.log(data);
                    },
                    error: function(jqXHR) {
                        $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                        $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                        console.log("fail");
                    }
                })
                if ($('.checkRecords').attr("value") == 1) {
                    $('.checkRecords').attr("value", 0);
                    $.ajax({
                        type: "POST",
                        url: "/RD5_Assignment/core/Service.php",
                        dataType: "json",
                        data: {
                            userName: "<?= $data->name ?>",
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
                } else {
                    $('.checkRecords').attr("value", 1);
                    $("#transactionInfoTable").empty();
                }


            });
            //跑進度條
            function progress() {
                val = $(".progress-bar").width() + 1;
                console.log("progress");

                $(".progress-bar").css({
                    "width": val + "%"
                });
                console.log(val);
                if (val < $(".modal-body").width()) {
                    setTimeout(progress, 50);
                }
            }
            //完成-結束操作
            actionComplete = function() {
                $('#modal-container-transaction').modal('hide')
                //$("#modal-close").trigger("click");
                $("#amount").val(null);
                $("#amount").attr("disabled", false);
                $(".progress-bar").width(1);
                $("#check").text("確認");
                $("#check").attr("disabled", false);
                $("#check").attr("onclick", "checkAction()")
                $("#result").empty();

            }
            //確認-執行操作
            checkAction = function() {
                //progress();
                console.log('checkAction');
                console.log($("#amount").val());
                $("#check").attr("disabled", true);
                $("#amount").attr("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "/RD5_Assignment/core/Service.php",
                    dataType: "json",
                    data: {
                        userName: "<?= $data->name ?>",
                        actionName: $("#check").val(),
                        amount: $("#amount").val()
                    },
                    success: function(data) {
                        if (data.actionName) { //如果後端回傳 json 資料有 actionName
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#green">' + data.info['status'] + '</font>');
                            $(".progress-bar").css({
                                "width": "100%"
                            })
                            $("#modal-cancel").hide();
                            sleep(1000).then(() => {
                                $("#check").attr("onclick", "actionComplete()")
                                $("#check").attr("disabled", false);
                                $("#check").text("完成");
                                alert(data.info['actionName'] + " $" + data.info['amount'] + " 【" + data.info['status'] + "】");
                                console.log("succ");
                                console.log(data);
                            })

                        } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                            $("#check").attr("onclick", "actionComplete()")
                            $("#check").attr("disabled", false);
                            $("#amount").attr("disabled", false);
                            $("#check").attr("onclick", "checkAction()")
                        }

                    },
                    error: function(jqXHR) {
                        $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                        $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                        console.log("fail");
                    }
                })
            }
            //提款
            setWithdraw = function() {
                $("#modal-cancel").show();
                $("#modal-img").attr("src", "/RD5_Assignment/imgs/bank/atm.png");
                $(".check").hide();
                $("#myModalLabel").text("提款");
                $("#myModalBodyLabel").text("提款金額");
                $("#check").val("withdraw");
                console.log("setWithdraw");
            }
            //存款
            setDeposit = function() {
                $("#modal-cancel").show();
                $("#modal-img").attr("src", "/RD5_Assignment/imgs/bank/money-bag.png");
                $("#myModalLabel").text("存款");
                $("#myModalBodyLabel").text("存款金額");
                $("#check").val("deposit");
                console.log("setDeposit");
            }

            $("img").hover(function() {
                $(this).addClass("img-in");
            }, function() {
                $(this).removeClass("img-in");
            })





            // //查看明細
            // $('.checkRecords').on('click', function() {
            //     console.log("click");
            //     $("#result").show();
            //     //if($('.checkRecords').attr("value"))
            //     console.log("test", $('.checkRecords').attr("value"));
            //     if ($('.checkRecords').attr("value") == 1) {
            //         $('.checkRecords').attr("value", 0);
            //         $.ajax({
            //             type: "POST",
            //             url: "/RD5_Assignment/core/Service.php",
            //             dataType: "json",
            //             data: {
            //                 userName: "<?= $data->name ?>",
            //                 actionName: $(".checkRecords").attr("id")
            //             },
            //             success: function(data) {
            //                 if (data.TransactionInfo) {
            //                     console.log(data.TransactionInfo);
            //                     doTable(data.TransactionInfo);
            //                 }
            //             },
            //             error: function(jqXHR) {
            //                 $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
            //                 $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
            //                 console.log("fail");
            //             }
            //         })
            //     } else {
            //         $('.checkRecords').attr("value", 1);
            //         $("#transactionInfoTable").empty();
            //     }
            // })


        })
        $("#logout").submit(function(event) {

        });
    </script>
</body>

</html>