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
$results = $db->prepare("SELECT DISTINCT Q.id,question_content,answer_content,confidence,source FROM qna Q join answers A on Q.answer_id=A.id WHERE success=1 ORDER BY Q.id DESC LIMIT $position,$item_per_page");
$results->execute();
//getting results from database
?>


  <table class="table table-hover">
      <thead class="text-warning">
          <th width="20%">Question Id</th>
          <th width="50%">Question</th>
          <th width="15%">Confidence</th>
          <th width="15%">Source</th>
      </thead>
      <tbody>
        <div id="Accordion1" data-children=".item1">
<?php
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
 ?>
 <tr>
   <td><p><?= $row['id']; ?></p></td>
   <td>

     <div class="item1">
       <a data-toggle="collapse" data-parent="#Accordion1" href="#latest<?= $row['id']; ?>" aria-expanded="true" aria-controls="<?= $row['id']; ?>">
         <?= $row['question_content']; ?>
       </a>
       <div id="latest<?= $row['id']; ?>" class="collapse" role="tabpanel">
         <p class="mb-3">
           <br>
           <?= $row['answer_content']; ?>
         </p>
       </div>
     </div>
   </td>
   <td>
     <p class="mb-3">
       <br>
       <?= $row['confidence']; ?>
       <?php if($row['confidence']) : ?>
           %
       <?php endif; ?>
     </p>
   </td>
   <td>
     <p class="mb-3">
       <br>
       <?= $row['source']; ?>
     </p>
   </td>
 </tr>

 <?php
}
?>
      </div>
    </tbody>
  </table>
