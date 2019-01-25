<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <?php
      if(isset($_GET['s_id'])){
        $s_id=$_GET['s_id'];

        $select_query="SELECT * from subjects2 WHERE sub_id=$s_id";
        $query=mysqli_query($connection,$select_query);
        $row=mysqli_fetch_assoc($query);
        $sub_title=$row['sub_title'];
       ?>
    <?php echo ucwords($sub_title);}else{
      echo "All Questions &#40;Year 2&#41;";
    } ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

        <li class="dropdown pl-2 pt-2">
          <button type="button"  class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
            Select Year
          </button>
          <div class="dropdown-menu">
            <a href="index.php" class="dropdown-item">Year 1</a>
            <a href="year2.php" class="dropdown-item">Year 2</a>
            <a href="year3.php" class="dropdown-item">Year 3</a>
            <a href="year4.php" class="dropdown-item">Year 4</a>

          </div>
        </li>

        <li class="dropdown pl-2 pt-2">
          <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
            Select Subject
          </button>
          <div class="dropdown-menu">
            <?php

            $select_query="SELECT * from subjects2";
            $query=mysqli_query($connection,$select_query);
            while($row=mysqli_fetch_assoc($query)){
              $sub_title=$row['sub_title'];
              $sub_id=$row['sub_id'];
            ?>
            <a class="dropdown-item" href="subjects2.php?s_id=<?php echo $sub_id; ?>"><?php echo $sub_title; ?></a>
          <?php } ?>
           <hr>
           <a href="index.php" class="dropdown-item">All Subject Questions</a>
          </div>
        </li>

        <li class="nav-item active pl-2 pt-2">
          <a class="btn btn-dark" href="../index.php">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
