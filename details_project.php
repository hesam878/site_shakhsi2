<?php
require('php/db.php');

// گرفتن نام پروژه از پارامتر آدرس
$project_name = isset($_GET['project']) ? $_GET['project'] : 'پنل مدیریت هوشمند';

// کوئری اصلی
$sql = mysqli_query($db, "SELECT * FROM `projects` WHERE `title`='$project_name' ");

// اگر پروژه پیدا نشد، از اولین پروژه استفاده کن
if(mysqli_num_rows($sql) == 0) {
    $sql = mysqli_query($db, "SELECT * FROM `projects` LIMIT 1");
}

$row = mysqli_fetch_assoc($sql);

$title = $row['title'];
$short_desc = $row['short_desc'];
$main_image = $row['main_image'];
$project_date = $row['project_date'];
$client_company = $row['client_company'];
$duration_weeks = $row['duration_weeks'];
$rating = $row['rating'];
$full_desc = $row['full_desc'];
$challenge = $row['challenge'];
$solution = $row['solution'];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات پروژه | <?php echo $title ?> | حسام جعفری‌پور</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="image/logo_site.png" type="image/png">
    <style>
        /* استایل‌های اختصاصی صفحه جزئیات پروژه */
        .project-detail-header {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
            padding: 140px 0 60px;
            border-bottom: 1px solid rgba(43, 153, 230, 0.1);
        }
        .project-badge {
            background: rgba(43, 153, 230, 0.12);
            color: #1B3C73;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            margin-left: 10px;
        }
        .project-title {
            font-size: 2.8rem;
            font-weight: 800;
            margin: 20px 0;
            background: linear-gradient(90deg, #1B3C73, #2B99E6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .project-meta-card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .meta-item {
            text-align: center;
            padding: 15px;
            border-left: 1px solid #eef2f8;
        }
        .meta-item:last-child {
            border-left: none;
        }
        .meta-label {
            font-size: 13px;
            color: #6c86a3;
            margin-bottom: 8px;
        }
        .meta-value {
            font-size: 18px;
            font-weight: 700;
            color: #1B3C73;
        }
        .project-gallery {
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 45px -12px rgba(0,0,0,0.25);
            margin-bottom: 40px;
        }
        .project-gallery img {
            width: 100%;
            transition: transform 0.4s ease;
        }
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-right: 20px;
        }
        .section-title:before {
            content: '';
            position: absolute;
            right: 0;
            top: 12px;
            width: 6px;
            height: 28px;
            background: linear-gradient(135deg, #1B3C73, #2B99E6);
            border-radius: 10px;
        }
        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 25px 0;
        }
        .tech-item {
            background: #f1f5f9;
            padding: 8px 20px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            transition: 0.2s;
        }
        .tech-item:hover {
            background: #2B99E6;
            color: white;
            transform: translateY(-2px);
        }
        .challenge-solution {
            background: linear-gradient(120deg, #f8fafc, #ffffff);
            border-radius: 28px;
            padding: 35px;
            margin: 35px 0;
            border: 1px solid rgba(43,153,230,0.15);
        }
        .result-stats {
            background: #1B3C73;
            border-radius: 28px;
            padding: 40px;
            color: white;
            margin: 45px 0;
        }
        .result-stat {
            text-align: center;
            border-left: 1px solid rgba(255,255,255,0.2);
        }
        .result-stat:last-child {
            border-left: none;
        }
        .result-number {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, #9bc5f0);
            -webkit-text-fill-color: transparent;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            border: 2px solid #2B99E6;
            color: #2B99E6;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-back:hover {
            background: #2B99E6;
            color: white;
            transform: translateX(-5px);
        }
        .btn-demo {
            background: linear-gradient(90deg, #1B3C73, #2B99E6);
            color: white;
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(43,153,230,0.3);
        }
        .btn-demo:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(43,153,230,0.4);
            color: white;
        }
        @media (max-width: 768px) {
            .project-title { font-size: 1.8rem; }
            .meta-item { border-left: none; border-bottom: 1px solid #eef2f8; }
            .result-stat { border-left: none; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
            .challenge-solution { padding: 20px; }
        }
        .feature-list {
            list-style: none;
            padding-right: 0;
        }
        .feature-list li {
            padding: 12px 0;
            padding-right: 28px;
            position: relative;
            border-bottom: 1px dashed #e9eef3;
        }
        .feature-list li:before {
            content: "✓";
            position: absolute;
            right: 0;
            color: #2B99E6;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light position-fixed">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="image/logo_header_footer.png" class="d-inline-block align-top" alt="لوگو" width="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu"
                aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between text-center" id="mainMenu">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link link_page" href="index.html">خانه</a></li>
                        <li class="nav-item"><a class="nav-link link_page" href="About.html">درباره‌من</a></li>
                        <li class="nav-item"><a class="nav-link link_page" href="Services.html">خدمات</a></li>
                        <li class="nav-item"><a class="nav-link link_page" href="nazar.html">نظرات</a></li>
                    </ul>
                    <a class="btn_link_page nav-link" href="call_me.html">تماس با من</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- بخش هدر پروژه -->
    <div class="project-detail-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div>
                        <span class="project-badge">✨ پروژه شاخص</span>
                        <span class="project-badge">UI/UX حرفه‌ای</span>
                        <span class="project-badge">داشبورد هوشمند</span>
                    </div>
                    <h1 class="project-title"><?php echo $title ?></h1>
                    <p class="lead text-secondary mt-3" style="max-width: 700px; margin: 0 auto;"><?php echo $short_desc ?></p>
                    <div class="mt-5 d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#" class="btn-demo" id="demoBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 5.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 3a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 3a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/></svg>
                            مشاهده دموی زنده
                        </a>
                        <a href="project.html" class="btn-back">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                            بازگشت به پروژه‌ها
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- گالری و متا اطلاعات -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="project-gallery">
                    <img src="<?php echo $main_image ?>" alt="<?php echo $title ?>" class="img-fluid">
                </div>
                <div class="d-flex gap-3 mt-3 justify-content-center">
                    <?php 
                    $gallery_query = mysqli_query($db, "SELECT * FROM `project_gallery` WHERE `project_id` = (SELECT `id` FROM `projects` WHERE `title`='$project_name') ORDER BY `sort_order`");
                    while($gallery = mysqli_fetch_assoc($gallery_query)){ ?>
                        <img src="<?php echo $gallery['image_path'] ?>" width="100" height="70" style="object-fit: cover; border-radius: 16px;" class="shadow-sm" title="<?php echo $gallery['caption'] ?>">
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="project-meta-card">
                    <div class="row">
                        <div class="col-6 meta-item">
                            <div class="meta-label">📅 تاریخ پروژه</div>
                            <div class="meta-value"><?php echo $project_date ?></div>
                        </div>
                        <div class="col-6 meta-item">
                            <div class="meta-label">👥 مشتری</div>
                            <div class="meta-value"><?php echo $client_company ?></div>
                        </div>
                        <div class="col-6 meta-item">
                            <div class="meta-label">⏱ زمان اجرا</div>
                            <div class="meta-value"><?php echo $duration_weeks ?> هفته</div>
                        </div>
                        <div class="col-6 meta-item">
                            <div class="meta-label">⭐ امتیاز پروژه</div>
                            <div class="meta-value text-warning"><?php echo str_repeat('★', round($rating)) . str_repeat('☆', 5 - round($rating)); ?></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h5 class="p_bold">🔧 تکنولوژی‌های استفاده شده</h5>
                    <div class="tech-stack">
                        <?php 
                        $tech_query = mysqli_query($db, "SELECT t.name FROM technologies t 
                            JOIN project_technologies pt ON t.id = pt.tech_id 
                            JOIN projects p ON p.id = pt.project_id 
                            WHERE p.title='$project_name'");
                        while($tech = mysqli_fetch_assoc($tech_query)){ ?>
                            <span class="tech-item"><?php echo $tech['name'] ?></span>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-3">
                        <div><span class="text-secondary">وضعیت:</span> <strong class="text-success">✔ تحویل شده</strong></div>
                        <div><span class="text-secondary">نوع قرارداد:</span> <strong>طراحی + فرانت</strong></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- توضیحات و چالش‌ها -->
        <div class="row mt-5">
            <div class="col-lg-8">
                <h3 class="section-title">درباره پروژه</h3>
                <p class="text-secondary lh-lg"><?php echo $full_desc ?></p>
                
                <div class="challenge-solution">
                    <h4 class="p_bold mb-3">⚡ چالش اصلی پروژه</h4>
                    <p class="text-secondary"><?php echo $challenge ?></p>
                    <h4 class="p_bold mt-4 mb-3">💡 راهکار ارائه شده</h4>
                    <p class="text-secondary"><?php echo $solution ?></p>
                </div>

                <h3 class="section-title mt-4">✨ ویژگی‌های کلیدی</h3>
                <ul class="feature-list">
                    <?php 
                    $feature_query = mysqli_query($db, "SELECT `feature_text` FROM `project_features` WHERE `project_id` = (SELECT `id` FROM `projects` WHERE `title`='$project_name') ORDER BY `sort_order`");
                    while($feature = mysqli_fetch_assoc($feature_query)){ ?>
                        <li><?php echo $feature['feature_text'] ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-4 shadow-sm mt-4 mt-lg-0">
                    <h5 class="p_bold text-center">🎯 اهداف کسب شده</h5>
                    <div class="mt-3">
                        <?php 
                        $result_query = mysqli_query($db, "SELECT * FROM `project_results` WHERE `project_id` = (SELECT `id` FROM `projects` WHERE `title`='$project_name')");
                        while($result = mysqli_fetch_assoc($result_query)){ 
                            $percent = preg_replace('/[^0-9]/', '', $result['metric_value']);
                            if($percent > 100) $percent = 100;
                        ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span><?php echo $result['metric_name'] ?></span>
                                    <span class="text-primary"><?php echo $result['metric_value'] ?><?php echo $result['unit'] ?></span>
                                </div>
                                <div class="progress mt-1" style="height: 8px;">
                                    <div class="progress-bar bg-primary" style="width: <?php echo $percent ?>%"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                
                <?php 
                $testimonial_query = mysqli_query($db, "SELECT * FROM `project_testimonials` WHERE `project_id` = (SELECT `id` FROM `projects` WHERE `title`='$project_name')");
                $testimonial = mysqli_fetch_assoc($testimonial_query);
                if($testimonial){ ?>
                <div class="bg-light p-4 rounded-4 mt-4 text-center">
                    <img src="image/logo_site.png" width="60">
                    <p class="mt-2 small text-secondary">"<?php echo $testimonial['review_text'] ?>"</p>
                    <div class="p_bold">- <?php echo $testimonial['reviewer_name'] ?>، <?php echo $testimonial['reviewer_position'] ?></div>
                    <div class="text-warning"><?php echo str_repeat('★', $testimonial['rating']) ?></div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- نتیجه‌گیری و آمار -->
        <div class="result-stats mt-5">
            <div class="row text-center">
                <?php 
                $stats_query = mysqli_query($db, "SELECT * FROM `project_results` WHERE `project_id` = (SELECT `id` FROM `projects` WHERE `title`='$project_name')");
                while($stat = mysqli_fetch_assoc($stats_query)){ ?>
                    <div class="col-md-3 result-stat">
                        <div class="result-number"><?php echo $stat['metric_value'] ?><?php echo $stat['unit'] == '%' ? '٪' : '' ?></div>
                        <div class="mt-2"><?php echo $stat['metric_name'] ?></div>
                    </div>
                <?php } ?>
            </div>
            <p class="text-center text-white-50 mt-4 mb-0">این پروژه یکی از موفق‌ترین همکاری‌های من در حوزه طراحی داشبوردهای مدیریتی بود و منجر به عقد قراردادهای بلندمدت با همان مشتری شد.</p>
        </div>

        <!-- گالری طرح‌ها و مراحل طراحی -->
        <div class="mt-5">
            <h3 class="section-title">🖌️ روند طراحی و اسکچ‌ها</h3>
            <div class="row g-3 mt-2">
                <?php 
                $gallery_query2 = mysqli_query($db, "SELECT * FROM `project_gallery` WHERE `project_id` = (SELECT `id` FROM `projects` WHERE `title`='$project_name') ORDER BY `sort_order`");
                while($gallery2 = mysqli_fetch_assoc($gallery_query2)){ ?>
                    <div class="col-md-4">
                        <div class="bg-white rounded-4 overflow-hidden shadow-sm">
                            <img src="<?php echo $gallery2['image_path'] ?>" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                            <div class="p-3"><small class="text-secondary"><?php echo $gallery2['caption'] ?></small></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- CTA برای پروژه‌های مشابه -->
        <div class="text-center mt-5 pt-4 mb-5">
            <div class="bg-white p-5 rounded-5 shadow-sm" style="background: linear-gradient(110deg, #fff, #f3f9ff);">
                <h3 class="p_bold">پروژه مشابه نیاز دارید؟</h3>
                <p class="text-secondary mt-2">من آماده همکاری در پروژه‌های طراحی داشبورد، پنل مدیریتی و رابط‌های کاربری پیچیده هستم.</p>
                <a href="call_me.html" class="btn-demo mt-3" style="display: inline-flex;">درخواست پروژه مشابه</a>
            </div>
        </div>
    </div>

    <!-- فوتر -->
    <footer>
        <div class="logo_footer text-center">
            <img src="image/logo_header_footer.png" width="130">
        </div>
        <div class="tozih text-center mainMenu mt-2">
            <p>طراح و توسعه‌دهنده هوش مصنوعی و تجربه کاربری</p>
        </div>
        <div class="links_footer text-center">
        <a href="index.html" class="nav-link d-inline-block p_bold">خانه</a>
            <a href="About.html" class="nav-link d-inline-block p_bold">درباره‌من</a>
            <a href="Services.html" class="nav-link d-inline-block p_bold">خدمات</a>
            <a href="project.html" class="nav-link d-inline-block p_bold">پروژه‌ها</a>
            <a href="nazar.html" class="nav-link d-inline-block p_bold">نظرات</a>
        </div>
        <div class="border-top text-center mt-3 justify-center">
            <p class="mt-3">طراحی شده توسط حسام جعفری‌پور.</p>
        </div>
    </footer>

    <!-- مودال دمو ساده -->
    <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title p_bold">دموی تعاملی پروژه</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <img src="<?php echo $main_image ?>" class="img-fluid rounded-3 mb-3" alt="preview">
                    <p class="text-secondary">نسخه دموی زنده <?php echo $title ?> به دلیل محرمانگی اطلاعات مشتری، صرفاً در جلسات معرفی ارائه می‌شود. برای مشاهده ویدیو معرفی با من در تماس باشید.</p>
                    <a href="call_me.html" class="btn-demo mt-2 d-inline-block" style="padding: 10px 30px;">درخواست دمو</a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#demoBtn").click(function(e) {
                e.preventDefault();
                $("#demoModal").modal("show");
            });
            $("a[href^='#']").on('click', function(e) {
                var hash = this.hash;
                if (hash !== "") {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top - 80
                    }, 600);
                }
            });
        });
    </script>
</body>
</html>