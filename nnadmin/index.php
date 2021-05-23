<?php
    // http_response_code(401);
 header("Content-type: text/html; charset=utf-8");
//  header('Content-Type: application/json');

 //取得使用者ip
 $remote_addr=$_SERVER["REMOTE_ADDR"];

 //限制存取對內ip
 $ip_white_list = ["192.168.80", "192.168.81", "192.168.82", "192.168.83"];

 //去除ip最後一個數值
 $remote_addr_replace = preg_replace("/(\d{1,3})\.(\d{1,3}).(\d{1,3}).(\d{1,3})/", '$1.$2.$3', $remote_addr);

if (!in_array($remote_addr_replace, $ip_white_list) && !strstr($_SERVER["REMOTE_ADDR"], "61.221.125.151")) { // 限制 IP 存取
    echo $remote_addr."<br>Access denied.";
    exit;
}

 function validate($user, $pass)
 {
     $users = ["admin"=>"BSBVj5OJMoOd_JzJM_mQ3HNos7J"];
     if (isset($users[$user]) && $users[$user] === $pass) {
         return true ;
     } else {
         return false;
     }
 }

if (!validate(@$_SERVER['PHP_AUTH_USER'], @$_SERVER['PHP_AUTH_PW'])) {
    http_response_code(401);
    header('WWW-Authenticate:Basic realm="NeithNet Backend"');
    echo '需要使用者名稱和密碼才能繼續訪問'; //取消時瀏覽器輸出
    exit;
} else {
    if (!($_SERVER['PHP_AUTH_USER']=="admin"&&$_SERVER['PHP_AUTH_PW']=="BSBVj5OJMoOd_JzJM_mQ3HNos7J")) {
        echo "Username or Password not correct";
        $_SERVER['PHP_AUTH_USER']="";
        $_SERVER['PHP_AUTH_PW']="";
        //echo "<pre>";
        //print_r($_SERVER);
        exit;
    }
}

//db
include("DB.php");
$db=DB::getInstance();

   ?>
<html>

