<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cine de Arte</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

      <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>





<body>



   <div id="wrapper">

        <!-- Navigation -->




            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">&emsp;Cine de Arte</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary btn-xs" data-title="New" data-toggle="modal"  data-target="#new" class="btn btn-outline btn-primary">+ Nueva películas</button>

                        </div>



                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    include ("pel_admin_peliculas.php");
                                            $rs = $Pelicula->get_all();
                                    while( $row = mysql_fetch_array($rs)){?>

                                    <tr class='odd gradeX'>
                                        <td><img height="230" width="155" src="<?php echo utf8_encode($row['image_url'])?>" class="center-block" alt="Película"></td>
                                        <td>
                                            <b>Título:</b> <?php echo utf8_encode($row['title'])?> </br></br>
                                            <b>Sinopsis:</b> <?php echo utf8_encode($row['description'])?> </br>
                                            <b>Género:</b> &emsp;
                                            <?php
                                            $genresRes = $Pelicula->getGenres($row['id']);
                                            while ($row2 = mysql_fetch_array($genresRes)){
                                                echo utf8_encode($row2['genre'])?> &emsp;
                                            <?php }?> </br>
                                            <b>País:</b> &emsp;
                                            <?php
                                            $countriesRes = $Pelicula->getCountries($row['id']);
                                            while ($row2 = mysql_fetch_array($countriesRes)){
                                              echo utf8_encode($row2['country'])?> &emsp;
                                            <?php  } ?> </br>
                                            <b>Año:</b> <?php echo utf8_encode($row['year'])?> </br>
                                            <b>Dirigida por:</b> &emsp;
                                            <?php
                                            $directorsRes = $Pelicula->getDirectors($row['id']);
                                            while ($row2 = mysql_fetch_array($directorsRes)){
                                              echo utf8_encode($row2['director'])?> &emsp;
                                            <?php  } ?> </br>
                                            <b>Protagonizada por:</b> &emsp;
                                            <?php
                                            $actorsRes = $Pelicula->getActors($row['id']);
                                            while ($row2 = mysql_fetch_array($actorsRes)){
                                              echo utf8_encode($row2['actor'])?> &emsp;
                                            <?php  } ?> </br>
                                            <b>Premios:</b> &emsp;
                                            <?php
                                            $awardsRes = $Pelicula->getAwards($row['id']);
                                            while ($row2 = mysql_fetch_array($awardsRes)){
                                              echo utf8_encode($row2['award'])?> &emsp;
                                            <?php  } ?> </br>

                                            <p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?php echo $row['id']?>" ><span class="glyphicon glyphicon-film"></span></button></p>










                                        </td>
                                    </tr>

                                    <div class="modal fade" id="delete<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                              <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                            <h4 class="modal-title custom_align" id="Heading">Película <?php echo utf8_encode($row['description'])?></h4>
                                          </div>
                                              <div class="modal-body">


                                           <iframe width="560" height="315" src="<?php echo utf8_encode($row['clip_url'])?>" frameborder="0" allowfullscreen></iframe>
                                          </div>
                                            <div class="modal-footer ">

                                          </div>
                                            </div>
                                        <!-- /.modal-content -->
                                      </div>
                                          <!-- /.modal-dialog -->
                                        </div>



                                    <?php   }?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>



</body>

</html>
