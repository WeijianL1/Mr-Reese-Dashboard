<?php
  include 'database.php';
  include 'ChromePhp.php';

  ChromePhp::log('Hello console!');
    $questions = $db->query('SELECT DISTINCT id,question_content FROM qna ORDER BY id DESC ')->fetchAll(PDO::FETCH_ASSOC);
    $failed_questions = $db->query('SELECT DISTINCT id,question_content FROM qna WHERE success=0 ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
    $success_questions = $db->query('SELECT DISTINCT Q.id,question_content,answer_content FROM qna Q join answers A on Q.answer_id=A.id WHERE success=1 ORDER BY Q.id DESC')->fetchAll(PDO::FETCH_ASSOC);
    $userNum= $db->query('SELECT * FROM qna GROUP BY user_id')->fetchAll(PDO::FETCH_ASSOC);
    $topQs=$db->query('SELECT COUNT(*) as x,question_content,answer_content FROM qna Q join answers A on Q.answer_id=A.id GROUP BY answer_id ORDER BY x DESC')->fetchAll(PDO::FETCH_ASSOC);
    $item_per_page = 10;

    $pages = ceil(count($topQs)/$item_per_page);
    $pages_sucess = ceil(count($success_questions)/$item_per_page);
    $pages_failed = ceil(count($failed_questions)/$item_per_page);

    ChromePhp::log(count($topQs));
    ChromePhp::log(count($success_questions));
    ChromePhp::log(count($failed_questions));

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Mr.Reese</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/jquery.bootpag.js" type="text/javascript" ></script>

    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="carolina" data-image="../assets/img/sidebar-unc.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="http://mrreese.web.unc.edu" class="simple-text">
                    <img src="../assets/img/logo.png" alt="" width="220px"/>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="dashboard.html">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="./user.html">
                            <i class="material-icons">note_add</i>
                            <p>Raise a Question</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Mr.Reese Dashboard </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-4 col-md-12 col-sm-12">
                          <div class="card card-stats">
                              <div class="card-header" data-background-color="orange">
                                  <i class="material-icons">assignment</i>
                              </div>
                              <div class="card-content">
                                  <p class="category">Question Asked</p>

                                  <h3 class="title"><?= count($questions); ?>
                                  </h3>

                              </div>
                              <div class="card-footer">
                                  <div class="stats">
                                      <!-- <i class="material-icons text-danger">warning</i> -->
                                      Since Nov.1st
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4 col-md-12 col-sm-12">
                          <div class="card card-stats">
                              <div class="card-header" data-background-color="green">
                                  <i class="material-icons">check_circle</i>
                              </div>
                              <div class="card-content">
                                  <p class="category">Question Successfully Answered</p>
                                  <h3 class="title"><?= count($success_questions); ?></h3>
                              </div>
                              <div class="card-footer">
                                  <div class="stats">
                                        Since Nov.1st
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4 col-md-12 col-sm-12">
                          <div class="card card-stats">
                              <div class="card-header" data-background-color="blue">
                                  <i class="material-icons">account_circle</i>
                              </div>
                              <div class="card-content">
                                  <p class="category">Users</p>
                                  <h3 class="title"><?= count($userNum); ?></h3>
                              </div>
                              <div class="card-footer">
                                  <div class="stats">
                                      Live User
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-nav-tabs">

                              <a data-toggle="collapse"  href="#card_most_asked" aria-expanded="true">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Most Asked Questions</h4>
                                    <p class="category">Click to expand / Click on the questions to show answers</p>
                                </div>
                              </a>
                                <div class="card-content collapse" role="tabpanel" id="card_most_asked">
                                    <div class="tab-content">

                                      <div id="results_most"></div>
                                      <div class="paging_link_most paging_link"></div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                              <a data-toggle="collapse"  href="#card_latest" aria-expanded="true">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Latest Successful Questions</h4>
                                    <p class="category">Click to expand / Click on the questions to show answers</p>
                                </div>
                              </a>
                                <div class="card-content table-responsive collapse" role="tabpanel" id="card_latest">

                                  <div id="results_latest"></div>
                                  <div class="paging_link_latest paging_link"></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                              <a data-toggle="collapse"  href="#card_failed" aria-expanded="true">
                                <div class="card-header" data-background-color="green">
                                    <h4 class="title">Failed Questions</h4>
                                    <p class="category">Click to expand</p>
                                </div>
                              </a>
                                <div class="card-content table-responsive collapse" id="card_failed" role="tabpanel">

                                  <div id="results_failed"></div>
                                  <div class="paging_link_failed paging_link"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Mr.Reese Website
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://mrreese.web.unc.edu"></a>, made by Zhenwei Zhang, Weijian Li, Yichen Jiang, Zhengyang Fang
                    </p>
                </div>
            </footer>
        </div>
    </div>


    <script>
    $(document).ready(function() {
     $("#results_most").load("get_records.php"); //initial page number to load
     $(".paging_link_most").bootpag({
     total: <?php echo $pages; ?>
     }).on("page", function(e, num){
     e.preventDefault();
     $("#results_most").load("get_records.php", {'page':num});
     });
    });

    $(document).ready(function() {
     $("#results_failed").load("get_records_failed.php"); //initial page number to load
     $(".paging_link_failed").bootpag({
     total: <?php echo $pages_failed; ?>
     }).on("page", function(e, num){
     e.preventDefault();
     $("#results_failed").load("get_records_failed.php", {'page':num});
     });
    });

    $(document).ready(function() {
     $("#results_latest").load("get_records_latest.php"); //initial page number to load
     $(".paging_link_latest").bootpag({
     total: <?php echo $pages_sucess; ?>
     }).on("page", function(e, num){
     e.preventDefault();
     $("#results_latest").load("get_records_latest.php", {'page':num});
     });
    });
    </script>
</body>
<!--   Core JS Files   -->
<!-- <script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script> -->
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<!-- <script src="assets/js/chartist.min.js"></script> -->
<!--  Dynamic Elements plugin -->
<script src="../assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>

</html>
