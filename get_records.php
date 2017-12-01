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
// ChromePhp::log($position);
// ChromePhp::log($item_per_page);
$results = $db->prepare("SELECT COUNT(*) as x,question_content,answer_content,Q.id  FROM qna Q join answers A on Q.answer_id=A.id where answer_content != '0' GROUP BY answer_id ORDER BY x DESC LIMIT $position,$item_per_page");
$results->execute();
//getting results from database
?>


  <table class="table table-hover">
      <thead class="text-primary">
          <th width="20%">Times being Asked</th>
          <th width="80%">Content</th>
      </thead>
      <tbody>
        <div id="Accordion" data-children=".item">
<?php
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
 ?>
 <tr>
   <td><p><?= $row['x']; ?></p></td>
   <td>
     <div class="item">
       <a data-toggle="collapse" data-parent="#Accordion" href="#<?= $row['id']; ?>" aria-expanded="true" aria-controls="<?= $q['id']; ?>">
         <?= $row['question_content']; ?>
       </a>
       <div id="<?= $row['id']; ?>" class="collapse" role="tabpanel">
         <p class="mb-3">
           <br>
           <?= $row['answer_content']; ?>
         </p>
       </div>
     </div>

   </td>
 </tr>

 <?php
}
?>
      </div>
    </tbody>
  </table>
