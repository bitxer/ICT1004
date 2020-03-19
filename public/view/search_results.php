<div class = "card text-center">
<div id="search_header" class="card-header"> <b>Search Results:</b> </div>
<?php
if(isset($data['search'])){
    if($data['search']!= 0){
        ?><div class="row p-3">
        <div class="col"><b>LoginID:</b></div>
        <div class="col"><b>Name:</b></div>
    </div>
    <?php
        foreach($data['search'] as &$results){
            $loginid= $results->getField('loginid')->getValue();
            $name = $results->getField('name')->getValue();
            ?>
              <div class = 'row p-3'>
                <div class="col"><?php echo "<a href=/blog/u/".$loginid.">".$loginid."</a>";?></div>
                <div class="col"><?php echo "<p>".$name."<p>";?></div>
              </div>  
       <?php }
    }  else{
       ?> <div class="card p-5"> <?php echo "<h3>Oops! The user you are trying to find does not exist!</h3>";?></div>
   <?php }
}
?>
</div>