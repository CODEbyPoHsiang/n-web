<!-- db -->
<?php
$db = new PDO("sqlite:./nnadmin/neithnet.db");
$statement = $db->prepare("SELECT * FROM neithnet_post ORDER BY datetime DESC");
$statement->execute();
$result = $statement->fetchAll();

//首頁 NEWS_Subject
$news_subject = '';
$news_subject .= '
<div class="allNews">';

$data = [];
foreach ($result as $row) {
    if ($row["is_show"] === "Yes") {
        $news_subject .= '
        <div class="aNews animated fadeInLeft wow" style="animation-delay:.6s;">';
        if ($row["category"] === "NEWS") {
            $news_subject .= '
    <div class="newsType newsType02"> ' . $row["category"] . '
    </div>
    <div class="newsDate">' .
                $row["datetime"] . '
    </div>
    <div class="newsTitle"> &nbsp; ' .
                $row["subject"] .
                '</div>
    <a href="#lightBox'.$row["id"].'" class="btn02 open-popup" data-effect="mfp-3d-unfold">了解更多</a>
</div>
        ';
        }
        if ($row["category"] === "EVENT") {
            $news_subject .= '
            <div class="newsType "> ' . $row["category"] . '
            </div>
            <div class="newsDate">' .
                $row["datetime"] . '
            </div>
            <div class="newsTitle"> &nbsp; ' .
                $row["subject"] .
                '</div>
            <a href="#lightBox'.$row["id"].'" class="btn02 open-popup" data-effect="mfp-3d-unfold">了解更多</a>
        </div>
                ';
        }
    }
}
$news_subject .= '</div>';
// $news_subject .= '<a href="#" class="btn animated fadeInDown wow" style="animation-delay:.5s;">載入更多</a>';


//首頁 NEWS_INFO
$news_info = '';
foreach ($result as $r) {
    $news_subject .=
'<div id="lightBox'.$r["id"].'" class="lightBox mfp-with-anim mfp-hide">
<div class="lightBoxContent">
    <div class="lightBoxMain">';
    if ($r["category"] === "NEWS") {
        $news_subject .='
        <div class="lightboxNewsType lightboxNewsType02">
            NEWS
        </div>';
    }
    if ($r["category"] === "EVENT") {
        $news_subject .='
        <div class="lightboxNewsType ">
        EVENT
        </div>';
    }
    $news_subject .='
        <h1>'.
             $r["subject"] .
        '</h1>
        <br />
        <p>
           '.$r["datetime"].'
        </p>
        <br />
        <p>'.
            $r["content"] .'
        </p>
    </div>
</div>
';
}
?>


<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <title>NEITHNET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--SEO-->
    <meta itemprop="name" content="">
    <meta itemprop="image" content="">
    <meta itemprop="description" content="">

    <meta property="og:title" content="">
    </meta>
    <meta property="og:type" content="website">
    </meta>
    <meta property="og:url" content="">
    </meta>
    <meta property="og:image" content="">
    </meta>
    <meta property="og:description" content="">
    </meta>
    <!--End SEO-->

    <!--CSS-->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/ldj8uhs.css">
    <link rel="stylesheet" type="text/css" href="css/baseSlider.css">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/b0e2e1eb7f.js"></script>

    <script>
    document.documentElement.className = "js";

    var supportsCssVars = function supportsCssVars() {
        var e,
            t = document.createElement("style");
        return t.innerHTML = "root: { --tmp-var: bold; }", document.head.appendChild(t), e = !!(window.CSS && window
                .CSS.supports && window.CSS.supports("font-weight", "var(--tmp-var)")), t.parentNode.removeChild(t),
            e;
    };

    supportsCssVars() || alert("Please view this demo in a modern browser that supports CSS Variables.");
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script src="//tympanus.net/codrops/adpacks/analytics.js"></script>

    <link rel="stylesheet" href="css/demoSlider.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="js/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="css/nav.css" />
    <link rel="stylesheet" href="css/aphro.css">
</head>

