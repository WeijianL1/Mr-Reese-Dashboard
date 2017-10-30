<?php
  include 'database.php';
  // $sort = array_key_exists('sort', $_GET) ? $_GET['sort'] : null;
    $questions = $db->query('SELECT DISTINCT id,question_content FROM qna ORDER BY id DESC ')->fetchAll(PDO::FETCH_ASSOC);
    $failed_questions = $db->query('SELECT DISTINCT id,question_content FROM qna WHERE success=0 ORDER BY id DESC ')->fetchAll(PDO::FETCH_ASSOC);
    $success_questions = $db->query('SELECT DISTINCT id,question_content FROM qna WHERE success=1 ORDER BY id DESC ')->fetchAll(PDO::FETCH_ASSOC);
    $userNum= $db->query('SELECT * FROM qna GROUP BY user_id')->fetchAll(PDO::FETCH_ASSOC);
    $topQs=$db->query('SELECT COUNT(*) as x,question_content FROM qna GROUP BY answer_id ORDER BY x DESC')->fetchAll(PDO::FETCH_ASSOC);
  
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Mr.Reese</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="carolina" data-image="assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="http://mrreese.web.unc.edu" class="simple-text">
                    <img src="assets/img/logo.png" alt="" width="220px"/>
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
                    <li>
                        <a href="./user.html">
                            <i class="material-icons">note_add</i>
                            <p>Raise a Question</p>
                        </a>
                    </li>
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
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
                                  <!-- edit count here -->
                                  <!-- edit count here -->
                                  <!-- edit count here -->
                                  <h3 class="title"><?= count($questions); ?>
                                  </h3>
                                  <!-- edit count here -->
                                  <!-- edit count here -->
                                  <!-- edit count here -->

                              </div>
                              <div class="card-footer">
                                  <div class="stats">
                                      <!-- <i class="material-icons text-danger">warning</i> -->
                                      Show all questions
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
                                      Show answered questions
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
                                      <i class="material-icons">local_offer</i> Tracked from xxx
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- <div class="col-lg-3 col-md-6 col-sm-6">
                          <div class="card card-stats">
                              <div class="card-header" data-background-color="blue">
                                  <i class="fa fa-twitter"></i>
                              </div>
                              <div class="card-content">
                                  <p class="category">Followers</p>
                                  <h3 class="title">+245</h3>
                              </div>
                              <div class="card-footer">
                                  <div class="stats">
                                      <i class="material-icons">update</i> Just Updated
                                  </div>
                              </div>
                          </div>
                      </div> -->
                  </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-nav-tabs">
                              <div class="card-header" data-background-color="purple">
                                  <h4 class="title">Most Asked Questions</h4>
                                  <p class="category">Some text here</p>
                              </div>
                                <div class="card-content">
                                    <div class="tab-content">
                                      <table class="table table-hover">
                                          <thead class="text-primary">
                                              <th>Times of being Asked</th>
                                              <th>Content</th>
                                          </thead>
                                          <tbody>
                                            <?php foreach($topQs as $q) : ?>
                                            <tr>
                                              <td><a><?= $q['x']; ?></a></td>
                                              <td><a><?= $q['question_content']; ?></a></td>
                                            </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Latest Questions</h4>
                                    <p class="category">Not yet posted</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <th>Question Id</th>
                                            <th>Question</th>
                                        </thead>
                                        <tbody>
                                          <?php foreach($questions as $q) : ?>
                                          <tr>
                                            <td><a><?= $q['id']; ?></a></td>
                                            <td><a><?= $q['question_content']; ?></a></td>
                                          </tr>
                                          <?php endforeach; ?>
                                            <!-- <tr>
                                                <td>1</td>
                                                <td>Where can I buy a dolphin watch?</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Where can I watch a dolphin show?</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="green">
                                    <h4 class="title">Failed Questions</h4>
                                    <p class="category">Not yet posted</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-success">
                                            <th>Question Id</th>
                                            <th>Question</th>
                                        </thead>
                                        <tbody>
                                          <?php foreach($failed_questions as $q) : ?>
                                          <tr>
                                            <td><a><?= $q['id']; ?></a></td>
                                            <td><a><?= $q['question_content']; ?></a></td>
                                          </tr>
                                          <?php endforeach; ?>
                                            <!-- <tr>
                                                <td>1</td>
                                                <td>Where can I buy a dolphin watch?</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Where can I watch a dolphin show?</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
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
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<!-- <script src="assets/js/chartist.min.js"></script> -->
<!--  Dynamic Elements plugin -->
<script src="assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>

</html>
