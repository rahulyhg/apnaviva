<div class="card my-4">
    <h4 class="card-header">Question Search (Year 3)</h4>
    <form action="search3.php?page=1" method="post">
      <div class="input-group">
          <input type="text" name="search" class="form-control">
          <span class="input-group-btn">
              <button class="btn btn-primary" name="search_submit" type="submit">
                  Search
          </button>
          </span>
          </div>
    </form>

</div>

<div class="card my-4">
  <h5 class="card-header">Subject Wise Question (Year 3)</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled text-center mb-0">

            <?php

               $select_query="SELECT * from subjects3";
               $query=mysqli_query($connection,$select_query);

               while ( $row=mysqli_fetch_assoc($query)) {
                 $sub_title=$row['sub_title'];
                 $sub_id=$row['sub_id'];
             ?>
          <li class="p-2">  <a class="btn btn-primary"  style="width:250px" href="subjects3.php?s_id=<?php echo $sub_id; ?>"><?php echo ucwords($sub_title); ?></a></li>
<?php } ?>
        <hr>
        <li><a href="year3.php" class="btn btn-dark">All Subject Questions</a></li>
        </ul>
      </div>

    </div>
  </div>
</div>

<div class="card my-4">
  <h5 class="card-header">Select Your Year</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled text-center mb-0">
        <li><a href="index.php" class="list-group-item">Year 1</a></li>
        <li><a href="year2.php" class="list-group-item">Year 2</a></li>
        <li><a href="year3.php" class="list-group-item">Year 3</a></li>
        <li><a href="year4.php" class="list-group-item">Year 4</a></li>
        </ul>
      </div>

    </div>
  </div>
</div>