<body class="loading">
    <main>
        <a href="index.php" class="mobileBg">
            <img src="img/logo01.svg" alt="" class="logo">
        </a>
        <!--Nav-->
        <div class="hamburger">
            <div class="hamburgerLine hamburgerLine01"></div>
            <div class="hamburgerLine hamburgerLine02"></div>
            <div class="hamburgerLine hamburgerLine03"></div>
        </div>
        <nav>
            <ul class="navUl">
                <li>
                    <a href="javascript:void(0)" data-scroll-nav="1">
                        首頁
                    </a>
                </li>

                <li class="socialMedia">
                    <br />
                    <a href="javascript:void(0)" data-scroll-nav="2">關於我們</a>
                </li>
                <li>
                    <a href="javascript:void(0)" data-scroll-nav="3">最新消息</a>
                </li>
                <li>
                    <a href="javascript:void(0)" data-scroll-nav="4">解決方案</a>
                </li>
                <li>
                    <a href="javascript:void(0)" data-scroll-nav="8">聯絡我們</a>
                </li>

                <!--
					<li class="socialMedia">
						
						<a href="#" target="_blank">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" target="_blank">
							<i class="fab fa-instagram"></i>
						</a>
						<a href="#" target="_blank">
							<i class="fab fa-youtube"></i>
						</a>
					</li>
				    -->

            </ul>
        </nav>
        <!--End Nav-->
        <div class="slides" data-scroll-index="1">
            <div class="slide slide--current">
                <div class="slide__img-wrap">
                    <img class="slide__img slide__img--1" src="img/01_01.png" alt="Some image">
                    <img class="slide__img slide__img--2" src="img/01_02.png" alt="Some image">
                    <div class="break"></div>
                    <img class="slide__img slide__img--3" src="img/01_03.png" alt="Some image">
                    <img class="slide__img slide__img--4" src="img/01_04.png" alt="Some image">
                </div>
                <h2 class="slide__title">
                    <span class="slide__title-inner" data-splitting="">Accelerate</span>
                    <span class="slide__title-inner slide__title-inner--middle" data-splitting="">Your</span>
                    <span class="slide__title-inner" data-splitting="">Insight</span>
                    <a href="javascript:void(0)" data-scroll-nav="2">了解更多</a>
                </h2>
            </div>
            <div class="slide">
                <div class="slide__img-wrap">
                    <img class="slide__img slide__img--1" src="img/02_01.png" alt="Some image">
                    <img class="slide__img slide__img--2" src="img/02_02.png" alt="Some image">
                    <div class="break"></div>
                    <img class="slide__img slide__img--3" src="img/02_03.png" alt="Some image">
                    <img class="slide__img slide__img--4" src="img/02_04.png" alt="Some image">
                </div>
                <h2 class="slide__title">
                    <span class="slide__title-inner" data-splitting="">NEITH</span>
                    <span class="slide__title-inner slide__title-inner--middle" data-splitting="">見微知著 超前覺察</span>
                    <span class="slide__title-inner " data-splitting="">Insight</span>
                    <a href="javascript:void(0)" data-scroll-nav="5" class="sliderbtn01">了解更多</a>
                </h2>
            </div>
            <div class="slide">
                <div class="slide__img-wrap">
                    <img class="slide__img slide__img--1" src="img/03_01.png" alt="Some image">
                    <img class="slide__img slide__img--2" src="img/03_02.png" alt="Some image">
                    <div class="break"></div>
                    <img class="slide__img slide__img--3" src="img/03_03.png" alt="Some image">
                    <img class="slide__img slide__img--4" src="img/03_04.png" alt="Some image">
                </div>
                <h2 class="slide__title">
                    <span class="slide__title-inner" data-splitting="">NEITH</span>
                    <span class="slide__title-inner slide__title-inner--middle" data-splitting="">洞察機先 間不容瞬</span>
                    <span class="slide__title-inner" data-splitting="">Seeker</span>
                    <a href="javascript:void(0)" data-scroll-nav="6" class="sliderbtn02">了解更多</a>
                </h2>
            </div>
            <!-- 2021-05-17 update -->
            <div class="slide">
                <div class="slide__img-wrap">
                    <img class="slide__img slide__img--1" src="img/04_01.png" alt="Some image">
                    <img class="slide__img slide__img--2" src="img/04_02.png" alt="Some image">
                    <div class="break"></div>
                    <img class="slide__img slide__img--3" src="img/04_03.png" alt="Some image">
                    <img class="slide__img slide__img--4" src="img/04_04.png" alt="Some image">
                </div>
                <h2 class="slide__title">
                    <span class="slide__title-inner" data-splitting="">NEITH</span>
                    <span class="slide__title-inner slide__title-inner--middle" data-splitting="">超前部署 千里御敵</span>
                    <span class="slide__title-inner" data-splitting="">Viewer</span>
                    <a href="javascript:void(0)" data-scroll-nav="7" class="sliderbtn03">了解更多</a>
                </h2>
            </div>

            <button class="slides__nav slides__nav--prev">
                <svg>
                    <path d="M82 10H9" stroke="#fff" stroke-width="2"></path>
                    <path
                        d="M10.474 0C7.988 4 4.118 7.422 0 10c4.156 2.539 7.865 6 10.474 10h2.485c-2.608-4-5.744-7.379-9.618-10C7.215 7.34 10.474 4 13 0h-2.526zm6 0C13.987 4 10.116 7.422 6 10c4.156 2.539 7.865 6 10.474 10h2.485c-2.606-4-5.745-7.379-9.617-10C13.214 7.34 16.474 4 19 0h-2.526z"
                        fill="#fff"></path>
                </svg>
            </button>
            <button id="btnNext" class="slides__nav slides__nav--next">
                <svg>
                    <path d="M0 10h73" stroke="#fff" stroke-width="2"></path>
                    <path
                        d="M71.526 0C74.012 4 77.882 7.422 82 10c-4.156 2.539-7.865 6-10.474 10h-2.485c2.608-4 5.744-7.379 9.618-10C74.785 7.34 71.526 4 69 0h2.526zm-6 0C68.013 4 71.884 7.422 76 10c-4.156 2.539-7.865 6-10.474 10H63.04c2.606-4 5.745-7.379 9.617-10C68.786 7.34 65.526 4 63 0h2.526z"
                        fill="#fff"></path>
                </svg>
            </button>
        </div>

        <section data-scroll-index="2">
            <div class="width1024 about">
                <h2 class="animated fadeInUp wow desktop" style="animation-delay:.5s;">
                    Navigator．Efficiency．Intelligent．Technology．Hope
                </h2>
                <h2 class="animated fadeInUp wow mobile" style="animation-delay:.5s;">
                    Navigator<br />Efficiency<br />Intelligent<br />Technology<br />Hope
                </h2>
                <p class="animated fadeInDown wow" style="animation-delay:.5s;">
                    騰曜網路科技（NEITHNET）由一群熱血資安專家所組成，專精於超前洞察隱匿的網路威脅，熟稔未來世界攻防的語言，每天由世界級資安實驗室（NEITHCyber Security
                    Lab）萃煉來自四面八方的巨量資料，當你以為蛛絲馬跡得如大海撈針般搜尋，我們早已超前發覺。NEITHNET的服務範疇以CTI威脅情資為核心，延伸至MDR即時監控、資安健檢、各式資安事件處理與鑑識服務等，協助客戶防範無所不在的網路威脅。
                </p>
                <a href="https://www.104.com.tw/company/1a2x6bl80p" class="btn animated fadeInUp wow"
                    style="animation-delay:.5s;">104工作機會列 </a>
            </div>
        </section>
        <section data-scroll-index="3">
            <img src="img/bg01.jpg" alt="" class="bg01">
            <img src="img/bg02.jpg" alt="" class="bg02">
            <div class="width1024 news">
                <h1 class="animated fadeInUp wow" style="animation-delay:.5s;">
                    News
                </h1>
                <!-- NEWS_Subject -->
                <?php echo $news_subject ?>

                <!-- <a href="#" class="btn animated fadeInDown wow" style="animation-delay:.5s;">載入更多</a> -->
            </div>

        </section>
        <section data-scroll-index="4">
            <h1 class="animated fadeInUp wow" style="animation-delay:.5s;">
                Solution
            </h1>
            <div class="width1024 solution">
                <a href="javascript:void(0)" class="aSolution aSolution01 animated fadeInDown wow"
                    style="animation-delay:.5s;" data-scroll-nav="5">

                    <div class="solutionImg">
                        <img src="img/product01.png" alt="">
                    </div>
                    <h2>
                        NEITHInsight
                    </h2>

                </a>
                <a href="javascript:void(0)" class="aSolution aSolution02 animated fadeInDown wow"
                    style="animation-delay:.5s;" data-scroll-nav="6">

                    <div class="solutionImg">
                        <img src="img/product02.png" alt="">
                    </div>
                    <h2>
                        NEITHSeeker
                    </h2>
                </a>
                <!-- 2021-05-17 update -->
                <a href="javascript:void(0)" class="aSolution aSolution03 animated fadeInDown wow"
                    style="animation-delay:.5s;" data-scroll-nav="7">

                    <div class="solutionImg">
                        <img src="img/product03.png" alt="">
                    </div>
                    <h2>
                        NEITHViewer
                    </h2>
                </a>
            </div>
            <div class="width1024 solutionContent">
                <a href="javascript:void(0)" data-scroll-nav="4" class="x"><i class="fas fa-times"></i></a>

                <div class="solutionContent01" data-scroll-index="5">
                    <h2 class="productTitle">
                        NEITHInsight
                    </h2>
                    <br />
                    <h2>
                        見微知著，超前覺察
                    </h2>
                    <h3>
                        Cyber Threat Intelligence
                    </h3>
                    <br />
                    <p>
                        NEITHNET團隊熟稔未來世界攻防的語言，365天分析萃煉來自四面八方的巨量網路流量，當你以為網路風險的蛛絲馬跡得如大海撈針般搜尋，我們早已超前發覺。

                    </p>
                    <br />
                    <br />
                    <br />
                    <h2>
                        Why NEITHInsight
                    </h2>
                    <div class="feature">
                        <div class="aFeature">
                            <div>
                                <h3>
                                    精準情資
                                </h3>
                                <p>
                                    提升威脅攔截能力
                                </p>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    應用彈性
                                </h3>
                                <p>
                                    廣泛整合資安設備
                                </p>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    專家服務
                                </h3>
                                <p>
                                    預防潛藏網路威脅
                                </p>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    精省成本
                                </h3>
                                <p>
                                    結合現有IT資源
                                </p>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <h2>
                        Features
                    </h2>
                    <ul>
                        <li>
                            活躍真實的全球各式端點情資
                        </li>
                        <li>
                            威脅情資Smart智能分類
                        </li>
                        <li>
                            有效防範APT及Zero Day攻擊
                        </li>
                        <li>
                            ML技術精確掌握情資動態
                        </li>
                        <li>
                            專家諮詢與資安鑑識
                        </li>
                    </ul>
                    <br />
                    <br />
                    <div class="chart">
                        <h2>
                            NEITHNET情資萃取系統<br />
                            <span>
                                Threat Data Feeds Extraction
                            </span>
                        </h2>
                        <h3 class="animated fadeInUp wow" style="animation-delay:1s;">
                            世界級IOC資料庫交換<br />
                            多種型態真實網路流量<br />
                            自建/合作建置多點採集樣本<br />
                            NEITH MDR多用戶端點資料收集<br />
                            網軍攻擊流量收集
                        </h3>
                        <div class="chartImg">

                            <img src="img/chart00.png" alt="" class="chartImg00 animated fadeInDown">

                            <div class="chartImg01 animated fadeInDown">
                                <img src="img/chart01.png" alt="">
                                <div class="chartText chartText01">
                                    Clean Raw Data
                                </div>
                            </div>
                            <div class="chartImg02 animated fadeInDown">
                                <img src="img/chart02.png" alt="">
                                <div class="chartText chartText02">
                                    Sand Box / Train Model
                                </div>
                            </div>
                            <div class="chartImg03 animated fadeInDown">
                                <img src="img/chart03.png" alt="">
                                <div class="chartText chartText03">
                                    Machine Learning
                                </div>
                            </div>
                            <div class="chartImg04 animated fadeInDown">
                                <img src="img/chart04.png" alt="">
                                <div class="chartText chartText04">
                                    Analyze
                                </div>
                            </div>
                            <div class="chartImg05 animated fadeInDown">
                                <img src="img/chart05.png" alt="">
                                <div class="chartText chartText05">
                                    Verify
                                </div>
                            </div>
                            <img src="img/chart06.png" alt="" class="chartImg06 animated fadeInDown">
                        </div>
                        <h3 class="animated fadeInDown" style="animation-delay:2.6s;">
                            最貼近真實的世界級
                            在地化精準情資
                        </h3>
                    </div>


                    <a href="javascript:void(0)" class="btn" data-scroll-nav="8">獲得更多產品資訊</a>
                </div>
                <div class="solutionContent02" data-scroll-index="6">
                    <h2 class="productTitle">
                        NEITHSeeker
                    </h2>
                    <br />
                    <h2>
                        洞察機先，間不容瞬
                    </h2>
                    <h3>
                        Managed Detection and Response
                    </h3>
                    <br />
                    <p>
                        隨時監控網路及端點資料，持續分析、判斷與追蹤，釐清各式惡意跡象，即使是微小的警示，都有助及早發現並排除風險，持續不間斷守護企業的數位資產。
                    </p>
                    <br />
                    <br />
                    <br />
                    <h2>
                        Why NEITHSeeker
                    </h2>
                    <div class="feature">
                        <div class="aFeature">
                            <div>
                                <h3>
                                    精準辨識<br />網路威脅行為
                                </h3>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    7X24<br />即時偵測網路可疑事件
                                </h3>

                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    自動辨識<br />網路威脅足跡

                                </h3>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    分析事件風險<br />及肇因根源

                                </h3>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <h2>
                        Features
                    </h2>
                    <ul>
                        <li>
                            即時高品質情資
                        </li>
                        <li>
                            威脅分析自動化
                        </li>
                        <li>
                            有效防禦Zero Day攻擊
                        </li>
                        <li>
                            APT資安專家健檢
                        </li>
                        <li>
                            可視化管理
                        </li>
                        <li>
                            高度整合各式平台
                        </li>
                    </ul>
                    <a href="javascript:void(0)" class="btn" data-scroll-nav="8">獲得更多產品資訊</a>


                </div>
                <!-- 2021-05-17 update -->
                <div class="solutionContent03" data-scroll-index="7">
                    <h2 class="productTitle">
                        NEITHViewer
                    </h2>
                    <br />
                    <h2>
                        超前部署 千里御敵
                    </h2>
                    <h3>
                        Security Information and Event Managemen
                    </h3>
                    <br />
                    <p>
                        收攏各式設備Raw Logs，進行多維度關聯分析，準確辨識惡意行為，並可偵測潛藏的DDoS 攻擊行為。有效管理與追蹤可疑事件，清楚掌握資安事件來龍去脈，確保企業網路營運安全。
                    </p>
                    <br />
                    <br />
                    <br />
                    <h2>
                        Why NEITHViewer
                    </h2>
                    <div class="feature">
                        <div class="aFeature">
                            <div>
                                <h3>
                                    有效防禦<br />DDoS攻擊
                                </h3>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    可視化<br />事件管理
                                </h3>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    威脅分析<br />人工智慧化
                                </h3>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    高度整合<br />資安設備
                                </h3>
                            </div>
                        </div>
                        <div class="aFeature">
                            <div>
                                <h3>
                                    精確情資<br />分析模組
                                </h3>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <h2>
                        Features
                    </h2>
                    <ul>
                        <li>
                            可視化事件管理
                        </li>
                        <li>
                            DDoS攻擊偵測與清洗設備聯防
                        </li>
                        <li>
                            APIs接口整合應用
                        </li>
                        <li>
                            世界級情資模組
                        </li>
                        <li>
                            高度整合各式系統與設備
                        </li>
                        <li>
                            客製化的儀表板與報告範本
                        </li>
                        <li>
                            網路行為分析
                        </li>
                        <li>
                            彈性化告警與通知
                        </li>
                        <li>
                            新一代智慧分析
                        </li>
                        <li>
                            專家諮詢及事件分析報告
                        </li>
                    </ul>
                    <a href="javascript:void(0)" class="btn" data-scroll-nav="8">獲得更多產品資訊</a>
                </div>


            </div>
        </section>
        <section class="footer" data-scroll-index="8">
            <img src="img/bg04.png" alt="" class="footerImg">
            <h1 class="animated fadeInUp wow" style="animation-delay:.5s;">
                Contact
            </h1>

            <div class="width1024 form-box">
                <form name="form1" id="form1">
                    <input type="hidden" name="frompage" id="frompage" value="web">
                    <input type="hidden" name="answer" id="q-answer" value="0">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">姓名:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">公司名稱:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="company" id="company" maxlength="100"
                                    required>
                            </div>
                        </div>
                        <div class="form-group custom-select">
                            <label for="cars">部門:</label>
                            <select id="cars" name="department" id="department">
                                <option value="IT/MIS部門">IT/MIS部門</option>
                                <option value="技術支援">技術支援</option>
                                <option value="管理行政">管理行政</option>
                                <option value="製造生產">製造生產</option>
                                <option value="財務會計">財務會計</option>
                                <option value="人資">人資</option>
                                <option value="業務行銷">業務行銷</option>
                                <option value="研發">研發</option>
                                <option value="客服">客服</option>
                                <option value="其它">其它</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">職稱:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="job_title" id="job_title" maxlength="100"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">聯絡電話:</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" name="phone" id="phone" maxlength="10"
                                    placeholder="範例 0900123456" title="請輸入正確手機格式 範例 0900123456" pattern="^09[0-9]{8}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">e-mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" placeholder="請填公司信箱，以避免擋信" name="email"
                                    id="email" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cars">產業別:</label>
                            <select id="cars" name="industry" id="yourndustry">
                                <option value="銀行業">銀行業</option>
                                <option value="保險業">保險業</option>
                                <option value="金融服務">金融服務</option>
                                <option value="生技業">生技業</option>
                                <option value="教育業">教育業</option>
                                <option value="醫療業">醫療業</option>
                                <option value="電子業">電子業</option>
                                <option value="製造業">製造業</option>
                                <option value="餐飲業">餐飲業</option>
                                <option value="娛樂業">娛樂業</option>
                                <option value="服務業">服務業</option>
                                <option value="物流業">物流業</option>
                                <option value="媒體業">媒體業</option>
                                <option value="零售業">零售業</option>
                                <option value="科技業">科技業</option>
                                <option value="不動產業">不動產業</option>
                                <option value="資訊產品/服務">資訊產品/服務</option>
                                <option value="能源/公共事業">能源/公共事業</option>
                                <option value="建築工程">建築工程</option>
                                <option value="政府機關">政府機關</option>
                                <option value="交通運輸">交通運輸</option>
                                <option value="電信服務">電信服務</option>
                                <option value="電信設備">電信設備</option>
                                <option value="石油化工">石油化工</option>
                                <option value="化學製造">化學製造</option>
                                <option value="觀光旅遊">觀光旅遊</option>
                                <option value="非營利單位">非營利單位</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">員工人數:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="headcount" id="headcount" maxlength="100"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">您的需求:</label>
                            <textarea name="demand" id="demand" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 ">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="coding" name="checkboxOK" value="checkboxOK"
                                            required>我已閱讀並同意相關<a href="#lightBox01" class="open-popup"
                                            data-effect="mfp-3d-unfold">服務條款</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 p-0">
                                <button class="btn" type="submit" id="form_submit">確認送出</button>

                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </section>

    </main>
    <svg class="cursor" width="60" height="60" viewBox="0 0 60 60">
        <circle class="cursor__inner" cx="30" cy="30" r="15"></circle>
    </svg>

    <!--A POP UP-->
    <div id="lightBox01" class="lightBox mfp-with-anim mfp-hide">
        <div class="lightBoxContent">
            <div class="lightBoxMain">
                <h1>
                    隱私權條款
                </h1>
                <br />
                <p>
                    歡迎您蒞臨「NEITHNET」（以下簡稱本網站），為了讓您安心使用本網站的各項服務與資訊，特此說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：
                </p>
                <br /><br />
                <h2>
                    一、隱私權保護政策的適用範圍
                </h2>
                <p>
                    隱私權保護政策內容，包括本網站如何處理在您使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於本網站以外的相關連結網站，也不適用於非本網站所委託或參與管理的人員。
                </p>
                <br /><br />
                <h2>
                    二、個人資料的蒐集、處理及利用方式
                </h2>
                <p>
                    ▪
                    當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性質，請您提供必要的個人資料，並在該特定目的範圍內處理及利用您的個人資料；非經您書面同意，本網站不會將個人資料用於其他用途。<br /><br />
                    ▪ 本網站在您使用服務信箱、索取資料、活動報名、訂閱電子報、問卷調查等互動性功能時，會保留您所提供的姓名、電子郵件地址、聯絡方式及使用時間等。<br /><br />
                    ▪
                    於一般瀏覽時，伺服器會自行記錄相關行徑，包括您使用連線設備的IP位址、使用時間、使用的瀏覽器、瀏覽及點選資料記錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公佈。<br /><br />
                    ▪ 為提供精確的服務，我們會將收集的問卷調查內容進行統計與分析，分析結果之統計數據或說明文字呈現，除供內部研究外，我們會視需要公佈統計數據及說明文字，但不涉及特定個人之資料。

                </p>
                <br /><br />
                <h2>
                    三、資料之保護
                </h2>
                <p>
                    ▪
                    本網站主機均設有防火牆、防毒系統等相關的各項資訊安全設備及必要的安全防護措施，加以保護網站及您的個人資料採用嚴格的保護措施，只由經過授權的人員才能接觸您的個人資料，相關處理人員皆簽有保密合約，如有違反保密義務者，將會受到相關的法律處分。<br /><br />
                    ▪ 如因業務需要有必要委託其他單位提供服務時，本網站亦會嚴格要求其遵守保密義務，並且採取必要檢查程序以確定其將確實遵守。

                </p>
                <br /><br />
                <h2>
                    四、網站對外的相關連結
                </h2>
                <p>
                    本網站的網頁提供其他網站的網路連結，您也可經由本網站所提供的連結，點選進入其他網站。但該連結網站不適用本網站的隱私權保護政策，您必須參考該連結網站中的隱私權保護政策。
                </p>
                <br /><br />
                <h2>
                    五、與第三人共用個人資料之政策
                </h2>
                <p>
                    本網站絕不會提供、交換、出租或出售任何您的個人資料給其他個人、團體、私人企業或公務機關，但有法律依據或合約義務者，不在此限。
                    <br /><br />

                    前項但書之情形包括不限於：<br />
                    經由您書面同意。<br />
                    法律明文規定。<br />
                    為免除您生命、身體、自由或財產上之危險。<br />
                    與公務機關或學術研究機構合作，基於公共利益為統計或學術研究而有必要，且資料經過提供者處理或蒐集者依其揭露方式無從識別特定之當事人。<br />
                    當您在網站的行為，違反服務條款或可能損害或妨礙網站與其他使用者權益或導致任何人遭受損害時，經網站管理單位研析揭露您的個人資料是為了辨識、聯絡或採取法律行動所必要者。<br />
                    有利於您的權益。<br />
                    本網站委託廠商協助蒐集、處理或利用您的個人資料時，將對委外廠商或個人善盡監督管理之責。
                </p>
                <br /><br />
                <h2>
                    六、Cookie之使用
                </h2>
                <p>
                    為了提供您最佳的服務，本網站會在您的電腦中放置並取用我們的Cookie，若您不願接受Cookie的寫入，可在您使用的瀏覽器功能項中設定隱私權等級為高，即可拒絕Cookie的寫入，但可能會導至網站某些功能無法正常執行。
                </p>
                <br /><br />
                <h2>
                    七、隱私權保護政策之修正
                </h2>
                <p>
                    本網站隱私權保護政策將因應需求隨時進行修正，修正後的條款將刊登於網站上。
                </p>
            </div>
        </div>
    </div>
    <!--End A POP UP-->

    <!-- NEWS_Info-->
    <!--A POP UP-->
    <?php echo $news_info?>
    <!--End A POP UP-->

    <!--Slider-->
    <script src="js/demo1.151408fb.js"></script>
    <script type="text/javascript">
    window.setInterval((() => {
        $("#btnNext").click();
    }), 3500);
    //Auto Play
    </script>


    <!--Nav-->
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="js/nav.js"></script>

    <!--Scroll It-->
    <script src="js/scrollIt.js" type="text/javascript"></script>
    <script>
    $(function() {
        $.scrollIt();
    });
    </script>

    <!--WoW-->
    <script src="js/wow.js"></script>
    <script type="text/javascript">
    new WOW().init();
    </script>

    <!--Product-->
    <!-- 2021-05-17 update&add solutionContent03 -->
    <script>
    $(function() {
        $('.aSolution01').click(function(event) {
            $('.solutionContent').addClass('active');
            $('.solutionContent01').show();
            $('.solutionContent02').hide();
            $('.solutionContent03').hide();


        });
        $('.sliderbtn01').click(function(event) {
            $('.solutionContent').addClass('active');
            $('.solutionContent01').show();
            $('.solutionContent02').hide();
            $('.solutionContent03').hide();


        });
        $('.aSolution02').click(function(event) {
            $('.solutionContent').addClass('active');
            $('.solutionContent02').show();
            $('.solutionContent01').hide();
            $('.solutionContent03').hide();


        });
        $('.sliderbtn02').click(function(event) {
            $('.solutionContent').addClass('active');
            $('.solutionContent02').show();
            $('.solutionContent01').hide();
            $('.solutionContent03').hide();


        });
        $('.aSolution03').click(function(event) {
            $('.solutionContent').addClass('active');
            $('.solutionContent03').show();
            $('.solutionContent01').hide();
            $('.solutionContent02').hide();


        });
        $('.sliderbtn03').click(function(event) {
            $('.solutionContent').addClass('active');
            $('.solutionContent03').show();
            $('.solutionContent01').hide();
            $('.solutionContent02').hide();


        });
        $('.x').click(function(event) {
            $('.solutionContent').removeClass('active');
            $('.solutionContent01').hide();
            $('.solutionContent02').hide();
            $('.solutionContent03').hide();
        });

        $('.solutionContent .btn').click(function(event) {
            $('.solutionContent').removeClass('active');
            $('.solutionContent01').hide();
            $('.solutionContent02').hide();
            $('.solutionContent03').hide();
        });
    });
    </script>

    <!--magnific-->
    <script src="js/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript">
    (function($) {

        $('.open-popup').magnificPopup({
            type: 'inline',
            fixedBgPos: true,
            fixedContentPos: true,
            removalDelay: 500, //delay removal by X to allow out-animation
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr('data-effect');
                }
            }

        });

        function hashmagnificPopup(srcid) {
            $.magnificPopup.open({
                items: {
                    src: srcid,
                    type: 'inline'
                }
            }, 0);
        }

    })(jQuery);
    </script>


    <!--防止ajax重複加載-->
    <script>
    function prevent_reloading() {
        var pendingRequests = {};
        jQuery.ajaxPrefilter(function(options, originalOptions, jqXHR) {
            var key = options.url;
            console.log(key);
            if (!pendingRequests[key]) {
                pendingRequests[key] = jqXHR;
            } else {
                //jqXHR.abort();    //放棄後觸發的提交
                pendingRequests[key].abort(); // 放棄先觸發的提交
                Swal.fire({
                    icon: 'error',
                    title: '請勿重複提交',
                    text: '您的表單我們已收到，請勿重複提交',
                    showConfirmButton: false,
                    timer: 1500,
                })
            }
            var complete = options.complete;
            options.complete = function(jqXHR, textStatus) {
                pendingRequests[key] = null;
                if (jQuery.isFunction(complete)) {
                    complete.apply(this, arguments);
                }
            };
        });
    }
    </script>

    <!-- contact form -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css">

    <script>
    $(function() {
        //ajax阻擋 
        prevent_reloading()
        $("#form1").on("submit", function(e) {
            $.ajax({
                url: 'form-api.php',
                type: 'post',
                cache: false,
                data: $('#form1').serialize(),
                dataType: 'json',
                statusCode: {
                    0: function(data) {
                        //成功後清除表單
                        document.getElementById("form1").reset();
                        //成功後跳sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: '提交成功',
                            text: '感謝您的提交，我們已收到您的表單需求!',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                    },
                    200: function(data) {
                        //成功後清除表單
                        document.getElementById("form1").reset();
                        //成功後跳sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: '提交成功',
                            text: '感謝您的提交，我們已收到您的表單需求!',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                    },
                    403: function(data) {
                        alert(
                            'Oh no! something went wrong. we should check our code to make sure everything matches with Google'
                        );
                    }
                }
            });
            e.preventDefault();
        });
    });
    </script>
</body>

</html>