<?php include "includes/header.php" ?>
    <!-- Navigation -->
  <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

        <?php
         $per_page=5;
         if(isset($_GET['s_id'])){
           $s_id=$_GET['s_id'];
         }

         if(isset($_GET['page'])){
           if($_GET['page']<=0){
          header("Location:pagenotfound.php");
           }else{
           $page=$_GET['page'];
           }
           
         }else{
           header("Location:subject.php?s_id=$s_id&page=1");
         }

         if($page==1){
           $start_count=0;
         }
        
         else{
           $start_count=($page*$per_page)-$per_page;
         }

         $questions_count="SELECT * from posts WHERE post_subject_id='$s_id' ";
         $count_query=mysqli_query($connection,$questions_count);
         $count=mysqli_num_rows($count_query);
         $count=ceil($count/$per_page);

         if($count<1){
           echo "<br><br>";
           echo "<h2 class='text-danger text-center'>NO QUESTIONS YET</h2>";
         }
         else{


         $select_question="SELECT * from posts WHERE post_subject_id='$s_id' LIMIT $start_count,$per_page ";
         $select_query=mysqli_query($connection,$select_question);
         if(!$select_query){
           die("Connection failed ".mysqli_error($connection));
         }

         while($row=mysqli_fetch_assoc($select_query)){
           $question=strip_tags($row['post_question']);
           $answer=strip_tags($row['post_answer']);
           $date=$row['post_date'];
           $author_name=strip_tags($row['post_author_name']);

         ?>

           <!-- Post Question -->
          <h2 class="mt-4"><?php
           echo "Q. ";
           echo ucwords($question); ?></h2>

          <!-- Author -->
          <p class="lead">
              by
            <span class="text-primary"><?php echo ucwords($author_name); ?></span>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $date; ?></p>

          <hr>


          <!-- Post Answer -->
          <p class="lead"><?php echo  ucwords($answer); ?></p>
          <br>
        <?php } ?>
          <br>

    <?php
      echo "<ul class='pagination justify-content-center'>";
       for($i=1;$i<=$count;$i++){

         if($page>$count){
          header("Location:pagenotfound.php");
         }
         else if($i==$page){
            echo "<li class='page-item active'><a class='page-link' href='subject.php?s_id=$s_id&page=$i'>$i</a></li>";
         }else{
            echo "<li class='page-item'><a class='page-link' href='subject.php?s_id=$s_id&page=$i'>$i</a></li>";
         }

       }
      echo "</ul>";
    ?>
  <?php } ?>
 <br><br>
     <?php

       if(isset($_POST['submit'])){
           $ques=$_POST['question'];
           $ques=mysqli_real_escape_string($connection,$ques);
           $ans=$_POST['answer'];
           $ans=mysqli_real_escape_string($connection,$ans);
           $name=$_POST['author_name'];
           $name=mysqli_real_escape_string($connection,$name);
           $pid= $_POST['post_subject_id'];
           $insert_post="INSERT INTO `posts` (`post_id`, `post_question`, `post_answer`, `post_date`,
                         `post_author_name`,`post_subject_id`) VALUES('','$ques','$ans',now(),'$name','$pid')";
           $insert_query=mysqli_query($connection,$insert_post);
           if(!$insert_query){
             die("Connection failed ".mysqli_error($connection));
           }
           header("Location:subject.php?s_id=$pid");

       }


      ?>
          <!-- Add Question -->
          <div class="card my-4">
            <h5 class="card-header">Post Your Question</h5>
            <div class="card-body">
              <form action="" method="post" onsubmit="return confirm('Click Ok to add the question')">
                <div class="form-group">
                  <input type="text" name="author_name" class="form-control" placeholder="Enter Your Name" required>
                </div>
                <div class="form-group">
                  
                  <select  name="post_subject_id">
                    <option value="">Select Subject</option>
                    <?php

                      $select_query="SELECT * from subjects";
                      $query=mysqli_query($connection,$select_query);
                      while($row=mysqli_fetch_assoc($query)){
                        $sub_id=$row['sub_id'];
                        $sub_title=$row['sub_title'];
                     ?>
                    <option value="<?php echo $sub_id;?>"><?php echo ucwords($sub_title); ?></option>
                  <?php } ?>
                  </select>

                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="1" placeholder="Enter Question" name="question" required></textarea>
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="3" placeholder="Enter Answer" name="answer" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary" onsubmit="alert('Question added successfuly')">Add Question</button>
              </form>
            </div>
          </div>

          <!-- Single Comment -->




        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
         <!--           <div class="card my-4">
                 <h5 class="card-header">Search</h5>
                 <div class="card-body">
                   <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search for...">
                     <span class="input-group-btn">
                       <button class="btn btn-secondary" type="button">Go!</button>
                     </span>
                   </div>
                 </div>
               </div>
     -->
               <!-- Subjects Widget -->
          <?php include "includes/subjects_widget.php" ?>
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">About Project</h5>
            <div class="card-body">
              We made this to help students to prepare them for viva
              and to know questions which their seniors have already faced
            </div>
          </div>


        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
  <?php include "includes/footer.php" ?>
