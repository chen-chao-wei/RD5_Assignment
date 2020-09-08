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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>bank</title>
</head>

<body>
    <div class="container-fluid">

        <div class="row ">
            <div class="col-md-12" id="bank-body">
                <div class="row align-items-center">
                    <div class="col" id="bank-navs">                        
                        <form id="logout" method="post" onsubmit="return checkOut()">
                            <input type="submit" class="pull-right btn btn-danger" style="margin: 2%;" value="登出" />
                            <input type="hidden" name="logout" value="true" />
                        </form>
                        <h1 class="pull-right">Hello! <?= $data->name ?></h1>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div id="tabs" class="col-md-12">
                <div>
                    <!-------------------- nav START ------------------------>
                    <ul id="headerUl" class="nav nav-tabs">
                        <li class="nav-item active">
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
                                <div class="row align-items-center" style="background-color: white; padding:5%">
                                    <!-- <div class="col-md-4">
                                        &nbsp;
                                    </div> -->
                                    <div id="userInfo" class="col-md-4">
                                        <div id="showMoney" style="color: #193045; font-weight:bold">
                                            <h2><span class="fa fa-eye">存款</span></h2>
                                        </div>
                                        <img class="img-fluid rounded " alt="Bootstrap Thumbnail Second" src="\RD5_Assignment\imgs\bank\bank.png" />

                                    </div>
                                    <div id=rate class="col-md-8 ">
                                        <div id="rate-header" class="container-fluid ">
                                            <div id="rateTitle">
                                                <label>匯率</label>
                                            </div>
                                        </div>
                                        <div id="rate-body" class="row justify-content-around">
                                            <div id="rate-header">
                                                <label>買進</label>
                                            </div>
                                            <div id="USD-buy"><label>美金: --</label></div>
                                            <div id="JPY-buy"><label>日幣: --</label></div>
                                            <div id="CNY-buy"><label>人民幣: --</label></div>
                                        </div>
                                        <div id="rate-body" class="row justify-content-around">
                                            <div id="rate-header">
                                                <label>賣出</label>
                                            </div>
                                            <div id="USD-sell"><label>美金: -----</label></div>
                                            <div id="JPY-sell"><label>日幣: -----</label></div>
                                            <div id="CNY-sell"><label>人民幣: -----</label></div>
                                        </div>
                                        <div id="rate-footer" class="container-fluid ">
                                            <div id="rateTitle">
                                                <span class="fa fa-clock-o"></span>
                                                <label id="UTC"></label>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div>&nbsp;</div>
                                <div class="row" style="background-color: white; padding:5% ">
                                    <div class="row container" style="margin:auto">
                                        <div id="description" class="col-md-12 text-center">
                                            <h3>選擇操作</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div id="action-title" class="card-body" href="#modal-container-transaction" data-toggle="modal" onclick="setWithdraw()">
                                                <h5>提款</h5>
                                            </div>
                                            <img class="img-thumbnail" href="#modal-container-transaction" data-toggle="modal" alt="Bootstrap Thumbnail First" src="/RD5_Assignment/imgs/bank/atm.png" onclick="setWithdraw()" />
                                        </div>
                                        <div class="col-md-4">
                                            <div id="action-title" class="card-body" href="#modal-container-transaction" data-toggle="modal" onclick="setDeposit()">
                                                <h5>存款</h5>
                                            </div>
                                            <img class="img-thumbnail" href="#modal-container-transaction" data-toggle="modal" alt="Bootstrap Thumbnail Second" src="/RD5_Assignment/imgs/bank/money-bag.png" onclick="setDeposit()" />
                                        </div>
                                        <div class="col-md-4">
                                            <div id="action-title" class="card-body" onclick="nextTab()">
                                                <h5>查詢明細</h5>
                                            </div>
                                            <img class="img-thumbnail" alt="Bootstrap Thumbnail Third" data-toggle="modal" src="/RD5_Assignment/imgs/bank/investing-cheque.png" onclick="nextTab()" />


                                        </div>
                                    </div>
                                </div>

                                <div class="row">&nbsp;&nbsp;</div>


                            </div>
                        </div>
                        <!-------------------- TAB2   END ------------------------>
                        <!-------------------- TAB2 START ------------------------>
                        <div class="tab-pane" id="tab2">

                            <div id="transactionInfoTable" class="row" style=" background-color: #193045; padding:5% ;border-radius:30px; ">

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
    <script src="/RD5_Assignment/js/jquery.js"></script>
    <script src="/RD5_Assignment/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/RD5_Assignment/js/jquery.toast.js"></script>

    <script>
        window.alert = function(name) {
            var iframe = document.createElement("IFRAME");
            iframe.style.display = "none";
            iframe.setAttribute("src", 'data:text/plain,');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
        }

        var wConfirm = window.confirm;
        window.confirm = function(message) {
            try {
                var iframe = document.createElement("IFRAME");
                iframe.style.display = "none";
                iframe.setAttribute("src", 'data:text/plain,');
                document.documentElement.appendChild(iframe);
                var alertFrame = window.frames[0];
                var iwindow = alertFrame.window;
                if (iwindow == undefined) {
                    iwindow = alertFrame.contentWindow;
                }
                var result = iwindow.confirm(message);
                iframe.parentNode.removeChild(iframe);
                return result;
            } catch (exc) {
                return wConfirm(message);
            }
        }
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
                $("#transactionInfoTable").empty();
                $("#result").show();
                //if($('.checkRecords').attr("value"))
                $.ajax({
                    type: "POST",
                    url: "/RD5_Assignment/core/getUserInfo.php",
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
                                //console.log("succ");
                                //console.log(data);
                            })
                        } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                            $("#actionForm")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            if(data.errorMsg){
                                $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                            }else{
                                $("#result").html('<font color="#ff0000">' + data.info['errorMsg'] + '</font>');
                            }                            
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
            //滑過效果
            $("img").hover(function() {
                $(this).addClass("img-in");
            }, function() {
                $(this).removeClass("img-in");
            })
            $("#rate-header div").hover(function() {
                $(this).addClass("img-in");
            }, function() {
                $(this).removeClass("img-in");
            })
            $("#rate-body div").hover(function() {
                $(this).addClass("img-in text-in");
            }, function() {
                $(this).removeClass("img-in text-in");
            })

            //拿初始資料
            $.ajax({
                async: false,
                type: "GET",
                url: "/RD5_Assignment/core/Service.php",
                dataType: "json",
                success: function(data) {
                    const exchangeRateDifference = 1.003;
                    if (data.currency) { //如果後端回傳 json 資料有 currency
                        USD = data.currency['USDTWD']['Exrate'].toFixed(4);
                        JPY = (data.currency['USDJPY']['Exrate'] / data.currency['USDTWD']['Exrate']).toFixed(4);
                        CNY = (data.currency['USDCNY']['Exrate'] / data.currency['USDTWD']['Exrate']).toFixed(4);
                        UTC = data.currency['USDTWD']['UTC'];
                        $("#USD-buy label").text("美金: " + USD);
                        $("#JPY-buy label").text("日圓: " + JPY);
                        $("#CNY-buy label").text("人民幣: " + CNY);
                        $("#USD-sell label").text("美金: " + (USD / exchangeRateDifference).toFixed(4));
                        $("#JPY-sell label").text("日圓: " + (JPY / exchangeRateDifference).toFixed(4));
                        $("#CNY-sell label").text("人民幣: " + (CNY / exchangeRateDifference).toFixed(4));
                        $("#UTC").text(UTC);
                        console.log(data.currency);
                    }
                },
                error: function(jqXHR) {
                    console.log("get fail");
                }
            })
            $("#userInfo h2").on("click", function() {
                console.log("show money");
                eyeIsSlash = $("#userInfo span").hasClass("fa fa-eye-slash");
                console.log(eyeIsSlash);
                if (!eyeIsSlash) {
                    $.ajax({
                        type: "GET",
                        url: "/RD5_Assignment/core/getUserInfo.php",
                        dataType: "json",
                        success: function(data) {
                            if (data.accountBalance>=0) {
                                $("#userInfo span").text("$" + data.accountBalance);
                                $("#userInfo span").attr("class", "fa fa-eye-slash");
                               
                            }else{
                                console.log(data.accountBalance);    
                            }
                        },
                        error: function(jqXHR) {
                            console.log("get fail");
                        }
                    })
                } else {
                    $("#userInfo span").text("存款");
                    $("#userInfo span").attr("class", "fa fa-eye");
                }

            })

            nextTab = function() {
                $('.nav-tabs > .active').next('li').find('a').trigger('click');
            }




        })
        $("#logout").submit(function(event) {

        });
    </script>
</body>

</html>