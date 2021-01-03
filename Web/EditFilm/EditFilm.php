<?php
include '../control.php';  // Using database connection file here
$movie1 = new movie;
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$movie = new movie;
$reselt = $movie->getMoviewithId($id);
$data = mysqli_fetch_assoc($reselt);
$reselt1 = $movie->Retrieveactortofilm($id);
$reselt2 = $movie->Retrievegenretofilm($id);
$reselt3 =$movie->RetrieveProductionCompanytofilm($id);
$reselt4 = $movie->getDirectorforMovie($id);
$reselt5 = $movie->getPrizeforMovie($id);
$reselt6 = $movie->getStoryforMovie($id);
//$director = mysqli_fetch_assoc($reselt4);
//$prize = mysqli_fetch_assoc($reselt5);
//$story = mysqli_fetch_assoc($reselt6);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditFilm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/AddFilm.css">
</head>

<body>

    <nav class="navbar navbar-light ">
        <div class="navbar-brand">

            <img class="d-inline-block align-top" src="https://img.icons8.com/nolan/50/movie.png" />
            <!-- <img class="d-inline-block align-top"  src="https://img.icons8.com/cotton/40/000000/movie-beginning--v1.png"/> -->
        </div>
        <div class="head">
            Edit New Film
        </div>
    </nav>

    <form method="POST" action="Add.php" enctype="multipart/form-data">
        <div class="container">
            <div class="row ">
                <div class="col-sm form-group">
                    <label class="form-label" for="title">Link for postar</label>
                    <input type="text" class="form-control" required name="postar" id="postar" value=<?= $data['POSTER'] ?>>

                </div>
                <div class="col-sm form-group">
                    <label class="form-label" for="title">Film Title </label>
                    <input type="text" class="form-control" required name="title" id="title" value=<?= $data['NAME_MOVIE'] ?>>
                </div>
                <div class="col-sm form-group">
                    <label for="example-month-input" class="form-label">Year</label>
                    <input class="form-control" type="month" value="2020-08" required name="year" id="example-month-input" value=<?= $data['YEAR'] ?>>
                </div>
            </div>


            <div class="row ">
                <div class="col-12 col-lg-4 form-group">
                    <label class="form-label" for="Duration">Duration of the Film </label>
                    <input type="text" class="form-control html-duration-picker" name="duration" required id="Duration" data-hide-seconds value=<?= $data['DURATION_MIN'] ?>>
                </div>
                <div class="col-12 col-lg-4 form-group">
                    <label class="form-label" for="Buget">Budget </label>
                    <input type="number" class="form-control" id="Buget" required name="buget" value=<?= $data['BUDGET'] ?>>
                </div>
                <div class="col-12 col-lg-4 form-group">
                    <label for="Revenue" class="form-label">Revenue</label>
                    <input class="form-control" type="number" id="Revenue" required name="revenue" value=<?= $data['REVENUE'] ?>>
                </div>
            </div>

            <div class="row ">
                <div class="col-12 col-lg-4 form-group">
                    <label class="form-label" for="rate">IMDB Rate </label>
                    <input type="number" class="form-control" id="rate" required name="rate" value=<?= $data['IMDB_RATE'] ?>>
                </div>
                <div class="col-12 col-lg-4 form-group ">
                    <label for="Count" class="form-label">IMDB Count</label>
                    <input class="form-control" type="number" id="Count" required name="count" value=<?= $data['IMDB_RATE_COUNT'] ?>>
                </div>

                <div class="col-12 col-lg-4 form-group ">
                    <label for="Count" class="form-label">Home page Link</label>
                    <input class="form-control" type="text" id="Count" required name="link" value=<?= $data['HOME_PAGE_LINK'] ?>>
                </div>
            </div>





            <div class="row ">
                <div class="col-12 col-lg-4 form-group">
                    <div class="row">
                        <div class="col-12 ">
                            <?php
                            while ($actors = mysqli_fetch_assoc($reselt1)) {
                            ?>
                            <select class="form-select form-control" aria-label="Default select example" id="A1" required name="actor1">

                                <option selected><?= $actors['FNAME'] ?><?= $actors['LNAME'] ?></option>
                                <?php

                                $records =  $movie1->getactor();

                                while ($data1 = mysqli_fetch_array($records)) {
                                    if($actors['ID'] != $data1['ID'])
                                    echo "<option value='" . $data1['ID'] . "'>" . $data1['FNAME'] . $data1['LNAME']  . "</option>";  // displaying data in option menu
                                }
                                ?>
                            </select>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
                
                <div class="col-12 col-lg-4 form-group">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            while ($genre = mysqli_fetch_assoc($reselt2)) {
                            ?>
                            <select class="form-select form-control" aria-label="Default select example" id="G1" required name="genre1">
                                <option selected><?= $genre['GENRE_TYPE'] ?></option>
                                <?php

                                $records =  $movie1->getgenre();

                                while ($data1 = mysqli_fetch_array($records)) {
                                    if($genre['ID'] != $data1['ID'])
                                    echo "<option value='" . $data1['ID'] . "'>" . $data1['GENRE_TYPE'] . "</option>";  // displaying data in option menu
                                }
                                ?>
                            </select>
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 form-group ">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            while ($ProductionCompany = mysqli_fetch_assoc($reselt3)) {
                            ?>
                            <select class="form-select form-control" aria-label="Default select example" id="P1" required name="company1">
                                <option selected><?= $ProductionCompany['COMPANY_NAME'] ?></option>
                                <?php
                                $records =  $movie1->getcompany();

                                while ($data1 = mysqli_fetch_array($records)) {
                                    if($ProductionCompany['ID'] != $data1['ID'])
                                    echo "<option value='" . $data1['ID'] . "'>" . $data1['COMPANY_NAME'] . "</option>";  // displaying data1 in option menu
                                }
                                ?>
                            </select>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>


            <div class="row ">
                <div class="col-12 col-lg-3 form-group">
                    <select class="form-select form-control" aria-label="Default select example" required name="language">
                        <option selected><?= $data['LANGUAGE_MOBIE'] ?></option>
                        <?php

                        $records =  $movie1->getlanguage();

                        while ($data1 = mysqli_fetch_array($records)) {
                            if($data['LANGUAGE_MOBIE'] != $data1['LANGUAGE_MOBIE'] )
                            echo "<option value='" . $data1['LANGUAGE_MOBIE'] . "'>" . $data1['LANGUAGE_MOBIE'] . "</option>";  // displaying data1 in option menu
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-lg-3 form-group">
                    <select class="form-select form-control" aria-label="Default select example" required name="Director">
                        <option selected><?=$director['FNAME']?><?=$director['LNAME']?></option>
                        <?php
                        $records =  $movie1->getDirector();

                        while ($data1 = mysqli_fetch_array($records)) {
                            if($director['FNAME'] != $data1['FNAME'] && $director['LNAME'] != $data1['LNAME'])
                            echo "<option value='" . $data1['ID'] . "'>" . $data1['FNAME'] . $data1['LNAME'] . "</option>";  // displaying data1 in option menu
                        }
                        ?>
                    </select>

                </div>
                <div class="col-12 col-lg-3 form-group ">
                    <select class="form-select form-control" aria-label="Default select example" name="story">
                        <option selected><?= $story['STORY_NAME'] ?></option>

                        <?php

                        $records =  $movie1->getstory();

                        while ($data1 = mysqli_fetch_array($records)) {
                            if($story['STORY_NAME'] != $data1['STORY_NAME'] )
                            echo "<option value='" . $data1['STORY_ID'] . "'>" . $data1['STORY_NAME'] . "</option>";  // displaying data1 in option menu
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 col-lg-3 form-group ">
                    <select class="form-select form-control" aria-label="Default select example" required name="prize">
                        <option selected><?= $prize['TITLE'] ?></option>
                        <?php

                        $records =  $movie1->getprize();

                        while ($data1 = mysqli_fetch_array($records)) {
                            if($prize['ID'] != $data1['ID'] )
                            echo "<option value='" . $data1['ID'] . "'>" . $data1['TITLE'] . "</option>";  // displaying data1 in option menu
                        }
                        ?>
                    </select>
                </div>
            </div>




            <div class="row ">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required name="description"></textarea>
                    <label for="floatingTextarea2"><?= $data['DESCRIPTION_OF_MOVIE'] ?></label>
                </div>

            </div>

            <div class="text-center ">
                <button type="submit" class="btn btn-lg btn-light" name="submit">Submit</button>
            </div>
        </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="../JS/html-duration-picker.min.js"></script>
    <script src="../JS/script.js"></script>
</body>

</html>