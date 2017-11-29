<?php include_once "includes/header.php"?>
<?php include_once "includes/navigation.php"?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<!-- ALL Posts-->
                <?php



                $all_posts = $posts->pagination();//niza
               
                foreach($all_posts as $post){
                   
                    echo $post->render();


                }
                $pages = $posts->vkupno_strani();

                ?>
                <div class="paginator">
                     <ul class="pagination pagination-md">
                         <li class="">
                             <a href="?strana=<?php
                            if (isset($_GET['strana']) && $_GET['strana'] != 1) {
                                echo $_GET['strana']-1;
                            }else{
                                echo 1;
                            }
 ?>

                             " aria-label='Previous'>
                         <span aria-hidden="true">
                         &laquo;
                            </span>
                             </a>
                         </li>

                          <?php
                         // for($i=1;$i<$pages+1;$i++){
                          $page = isset($_GET['strana'])?$_GET['strana']:"";
                          for($i = max(1,  $page - 4); $i <= min( $page + 4, $pages); $i++){
                              if(!isset($_GET['strana']) && $i==1 ){?>
                                  <li ><a href=''  class='active'><?php echo $i ?></a></li>
                              <?php
                              continue;
                              }?>
                          <li ><a href='?strana=<?php echo $i ?>'  <?php echo (isset($_GET['strana']) && $_GET['strana']==$i)?"class='active'":"" ?> ><?php echo $i ?></a></li>
                           <?php  } ?>
                         <li class="">
                             <a href="?strana=<?php
                             if (isset($_GET['strana']) && $_GET['strana'] != $pages) {
                                 echo $_GET['strana']+1;
                             }elseif(!isset($_GET['strana'])){
                                 echo 2;
                             }else{
                                 echo $pages;
                             }
                             ?> " aria-label='Next'>
              <span aria-hidden="true">
                &raquo;
              </span>
                             </a>
                         </li>
                     </ul>

                        </div>
              
                <!-- Pager -->


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

      <?php include_once "includes/footer.php"?>