<head>
    <title>NEITHNET 後台</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
        integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
    <!-- boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- datepicker css  -->
    <link rel="stylesheet" href="./css/datetimepicker.css" />
    <!-- 使用sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Helvetica", "Arial", "LiHei Pro", "黑體-繁", "微軟正黑體", sans-serif;
        font-weight: 50;
        /* background-color: #f1f1f1; */
    }

    .box {
        width: 1270px;
        padding: 20px;
        /* background-color: #fff; */
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 100px;
    }
     /* ---------------------------------------------------
        SummerNote
    ----------------------------------------------------- */
    .note-editable { 
        font-family: 'Poppins' !important; 
        font-size: 15px !important; 
        color:#000000 !important; 
        background-color:#FFFFFF;
        text-align: left !important; 
        height: 250px !important;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand">NEITHNET 後台</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container box">
        <br />
        <div align="right">
            <button type="button" id="modal_button" class="btn btn-info"><i class="fas fa-pen-square"></i> 新增</button>
        </div>
        <br />
        <div id="result" class="table-responsive">
        </div>
    </div>
</body>

</html>
<!-- 編輯跟新增共用modal -->
<div id="postModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Records</h4>
            </div>
            <from id="form_data">
                <div class="modal-body">
                    <label>類型</label>
                    <select name="category" id="category" class="form-control">
                        <option selected disabled value="" required="required">請選擇文章類型</option>
                        </option>
                        <option value="EVENT">EVENT</option>
                        </option>
                        <option value="NEWS">NEWS</option>
                    </select>
                    <br />
                    <label>主題</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="請輸入主題" required />
                    <br />
                    <label for="datetimepicker">公告日期</label>
                    <input type="text" name="datetime" id="datetimepicker" class="form-control datetimepicker"
                        placeholder="請選擇日期" />
                    <br />
                    <label>內容</label>
                    <input type="text" name="content" id="content" class="form-control" placeholder="請輸入內容" />
                    <br />
                    <label>是否顯示</label>
                    <select name="is_show" id="is_show" class="form-control">
                        <option selected="selected" disabled value="">請選擇文章狀態</option>
                        </option>
                        <option value="Yes">顯示</option>
                        </option>
                        <option value="No">隱藏</option>
                        </option>
                    </select>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="customer_id" id="customer_id" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" />
                    <input type="submit" id="close" class="btn btn-secondary disabled" data-dismiss="modal" />
                </div>
            </from>
        </div>
    </div>
</div>
<!-- 詳細內容 modal -->
<div id="infoModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PostINFO</h4>
            </div>
            <from>
                <div class="modal-body">
                    <div id="post_info" class="table-responsive">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="customer_id" id="customer_id" />
                        <button type="button" class="btn btn-secondary disabled" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </from>
        </div>
    </div>
</div>
</script>
<!-- summernote Editor -->
<link href="./js/summernote/summernote-lite.css" rel="stylesheet">
<script src="./js/summernote/summernote-lite.min.js"></script>
<!-- summernote Editor language -->
<script src="./js/summernote/lang/summernote-zh-TW.min.js"></script>


<script src="./js/plugins/moment.min.js"></script>
<script src="./js/plugins/bootstrap-datetimepicker.js"></script>
<script>

//日期選擇器
// datetimepicker init
$('.datetimepicker').datetimepicker({
    icons: {
        time: 'fa fa-clock',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove',
    },
    format: "YYYY/MM/DD"
});

//sunmmer note 編輯器設置
$(document).ready(function() {
    $('.note-editable').trigger('focus');
  $('#content').summernote({
        tabsize: 2,
        height: 120,
        lang: 'zh-TW',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['height', ['height']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
      

});

// Ajax crud news/event
$(document).ready(function() {
    fetchUser();
    function fetchUser() {
        var action = "Load";
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                action: action
            },
            success: function(data) {
                $('#result').html(data);
            }
        });
    }
    $('#modal_button').click(function() {
        $('#postModal').modal('show');
        $('#category').val('');
        $('#subject').val('');
        // $('#content').val('');
        //編輯器設置val
        $('#content').summernote('code',"");
        $('#datetimepicker').val('');
        $("#is_show").val('');
        $('.modal-title').text("新增文章");
        $('#action').val('Create');
        $('#close').val('Cancel');
    });
    $('#action').click(function() {
        var category = $('#category').val();
        var subject = $('#subject').val();
        var datetime = $('#datetimepicker').val();
        //編輯器設置val
        var content =$('#content').summernote('code');
        var is_show = $("#is_show").val();
        var id = $('#customer_id').val();
        var action = $('#action').val();
        var close = $('#close').val();

       
        if (category === null) {
            Swal.fire({
                type: 'warning',
                title: '請選擇【文章類型】',
                timer: 1000,
            })
            return false;
        }
        else if (subject == '') {
            Swal.fire({
                type: 'warning',
                title: '請填入【文章主題】',
                timer: 1000,
            })
            return false;
        }
        else if (content == '') {
            Swal.fire({
                type: 'warning',
                title: '請填入【文章內容】',
                timer: 1000,
            })
            return false;
        }
        else if (datetime == '') {
            Swal.fire({
                type: 'warning',
                title: '請選擇【公告日期】',
                timer: 1000,
            })
            return false;
        } else {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    category: category,
                    subject: subject,
                    content: content,
                    datetime: datetime,
                    is_show: is_show,
                    id: id,
                    action: action
                },
                success: function(data, status, xhr) {
                    if (action == "Create") {
                        Swal.fire({
                            type: 'success',
                            title: '資料已新增成功!',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                    if (action == "Update") {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: '你的修改已成功保存!',
                            showConfirmButton: false,
                            timer: 2000
                        }) //編輯成功彈出的提示視窗
                    }
                    $('#postModal').modal(
                        'hide');
                    fetchUser
                        ();
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                    // console.log(textStatus);
                    // console.log(error);
                    if(xhr.statusText === "Request Entity Too Large"){
                        Swal.fire({
                            type: 'warning',
                            title: '你上傳的圖片已超過限制!',
                            text:'圖片允許的最大尺寸：800X600',
                            showConfirmButton: false,
                            timer: 2000
                        }) 
                    }
                }
            });
        }
        // if (category != '' && subject != '' && content != '' && datetime != '') {
        //     $.ajax({
        //         url: "action.php",
        //         method: "POST",
        //         data: {
        //             category: category,
        //             subject: subject,
        //             content: content,
        //             datetime: datetime,
        //             is_show: is_show,
        //             id: id,
        //             action: action
        //         },
        //         success: function(data) {
        //             alert(
        //                 data);
        //             $('#postModal').modal(
        //                 'hide');
        //             fetchUser
        //                 ();
        //         }
        //     });
        // } else {
        //     alert(
        //         "請檢查欄位是否已填"
        //     );
        // }
    });
    $(document).on('click', '.update', function() {
        var id = $(this).attr(
            "id"
        );
        var action = "Select";
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                id: id,
                action: action
            },
            dataType: "json",
            success: function(data) {
                $('#postModal').modal('show');
                $('.modal-title').text(
                    "編輯文章"
                );
                $('#action').val("Update");
                $('#close').val('Close');

                $('#customer_id').val(
                    id
                );
                $('#category').val(data
                    .category);
                $('#subject').val(data
                    .subject);
                $('#datetimepicker').val(data
                    .datetime);
                $("#is_show").val(data
                    .is_show);
                // $('#content').val(data
                //     .content);
                //編輯器從response拿值
                $('#content').summernote('code',data.content);
            },
            error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                    console.log(textStatus);
                    console.log(error);
                    if(xhr.statusText === "Request Entity Too Large"){
                        Swal.fire({
                            position: 'top-end',
                            type: 'warning',
                            title: '你上傳的圖片已超過限制!',
                            showConfirmButton: false,
                            timer: 2000
                        }) //編輯成功彈出的提示視窗
                    }
                }
        });
    });
    //點選詳細按鈕
    $(document).on('click', '.info', function() {
        var id = $(this).attr(
            "id"
        );
        var action = "Info";
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                id: id,
                action: action
            },
            success: function(data) {
                $('#infoModal').modal('show');
                $('.modal-title').text(
                    "文章內容"
                );
                $('#post_info').html(data);
            }
        });
    });
    // //點選刪除
    // $(document).on('click', '.delete', function() {
    //     var id = $(this).attr(
    //         "id"
    //     );
    //     if (confirm("確定要刪除此筆資料嗎?")) {
    //         var action = "Delete";
    //         $.ajax({
    //             url: "action.php",
    //             method: "POST",
    //             data: {
    //                 id: id,
    //                 action: action
    //             },
    //             success: function(data) {
    //                 fetchUser
    //                     ();
    //                 // alert(
    //                 //     data);
    //             }
    //         })
    //     } else {
    //         return false;
    //     }
    // });
    //點選刪除
    $(document).on('click', '.delete', function() {
        var id = $(this).attr(
            "id"
        );
        var action = "Delete";
        Swal.fire({
            title: '確定要刪除此筆資料嗎?',
            text: "資料刪除後將無法復原!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '刪除',
            cancelButtonText: '取消',
            showConfirmButton: true
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: '資料刪除成功!',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1000
                })
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        id: id,
                        action: action
                    },
                    success: function(data) {
                        fetchUser
                            ();
                        // alert(
                        //     data);
                    }
                })
            }
        })
    });
});
</script>