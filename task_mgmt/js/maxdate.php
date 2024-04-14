<?php
  $maxdate_query = "SELECT deadline FROM main_task
                    WHERE project_id='$project_id' AND Id='$main_task_id'";
  $result_maxdate = mysqli_query($conn, $maxdate_query);
  if(mysqli_num_rows($result_maxdate) > 0) {
    while($maxdate_row=mysqli_fetch_assoc($result_maxdate))
    // $maxdate_row = ;
    $maxdate = $maxdate_row['deadline'];
    echo "<p id='max_date'>";
    echo $maxdate;
    echo "</p>";
  }
  ?>