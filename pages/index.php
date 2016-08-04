<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if($_SESSION['rol']=="GERENTE")
 echo '';
 else
    echo '<script>window.location="/megamisiones/pages/login/login.html"</script>';
    include ("mis_admin_misioneros.php");

    $query = sprintf("SELECT count(id) as misioneros from misioneros where deleted_at is null");
    $lastid = mysql_query($query);
    $row = mysql_fetch_array($lastid);  
    $nmisioneros=$row['misioneros'];

    $query = sprintf("SELECT count(id) as familias from familias where deleted_at is null");
    $lastid = mysql_query($query);
    $row = mysql_fetch_array($lastid);  
    $nfamilias=$row['familias'];

    $query = sprintf("SELECT SUM(if(monto-pagado <= 0, 1, 0)) as inscripciones FROM cxc;");
    $lastid = mysql_query($query);
    $row = mysql_fetch_array($lastid);  
    $inscripciones=$row['inscripciones'];

    $query = sprintf("SELECT FORMAT(sum(monto),2) as ingresos FROM encabezados;");
    $lastid = mysql_query($query);
    $row = mysql_fetch_array($lastid);  
    $ingresos=$row['ingresos'];  

    $query = sprintf("select format(sum(monto),2) as dia from encabezados where fecha=curdate();");
    $lastid = mysql_query($query);
    $row = mysql_fetch_array($lastid);  
    $dia=$row['dia']; 

    $query = sprintf("select count(id) as pueblos FROM pueblos;");
    $lastid = mysql_query($query);
    $row = mysql_fetch_array($lastid);  
    $pueblos=$row['pueblos'];  

    
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard inscripciones</title>

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

 <script type="text/javascript">
    $(document).ready(function(){
        $('a[data-toggle=tooltip]').tooltip();
    });
  </script>



<body>

   <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="pull-left" href="index.php"><img src="../img/jfms.png" class="left-block" alt="Cinque Terre"> </a>
                <a class="navbar-brand"  href="index.php"> Juventud y Familia Misionera</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de usuario</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login/login.html"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="pdv.php">Punto de venta</a>
                                </li>
                                <li>
                                    <a href="prod_listaProductos.php">Catálogo de productos</a>
                                </li>
                                <li>
                                    <a href="rep_prod_ven.php">Reporte artículos vendidos</a>
                                </li>
                                <li>
                                    <a href="rep_cant_ven.php">Reporte cantidad vendida</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Misioneros<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="pue_listaPueblos.php">Catálogo de pueblos</a>
                                </li>
                                <li>
                                    <a href="fam_listaFamilias.php">Catálogo de familias</a>
                                </li>
                                <li>
                                    <a href="mis_listaMisioneros.php">Catálogo de misioneros</a>
                                </li>
                                <li>
                                    <a href="rep_cant_ven.php">Reporte de inscripciones</a>
                                </li>
                                <li>
                                    <a href="ped_online.php">Pedidos en línea</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DASHBOARD INSCRIPCIONES 
                    
                <a href="dashmoney.php"  class="btn btn-warning btn-lg align-righ"><span class="glyphicon glyphicon-usd"></span> Dashboard económico</a>
            </h1>

                </div>

                 
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                  <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-child fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nmisioneros; ?></div>
                                    <div>Misioneros Inscritos</div>
                                </div>
                            </div>
                        </div>
                        <a href="mis_listaMisioneros.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nfamilias; ?></div>
                                    <div>Familias Registradas</div>
                                </div>
                            </div>
                        </div>
                        <a href="fam_listaFamilias.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
              
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $inscripciones; ?></div>
                                    <div>Familias Inscritas</div>
                                </div>
                            </div>
                        </div>
                        <a href="rep_inscripciones.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="lead"><?php echo $pueblos; ?></div>
                                    <div>Total Pueblos</div>
                                </div>
                            </div>
                        </div>
                        <a href="rep_pueblos.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>


                
            
    </div>
    <!-- /#wrapper -->

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
