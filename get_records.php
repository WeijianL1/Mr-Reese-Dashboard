<?php
include 'ChromePhp.php';
require_once 'database.php'; //include required dbconfig file
ChromePhp::log("Hello");
$item_per_page = 10;
//sanitize post value
if(isset($_POST["page"])){
 $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
 if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
 $page_number = 1;
}
//get current starting point of records
$position = (($page_number-1) * $item_per_page);
ChromePhp::log($position);
$results = $db->prepare('SELECT COUNT(*) as x,question_content,answer_content FROM qna Q join answers A on Q.answer_id=A.id GROUP BY answer_id ORDER BY x DESC LIMIT 10 OFFSET 0');
$results->execute();
//getting results from database
?>

<!-- <ul class="page_result">
<?php
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
 ?>

 <li>
 <a href=""><?php echo $row['question_content'];
   ?></a>
 </li>

 <?php
}
?>
</ul> -->
