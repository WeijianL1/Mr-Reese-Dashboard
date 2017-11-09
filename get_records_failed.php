<?php
include 'ChromePhp.php';
require_once 'database.php'; //include required dbconfig file
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
$results = $db->prepare("SELECT DISTINCT id,question_content FROM qna WHERE success=0 ORDER BY id DESC LIMIT $position,$item_per_page");
$results->execute();
//getting results from database
?>


  <table class="table table-hover">
      <thead class="text-success">
          <th>Question Id</th>
          <th>Question</th>
      </thead>
      <tbody>
<?php
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
 ?>
 <tr>
   <td><a class="failed"><?= $row['id']; ?></a></td>
   <td><a class="failed"><?= $row['question_content']; ?></a></td>
 </tr>

 <?php
}
?>
      </div>
    </tbody>
  </table>
