<?php

//check http referer
$referer_url = $_SERVER['HTTP_REFERER'];
$referer_url_arr =  parse_url($_SERVER['HTTP_REFERER']);
$host = $referer_url_arr['host'];

if ($referer_url == null || !in_array($host, array("www.neithnet.com","nms6.vir999.com"))) {
    http_response_code(404);
    echo "<center><font color='red'> <h1>未經允許操作，請由首頁進入</h1> </font></center>";
    exit;
} else {
    // 表單
    $name = $_POST["name"];
    $company = $_POST['company'];
    $department = $_POST["department"];
    $job_title = $_POST["job_title"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $industry = $_POST["industry"];
    $headcount = $_POST["headcount"];
    $demand = $_POST["demand"];
    //取得現在時間
    $date_time = date('Y/m/d H:i:s');
    //取得使用者ip
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://docs.google.com/forms/u/0/d/e/1FAIpQLSc8ufcE44B1sSbaSaPrerNQiqnezlGAnSEQ9fpryUAlXWVslA/formResponse',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'entry.1797073297' => $name,
        'entry.970604102' => $company,
        'entry.397559261' => $department,
        'entry.1514632519' => $job_title,
        'entry.636845694' => $phone,
        'entry.706399753' => $email,
        'entry.520348550' => $industry,
        'entry.241262127' => $headcount,
        'entry.859949030' => $demand,
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    if ($response) {

  //將表單內容寫入log
        $log_message = $date_time.",".$user_ip.",".$name.",".$company.",".$department.",".$job_title.",".$phone.",".$email.",".$industry.",".$headcount.",".$demand. "\r\n";
        $file = fopen("neithnet-form.log", "a+");
        fwrite($file, $log_message);
        fclose($file);

        echo("message:Submitted successfully!");
    }
}
