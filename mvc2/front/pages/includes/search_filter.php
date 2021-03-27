<?php include "db.php"; 
    
    if(isset($_POST['action'])){
        $query = "SELECT * FROM seller_notes WHERE Status = 'Published'";
        $output = "";

        if(!empty($_POST['search'])){
            $query .= "AND Title REGEXP '{$_POST['search']}'";
        }
        if(!empty($_POST['type'])){
            $query .= "AND NoteType = '{$_POST['type']}'";
        }
        if(!empty($_POST['category'])){
            $query .= "AND Category = '{$_POST['category']}'";
        }
        if(!empty($_POST['university'])){
            $query .= "AND UniversityName = '{$_POST['university']}'";
        }
        if(!empty($_POST['course'])){
            $query .= "AND Course = '{$_POST['course']}'";
        }
        if(!empty($_POST['country'])){
            $query .= "AND Country = '{$_POST['country']}'";
        }
        if(!empty($_POST['rating'])){
            $query .= "AND NoteID = (SELECT sn.NoteID FROM seller_notes AS sn INNER JOIN seller_notes_reviews AS snr ON sn.NoteID = snr.NoteID WHERE snr.Ratings = '{$_POST['rating']}')";
        }

        $result = mysqli_query($connection, $query);
        if(!$result){
            echo "error" . mysqli_error($connection);
        }
        $count_row = mysqli_num_rows($result);

        $output .= '
            <div class="row" >
            <div class="col-md-12 col-sm-12">
                <h3 class="heading">total '.$count_row.' notes</h3>
            </div>
            </div>
             <div class="row">
        ';

        if($count_row > 0) {
            while($row = mysqli_fetch_array($result)){
                $db_NoteID = $row['NoteID'];
                $db_PublishedDate = $row['PublishedDate'];
                $db_Title = $row['Title'];
                $db_Category = $row['Category'];
                $db_Type = $row['NoteType'];
                $db_DisplayPicture = $row['DisplayPicture'];
                $db_NumberOfPages = $row['NumberOfPages'];
                $db_UniversityName = $row['UniversityName'];
                $db_Country = $row['Country'];
                $db_Course = $row['Course'];

                $query1 = "SELECT CountryName FROM countries WHERE CountryID = '{$db_Country}' ";
                $coun_name = mysqli_query($connection, $query1);
                $row = mysqli_fetch_array($coun_name);
                $db_CountryName = $row['CountryName'];
                
                $query = "SELECT * FROM  seller_notes_reported_issues WHERE NoteID = '{$db_NoteID}'";    
                $check_report = mysqli_query($connection, $query);
                $total_report = mysqli_num_rows($check_report);

                $query = "SELECT * FROM  seller_notes_reviews WHERE NoteID = '{$db_NoteID}'";
                $check_reviews = mysqli_query($connection, $query);
                $total_review = mysqli_num_rows($check_reviews);
                
                $full_star = "";
                $empty_star = "";
                
                if(!empty($total_review)){
                    $stars = 0;
                    while($row = mysqli_fetch_array($check_reviews)){
                        $stars += $row['Ratings'];
                    }
                    
                    $stars = round($stars/$total_review);
                    
                    
                    for($i = 1; $i <= $stars; $i++) {
                        $full_star .= '<img class="star" src="../images/Front_images/star.png" alt="Star">';
                    }
                    for($i = 1; $i <= (5-$stars); $i++) {
                        $empty_star .= '<img class="star" src="../images/Front_images/star-white.png" alt="Star">';
                    }
                }else {
                    for($i = 1; $i <= 5; $i++) {
                        $empty_star .= '<img class="star" src="../images/Front_images/star-white.png" alt="Star">';
                    }
                }

            $output .= '

                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="notes-container">
                <a href="note-details.php?NoteID='.$db_NoteID.'">
                    <img src="../uploaded files/'.$db_DisplayPicture.'" alt="Search notes Image" class="img-responsive">
                </a>

                <div class="note">
                    <!-- notes heading -->
                    <h3 class="heading">'.$db_Title.'</h3>

                        <!-- Notes Details -->
                        <ul class="note-details">

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-2">
                                    <li><img src="../images/Front_images/university.png"></li>
                                </div>
                                <div class="col-md-10 col-sm-10 col-10 span">
                                    <span>'.$db_UniversityName.','.$db_CountryName.'</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2  col-sm-2 col-2">
                                    <li><img src="../images/Front_images/pages.png"></li>
                                </div>
                                <div class="col-md-10 col-sm-10 col-10 span">
                                    <span>'.$db_NumberOfPages.'</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-2">
                                    <li><img src="../images/Front_images/date.png"></li>
                                </div>
                                <div class="col-md-10 col-sm-10 col-10 span">
                                    <span>'.$db_PublishedDate.'</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-2">
                                    <li><img src="../images/Front_images/flag.png"></li>
                                </div>
                                <div class="col-md-10 col-sm-10 col-10 span">
                                    <span style="color: #df3434">'.$total_report.' Users marked this note as inappropriate </span>
                                </div>
                            </div>

                        </ul>

                    <!-- Stars -->	
                            
                            '.$full_star.'
                            '.$empty_star.'
                    
                    <span class="span">'.$total_review.' reviews</span>

                </div>
                </div>
                </div>
            ';
            }
        }
        echo $output;
    }
    
?> 


<script>

    var items = $(".notes-container");
        var numItems = items.length;
        var perPage = 6;

        items.slice(perPage).hide();

        $('#pagination').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function (pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });
        
    
</script>