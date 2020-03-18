<div class = "card text-center">
<div id="search_header" class="card-header"> <b>Search Results:</b> </div>
<?php
if(isset($data['search'])){
    if($data['search']!= 0){
        foreach($data['search'] as &$results){
            $loginid= $results->getField('loginid')->getValue();
            $name = $results->getField('name')->getValue();
            ?><div class = 'card p-5'>
                <table class = "table" id="search_results_table">
                    <thead>
                    <tr>
                    <th scope="col">LoginID</th>
                    <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td><?php echo "<a href=/blog/u/".$loginid.">".$loginid."</a>";?></td>
                    <td><?php echo "<p>".$name."<p>";?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
       <?php }
    }  else{
       ?> <div class="card p-5"> <?php echo "<h3>Oops! The user you are trying to find does not exist!</h3>";?></div>
   <?php }
}
?>
</div>