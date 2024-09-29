<?php
include "../classes/userContr.classes.php";
include '../classes/db.php';
include '../classes/locations.classes.php';
include '../classes/locationscntrl.classes.php';
$saved_locations = new locationsCntrl();

$userdata = new UserCntr();
$user = $userdata->get_userdata();


if(isset($user)){
      
  $name = ucfirst($user['first_name']).' ' .ucfirst($user['last_name']);
  $username = $user['username'];
  $role = $user['role'];
  if($role == 0){ 


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "includes/header.php"; ?>
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <style>
      ul.bar_tabs>li {
        border: none;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-paw"></i>94TH MICO<span></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= ucfirst($username); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include "../includes/sidebar.inc.php"; ?>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="../images/user.png" alt=""><?= ucfirst($name); ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="../includes/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

              <div class="clearfix"></div>

              <div class="">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_content ">

                    <ul class="nav nav-tabs bar_tabs" style="border-style: none;" id="myTab" role="tablist">
                      <li class="nav-item mr-1">
                        <a class="nav-link <?php if(isset($_GET['success']) && $_GET['success'] == 'selector'){ echo 'active'; }else if(empty($_GET)) { echo 'active'; }else{ echo ''; } ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="selector()">SELECTOR</a>
                      </li>
                      <li class="nav-item mr-1">
                        <a class="nav-link <?php  if(isset($_GET['success']) && $_GET['success'] == 'rmd'){ echo 'active'; }else{ echo ''; } ?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="rmd()">RMD</a>
                      </li>
                      <li class="nav-item mr-1">
                        <a class="nav-link <?php  if(isset($_GET['success']) && $_GET['success'] == 'mia'){ echo 'active'; }else{ echo ''; } ?>" id="mia-tab" data-toggle="tab" href="#mia" role="tab" aria-controls="mia" aria-selected="false" onclick="mia()">MIA</a>
                      </li>
                      <li class="nav-item mr-1">
                        <a class="nav-link <?php  if(isset($_GET['success']) && $_GET['success'] == 'liberty'){ echo 'active'; }else{ echo ''; } ?>" id="liberty-tab" data-toggle="tab" href="#liberty" role="tab" aria-controls="liberty" aria-selected="false" onclick="liberty()">Liberty</a>
                      </li>
                      <li class="nav-item ml-auto">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search for...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                            <button type="button" class="btn btn-sm btn-primary" id="add_button" onclick="addSelector()">Add <i class="fa fa-plus"></i></button>
                          </span>
                        </div>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade <?php if(isset($_GET['success']) && $_GET['success'] == 'selector'){ echo 'active show'; }else if(empty($_GET)) { echo 'active show'; }else{ echo ''; } ?>" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
                                   
                        <div class="table-responsive">
                          <form method="POST" action="../sample.php">
                              <table class="table table-striped jambo_table bulk_action" id="example">
                                <thead>
                                  <tr class="headings">
                                  <!-- <div class="category-filter col-sm-12">
                                      <select id="categoryFilter" class="form-control">
                                        <option value="">All</option>
                                        <option value="SRC1">SRC1</option>
                                        <option value="SRC2">SRC2</option>
                                        <option value="SRC3">SRC3</option>
                                        <option value="SRC4">SRC4</option>
                                        <option value="SRC5">SRC5</option>
                                      </select>
                                    </div> -->
                                 
                                  <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                  </th>
                                    <th class="column-title">Target Name </th>
                                    <th class="column-title">Position</th>
                                    <th class="column-title">Unit </th>
                                    <th class="column-title">Selector </th>
                                    <th class="column-title">IMSI </th>
                                    <th class="column-title">Imei </th>
                                    <th class="column-title">Network</th>
                                    <th class="column-title">Data/Time </th>
                                    <th class="column-title">LAC/CID </th>
                                    <th class="column-title">Tower Location </th>
                                    <th class="column-title">Covered Areas </th>
                                    <th class="column-title">Remarks </th>
                                    <th class="column-title">Action </th>
                                    <th class="bulk-actions" colspan="16">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>

                                <?php
                                $a = 0;
                                  
                                  if($saved_locations->getKMS() == false){
                                      echo 'no data';
                                  }
                                  else{
                                      foreach($saved_locations->getKMS() as $row){
                                          echo '<tr id="selector_'.$row['id'].'">';
                                          echo '<td class="a-center "><input type="checkbox" class="flat" value="'.$row['dir'].'" name="check[]"></td>';
                                          echo ' <td>'.$row['name'].'</td>';
                                          echo ' <td>'.$row['position'].'</td>';
                                          echo ' <td>'.$row['unit'].'</td>';
                                          echo ' <td>'.$row['selector_name'].'</td>';
                                          echo ' <td>'.$row['imsi'].'</td>';
                                          echo ' <td>'.$row['imei'].'</td>';
                                          echo ' <td>'.$row['network'].'</td>';
                                          echo ' <td>'.$row['date'].' '.$row['time'].'</td>';
                                          echo ' <td>'.$row['lac_cid'].'</td>';
                                          echo ' <td>'.$row['tower_location'].'</td>';
                                          echo ' <td>'.$row['covered_areas'].'</td>';
                                          echo ' <td>'.$row['remarks'].'</td>';
                                          echo ' <td><button type="button" data-toggle="tooltip" data-placement="top" title="edit" onclick="editSelector('.$row['id'].')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button> <button type="button" onclick="delSelector('.$row['id'].')" class="btn btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>';
                                          echo '</tr>';
                                      }
                                      
                                  }
                                  ?>


                                  </tbody>
                            </table>
                            <button type="submit" name="submit_files" class="btn btn-sm btn-round btn-secondary"> Go </button>
                          </form>
                        </div>
                      </div>
                      <div class="tab-pane <?php  if(isset($_GET['success']) && $_GET['success'] == 'rmd'){ echo 'active'; }else{ echo ''; } ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                          <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" width="100%" id="tbl_rmd">
                              <thead>
                                <tr class="headings">
                                  <th class="column-title">NR </th>
                                  <th class="column-title">Date</th>
                                  <th class="column-title">Time </th>
                                  <th class="column-title">Frequency </th>
                                  <th class="column-title">Clarity </th>
                                  <th class="column-title">Direction </th>
                                  <th class="column-title">Subject/Convo </th>
                                  <th class="column-title">Callsign </th>
                                  <th class="column-title">Reciever </th>
                                  <th class="column-title">FC </th>
                                  <th class="column-title">SRC </th>
                                  <th class="column-title">Barangay </th>
                                  <th class="column-title">Municipality </th>
                                  <th class="column-title">Province </th>
                                  <th class="column-title">Grid Coordinate </th>
                                  <th class="column-title">Action </th>
                                  
                                  </th>
                                  <th class="bulk-actions" colspan="16">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                  </th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  $a = 0;
                                    
                                    if($saved_locations->getRMD() == false){
                                        echo 'no data';
                                    }
                                    else{
                                        foreach($saved_locations->getRMD() as $row){
                                          echo '<tr id="rmd_'.$row['id'].'">';
                                            echo ' <td>'.$a++.'</td>';
                                            echo ' <td>'.$row['date'].'</td>';
                                            echo ' <td>'.$row['time'].'</td>';
                                            echo ' <td>'.$row['frequency'].'</td>';
                                            echo ' <td>'.$row['clarity'].'</td>';
                                            echo ' <td>'.$row['direction'].'</td>';
                                            echo ' <td>'.$row['subject'].'</td>';
                                            echo ' <td>'.$row['callsign'].'</td>';
                                            echo ' <td>'.$row['reciever'].' '.$row['time'].'</td>';
                                            echo ' <td>'.$row['fc'].'</td>';
                                            echo ' <td>'.$row['src'].'</td>';
                                            echo ' <td>'.$row['barangay'].'</td>';
                                            echo ' <td>'.$row['municipality'].'</td>';
                                            echo ' <td>'.$row['province'].'</td>';
                                            echo ' <td>'.$row['grid_coordinate'].'</td>';
                                            echo ' <td><button type="button" data-toggle="tooltip" data-placement="top" title="edit" onclick="editRmd('.$row['id'].')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button> <button type="button" onclick="delRmd('.$row['id'].')" class="btn btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>';
                                            echo '</tr>';
                                        }
                                        
                                    }
                                  ?>
                              </tbody>
                            </table>
                        </div>
                      </div>
                      
                      <div class="tab-pane <?php  if(isset($_GET['success']) && $_GET['success'] == 'mia'){ echo 'active'; }else{ echo ''; } ?>" id="mia" role="tabpanel" aria-labelledby="mia-tab"><br>
                          <div class="table-responsive">
                          <form method="POST" action="../sample.php">
                            <table class="table table-striped jambo_table bulk_action" width="100%" id="tbl_mia">
                              <thead>
                                <tr class="headings">
                                  <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                  </th>
                                  <th class="column-title">Target Name</th>
                                  <th class="column-title">Position</th>
                                  <th class="column-title">Unit</th>
                                  <th class="column-title">Selector</th>
                                  <th class="column-title">Network</th>
                                  <th class="column-title">IMSI</th>
                                  <th class="column-title">IMEI</th>
                                  <th class="column-title">RSSI </th>
                                  <th class="column-title">Bearing/Direction </th>
                                  <th class="column-title">Probable Location </th>
                                  <th class="column-title">Data/Time </th>
                                  <th class="column-title">SMS </th>
                                  <th class="column-title">Call </th>
                                  <th class="column-title">Remarks </th>
                                  <th class="column-title">KMZ/KMS Files </th>
                                  <th class="column-title">Action </th>
                                  
                                  </th>
                                  <th class="bulk-actions" colspan="16">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                  </th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  $a = 0;
                                    
                                    if($saved_locations->getMia() == false){
                                        echo 'no data';
                                    }
                                    else{
                                        foreach($saved_locations->getMia() as $row){
                                            echo '<tr id="mia_'.$row['id'].'">';
                                            echo '<td class="a-center "><input type="checkbox" class="flat" value="'.$row['probable_location'].'" name="check[]"></td>';
                                            echo ' <td>'.$row['target_name'].'</td>';
                                            echo ' <td>'.$row['position'].'</td>';
                                            echo ' <td>'.$row['unit'].'</td>';
                                            echo ' <td>'.$row['selector'].'</td>';
                                            echo ' <td>'.$row['network'].'</td>';
                                            echo ' <td>'.$row['imei'].'</td>';
                                            echo ' <td>'.$row['imsi'].'</td>';
                                            echo ' <td>'.$row['rssi'].'</td>';
                                            echo ' <td>'.$row['bearing_direction'].'</td>';
                                            echo ' <td><a href='.$row['probable_location'].'>KMZ/KML</a></td>';
                                            echo ' <td>'.$row['date'].' '.$row['time'].'</td>';
                                            echo ' <td>'.$row['mia_sms'].'</td>';
                                            echo ' <td>'.$row['mia_call'].'</td>';
                                            echo ' <td>'.$row['remarks'].'</td>';
                                            echo ' <td><a href="'.$row['remarks'].'">download</a></td>';
                                            echo ' <td><button type="button" data-toggle="tooltip" data-placement="top" title="edit" onclick="editMia('.$row['id'].')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button> <button type="button" onclick="delMia('.$row['id'].')" class="btn btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>';
                                            echo '</tr>';
                                        }
                                        
                                    }
                                  ?>
                              </tbody>
                            </table>
                            <button type="submit" name="submit_files" class="btn btn-sm btn-round btn-secondary"> Go </button>
                          </form>
                        </div>
                      </div>

                      <div class="tab-pane <?php  if(isset($_GET['success']) && $_GET['success'] == 'liberty'){ echo 'active'; }else{ echo ''; } ?>" id="liberty" role="tabpanel" aria-labelledby="liberty-tab"><br>
                          <div class="table-responsive">
                          <form method="POST" action="../sample.php">
                            <table class="table table-striped jambo_table bulk_action" id="tbl_liberty" width="100%">
                              <thead>
                                <tr class="headings">
                                  <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                  </th>
                                  <th class="column-title">Target Name</th>
                                  <th class="column-title">Position</th>
                                  <th class="column-title">Unit</th>
                                  <th class="column-title">Number</th>
                                  <th class="column-title">IMSI</th>
                                  <th class="column-title">IMEI</th>
                                  <th class="column-title">Activity</th>
                                  <th class="column-title">Location Update, Call, & Text</th>
                                  <th class="column-title">Message</th>
                                  <th class="column-title">Network</th>
                                  <th class="column-title">CID</th>
                                  <th class="column-title">TA</th>
                                  <th class="column-title">Probable Location</th>
                                  <th class="column-title">KMZ/KMS File</th>
                                  <th class="column-title">Action</th>
                                  
                                  </th>
                                  <th class="bulk-actions" colspan="16">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                  </th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  $a = 0;
                                    
                                    if($saved_locations->getLiberty() == false){
                                        echo 'no data';
                                    }
                                    else{
                                        foreach($saved_locations->getLiberty() as $row){
                                            echo '<tr id="liberty_'.$row['id'].'">';
                                            echo '<td class="a-center "><input type="checkbox" class="flat" value="'.$row['file_dir'].'" name="check[]"></td>';
                                            echo ' <td>'.$row['name'].'</td>';
                                            echo ' <td>'.$row['position'].'</td>';
                                            echo ' <td>'.$row['unit'].'</td>';
                                            echo ' <td>'.$row['phone_number'].'</td>';
                                            echo ' <td>'.$row['liberty_imsi'].'</td>';
                                            echo ' <td>'.$row['liberty_imei'].'</td>';
                                            echo ' <td>'.$row['activity'].'</td>';
                                            echo ' <td>'.$row['location'].'</td>';
                                            echo ' <td>'.$row['message'].'</td>';
                                            echo ' <td>'.$row['network'].'</td>';
                                            echo ' <td>'.$row['cid'].'</td>';
                                            echo ' <td>'.$row['ta'].'</td>';
                                            echo ' <td>'.$row['model'].'</td>';
                                            echo ' <td><a href='.$row['file_dir'].'>download</a></td>';
                                            echo ' <td><button type="button" data-toggle="tooltip" data-placement="top" title="edit" onclick="editLiberty('.$row['id'].')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button> <button type="button" onclick="delLiberty('.$row['id'].')" class="btn btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>';
                                            echo '</tr>';
                                        }
                                        
                                    }
                                  ?>
                              </tbody>
                            </table>
                            <button type="submit" name="submit_files" class="btn btn-sm btn-round btn-secondary"> Go </button>
                          </form>
                        </div>
                      </div>



                    </div>
                  </div>
                </div>
              </div>

           
            </div>
          </div>
        </div>
        <!-- /page content -->


        <!-- modal for adding rmd -->
        <div class="modal fade add_rmd_modal" tabindex="-1" id="add_modal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add RMD</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                      <input type="hidden" name="role" value="admin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" name="time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="frequency">Frequency</label>
                            <input type="text" class="form-control" name="frequency">
                        </div>
                        <div class="form-group">
                            <label for="clarity">Clarity</label>
                            <input type="text" class="form-control" name="clarity">
                        </div>
                        <div class="form-group">
                            <label for="direction">Direction</label>
                            <input type="text" class="form-control" name="direction">
                        </div>
                        <p id="conpasscheck" style="color: red;"></p>
                        <div class="form-group">
                            <label for="subject">Subject/Convo</label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Callsign</label>
                            <input type="text" class="form-control" name="callsign">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Reciever</label>
                            <input type="text" class="form-control" name="reciever">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Fc</label>
                            <input type="text" class="form-control" name="fc">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">SRC</label>
                            <input type="text" class="form-control" name="src">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Region</label>
                            <select id="region" class="form-control"></select>
                            <input type="hidden" name="region_text" id="region-text">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Province</label>
                            <select id="province" class="form-control"></select>
                            <input type="hidden" name="province_text" id="province-text">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">City</label>
                            <select id="city" class="form-control"></select>
                            <input type="hidden" name="city_text" id="city-text">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Barangay</label>
                            <select id="barangay" class="form-control"></select>
                            <input type="hidden" name="barangay_text" id="barangay-text">
                        </div>
                        <div class="form-group">
                            <label for="grid">Grid Coordinates</label>
                            <input type="text" class="form-control" name="grid">
                        </div>
                        
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit_rmd_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      
        <!-- end rmd modal -->

          <!-- modal for editing rmd -->
          <div class="modal fade edit_rmd_modal" tabindex="-1" id="add_modal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit RMD</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                        <input type="hidden" name="rmd_id" id="rmd_id" value="">
                        <input type="hidden" name="role" value="admin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="edit_date">Date</label>
                                <input type="date" class="form-control" name="edit_date" id="edit_dates">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_time">Time</label>
                                <input type="time" class="form-control" name="edit_time" id="edit_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_frequency">Frequency</label>
                            <input type="text" class="form-control" name="edit_frequency" id="edit_frequency">
                        </div>
                        <div class="form-group">
                            <label for="edit_clarity">Clarity</label>
                            <input type="text" class="form-control" name="edit_clarity" id="edit_clarity">
                        </div>
                        <div class="form-group">
                            <label for="edit_direction">Direction</label>
                            <input type="text" class="form-control" name="edit_direction" id="edit_direction">
                        </div>
                        <p id="conpasscheck" style="color: red;"></p>
                        <div class="form-group">
                            <label for="edit_subject">Subject/Convo</label>
                            <input type="text" class="form-control" name="edit_subject" id="edit_subject">
                        </div>
                        <div class="form-group">
                            <label for="edit_callsign">Callsign</label>
                            <input type="text" class="form-control" name="edit_callsign" id="edit_callsign">
                        </div>
                        <div class="form-group">
                            <label for="edit_reciever">Reciever</label> 
                            <input type="text" class="form-control" name="edit_reciever" id="edit_reciever">
                        </div>
                        <div class="form-group">
                            <label for="edit__fc">Fc</label>
                            <input type="text" class="form-control" name="edit_fc" id="edit_fc">
                        </div>
                        <div class="form-group">
                            <label for="edit_src">SRC</label>
                            <input type="text" class="form-control" name="edit_src" id="edit_src">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Region</label>
                            <select id="rmd_region" class="form-control"></select>
                            <input type="hidden" name="region_text" id="edit-region-text">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Province</label>
                            <select id="rmd_province" class="form-control"></select>
                            <input type="hidden" name="province_text" id="edit-province-text">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">City</label>
                            <select id="rmd_city" class="form-control"></select>
                            <input type="hidden" name="city_text" id="edit-city-text">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Barangay</label>
                            <select id="rmd_barangay" class="form-control"></select>
                            <input type="hidden" name="barangay_text" id="edit-barangay-text">
                        </div>
                        <div class="form-group">
                            <label for="edit_grid">Grid Coordinates</label>
                            <input type="text" class="form-control" name="edit_grid" id="edit_grid">
                        </div>
                        
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit_edit_rmd_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      
        <!-- end rmd modal -->

        <!-- start selector modal -->

        <div class="modal fade add_selector_modal" tabindex="-1" id="add_modal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Selector</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                           <input type="hidden" name="role" value="admin">
                            <div class="form-group">
                                <label for="Name">Date</label>
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="form-group">
                                <label for="company">Company</label>
                                <select name="company" class="form-control">
                                  <option value="SRC1">SRC1</option>
                                  <option value="SRC2">SRC2</option>
                                  <option value="SRC3">SRC3</option>
                                  <option value="SRC4">SRC4</option>
                                  <option value="SRC5">SRC5</option>
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="name">Target Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" name="position">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select class="form-control" name="unit">
                              <option value="">Select Option</option>
                              <option value="Pltn">Pltn</option>
                              <option value="KLG">KLG</option>
                              <option value="SRC">SRC</option>
                            </select>
                        </div>
                        <p id="conpasscheck" style="color: red;"></p>
                        <div class="form-group">
                            <label for="selector_name">Selector</label>
                            <input type="text" class="form-control" name="selector_name">
                        </div>
                        <div class="form-group">
                            <label for="imsi">IMSI</label>
                            <input type="text" class="form-control" name="imsi">
                        </div>
                        <div class="form-group">
                            <label for="imei">Imei</label>
                            <input type="text" class="form-control" name="imei">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" name="time">
                        </div>
                        <div class="form-group">
                            <label for="network">Network</label>
                            <input type="text" class="form-control" name="network">
                        </div>
                        <div class="form-group">
                            <label for="lac_cid">LAC/CID</label>
                            <input type="text" class="form-control" name="lac_cid">
                        </div>
                        <div class="form-group">
                            <label for="tower_location">Tower Location</label>
                            <input type="text" class="form-control" name="tower_location">
                        </div>
                        <div class="form-group">
                            <label for="covered_areas">Covered Areas</label>
                            <input type="text" class="form-control" name="covered_areas">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control" name="remarks">
                        </div>
                        
                        <div class="form-group">
                            <label for="remarks">Upload KML/KMZ</label>
                            <input type="file" class="form-control" name="upload_kml">
                        </div>
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- end selector modal -->

        <!-- start edit selector modal -->

        <div class="modal fade edit_selector_modal" tabindex="-1" id="add_modal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Selector</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                        <input type="hidden" id="selector_edit_id" name="selector_id">
                        <input type="hidden" name="role" value="admin">
                            <div class="form-group">
                                <label for="Name">Date</label>
                                <input type="date" class="form-control" name="date" id="selector_date">
                            </div>
                            <div class="form-group">
                                <label for="company">Company</label>
                                <select name="company" class="form-control" id="selector_company">
                                  <option value="SRC1">SRC1</option>
                                  <option value="SRC2">SRC2</option>
                                  <option value="SRC3">SRC3</option>
                                  <option value="SRC4">SRC4</option>
                                  <option value="SRC5">SRC5</option>
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="name">Target Name</label>
                            <input type="text" class="form-control" name="name" id="selector_alias_name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" name="position" id="selector_position">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select type="text" class="form-control" name="unit" id="selector_unit">
                              <option value="">Select Option</option>
                              <option value="Pltn">Pltn</option>
                              <option value="KLG">KLG</option>
                              <option value="SRC">SRC</option>
                            </select>
                        </div>
                        <p id="conpasscheck" style="color: red;"></p>
                        <div class="form-group">
                            <label for="selector_name">Selector</label>
                            <input type="text" class="form-control" name="selector_name" id="selector_name">
                        </div>
                        <div class="form-group">
                            <label for="imsi">IMSI</label>
                            <input type="text" class="form-control" name="imsi" id="selector_imsi">
                        </div>
                        <div class="form-group">
                            <label for="imei">Imei</label>
                            <input type="text" class="form-control" name="imei" id="selector_imei">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" name="time" id="selector_time">
                        </div>
                        <div class="form-group">
                            <label for="network">Network</label>
                            <input type="text" class="form-control" name="lac_cid" id="selector_network">
                        </div>
                        <div class="form-group">
                            <label for="lac_cid">LAC/CID</label>
                            <input type="text" class="form-control" name="lac_cid" id="selector_lac_cid">
                        </div>
                        <div class="form-group">
                            <label for="tower_location">Tower Location</label>
                            <input type="text" class="form-control" name="tower_location" id="selector_tower_location">
                        </div>
                        <div class="form-group">
                            <label for="covered_areas">Covered Areas</label>
                            <input type="text" class="form-control" name="covered_areas" id="selector_covered_area">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control" name="remarks" id="selector_remarks">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Upload KML/KMZ</label>
                            <input type="file" class="form-control" name="upload_kml">
                        </div>
                        
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="edit_selector_submit_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- end selector modal -->

         <!-- start mia modal -->

         <div class="modal fade add_mia" tabindex="-1" id="add_mia" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add MIA</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                      <input type="hidden" name="role" value="admin">
                        <div class="form-group">
                            <label for="target_name">Target Name</label>
                            <input type="text" class="form-control" name="target_name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" name="position">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit">
                        </div>
                        <div class="form-group">
                            <label for="network">Network</label>
                            <select class="form-control" name="network">
                                <option value="smart">Smart</option>
                                <option value="globe">Globe</option>
                                <option value="dito">Dito</option>
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="selector">Selector</label>
                            <input type="text" class="form-control" name="selector">
                        </div>
                        <div class="form-group">
                            <label for="imei">IMEI</label>
                            <input type="text" class="form-control" name="imei">
                        </div>
                        <div class="form-group">
                            <label for="imsi">IMSI</label>
                            <input type="text" class="form-control" name="imsi">
                        </div>
                        <div class="form-group">
                            <label for="rssi">RSSI</label>
                            <input type="text" class="form-control" name="rssi">
                        </div>
                        <div class="form-group">
                            <label for="bearing_direction">Bearing/Direction</label>
                            <input type="text" class="form-control" name="bearing_direction">
                        </div>
                        <div class="form-group">
                            <label for="probable_location">Probable Location</label>
                            <input type="file" class="form-control" name="probable_location">
                        </div>
                        <div class="form-group">
                            <label for="call">Call</label>
                            <input type="text" class="form-control" name="call">
                        </div>
                        <div class="form-group">
                            <label for="sms">SMS</label>
                            <input type="text" class="form-control" name="sms">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control" name="remarks">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" name="time">
                        </div>
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="mia_submit_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- end mia modal -->

        <!-- start edit mia modal -->

        <div class="modal fade edit_mia" tabindex="-1" id="add_mia" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit MIA</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                      <input type="hidden" name="role" value="admin">
                        <input type="hidden" name="mia_id" id="mia_id">

                        <div class="form-group">
                            <label for="target_name">Target Name</label>
                            <input type="text" class="form-control" name="target_name" id="mia-target_name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" name="position" id="mia-position">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit" id="mia-unit">
                        </div>
                        <div class="form-group">
                            <label for="network">Network</label>
                            <select class="form-control" name="network">
                                <option value="smart">Smart</option>
                                <option value="globe">Globe</option>
                                <option value="dito">Dito</option>
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="selector">Selector</label>
                            <input type="text" class="form-control" name="selector" id="mia-selector">
                        </div>
                        <div class="form-group">
                            <label for="imei">IMEI</label>
                            <input type="text" class="form-control" name="imei" id="mia-imei">
                        </div>
                        <div class="form-group">
                            <label for="imsi">IMSI</label>
                            <input type="text" class="form-control" name="imsi" id="mia-imsi">
                        </div>
                        <div class="form-group">
                            <label for="rssi">RSSI</label>
                            <input type="text" class="form-control" name="rssi" id="mia-rssi">
                        </div>
                        <div class="form-group">
                            <label for="bearing_direction">Bearing/Direction</label>
                            <input type="text" class="form-control" name="bearing_direction" id="mia-bearing_direction">
                        </div>
                        <div class="form-group">
                            <label for="probable_location">Probable Location</label>
                            <input type="file" class="form-control" name="probable_location" id="mia-probable_location">
                        </div>
                        <div class="form-group">
                            <label for="call">Call</label>
                            <input type="text" class="form-control" name="call" id="mia-call">
                        </div>
                        <div class="form-group">
                            <label for="sms">SMS</label>
                            <input type="text" class="form-control" name="sms" id="mia-sms">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control" name="remarks" id="mia-remarks">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="date" id="mia-date">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" name="time" id="mia-time">
                        </div>
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="mia_edit_submit_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- end edit mia modal -->

      <!-- start liberty modal -->

      <div class="modal fade addliberty" tabindex="-1" id="addliberty" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Liberty</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                      <input type="hidden" name="role" value="admin">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" name="position">
                        </div>
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <input type="text" class="form-control" name="activity">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit">
                        </div>
                        <div class="form-group">
                            <label for="imsi">IMSI</label>
                            <input type="text" class="form-control" name="imsi">
                        </div>
                        <div class="form-group">
                            <label for="imei">IMEI</label>
                            <input type="text" class="form-control" name="imei">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="text" class="form-control" name="message">
                        </div>
                       <div class="form-group">
                            <label for="network">Network</label>
                            <select class="form-control" name="network">
                                <option value="smart">Smart</option>
                                <option value="globe">Globe</option>
                                <option value="dito">Dito</option>
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="liberty_cid">CID</label>
                            <input type="text" class="form-control" name="liberty_cid">
                        </div>
                        <div class="form-group">
                            <label for="liberty_ta">TA</label>
                            <input type="text" class="form-control" name="liberty_ta">
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" name="model">
                        </div>
                        <div class="form-group">
                            <label for="number">Phone Number</label>
                            <input type="number" class="form-control" name="number">
                        </div>
                        <div class="form-group">
                            <label for="upload">Upload KMZ/KML File</label>
                            <input type="file" class="form-control" name="upload">
                        </div>
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="liberty_submit_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- end liberty modal -->

        <!-- start edit liberty modal -->

      <div class="modal fade editliberty" tabindex="-1" id="addliberty" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Liberty</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                      <form method="POST" action="../includes/upload_kml.inc.php" enctype="multipart/form-data">
                          <input type="hidden" name="liberty_id" id="liberty_id">
                          <input type="hidden" name="role" value="admin">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="liberty-name">
                          </div>
                          <div class="form-group">
                              <label for="position">Position</label>
                              <input type="text" class="form-control" name="position" id="liberty-position">
                          </div>
                          <div class="form-group">
                              <label for="unit">Unit</label>
                              <input type="text" class="form-control" name="unit" id="liberty-unit">
                          </div>
                          <div class="form-group">
                              <label for="imsi">IMSI</label>
                              <input type="text" class="form-control" name="imsi" id="liberty-imsi">
                          </div>
                          <div class="form-group">
                              <label for="imei">IMEI</label>
                              <input type="text" class="form-control" name="imei" id="liberty-imei">
                          </div>
                          <div class="form-group">
                            <label for="activity">Activity</label>
                            <input type="text" class="form-control" name="activity" id="liberty-activity">
                        </div>
                          <div class="form-group">
                              <label for="location">Location</label>
                              <input type="text" class="form-control" name="location" id="liberty-location">
                          </div>
                          <div class="form-group">
                              <label for="message">Message</label>
                              <input type="text" class="form-control" name="message" id="liberty-message">
                          </div>
                          <div class="form-group">
                              <label for="network">Network</label>
                              <input type="text" class="form-control" name="network" id="liberty-network">
                          </div>
                          <div class="form-group">
                              <label for="liberty_cid">CID</label>
                              <input type="text" class="form-control" name="liberty_cid" id="liberty-cid">
                          </div>
                          <div class="form-group">
                              <label for="liberty_ta">TA</label>
                              <input type="text" class="form-control" name="liberty_ta" id="liberty-ta">
                          </div>
                          <div class="form-group">
                              <label for="model">Model</label>
                              <input type="text" class="form-control" name="model" id="liberty-model">
                          </div>
                          <div class="form-group">
                              <label for="number">Phone Number</label>
                              <input type="number" class="form-control" name="number" id="liberty-number">
                          </div>
                          <div class="form-group">
                              <label for="upload">Upload KMZ/KML File</label>
                              <input type="file" class="form-control" name="upload" >
                          </div>
                    
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="liberty_edit_submit_button" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- end edit liberty modal -->


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="../src/js/ph-address-selector.js"></script>
    <script>
       $("document").ready(function () {

        $('#tbl_rmd').DataTable();
        $('#tbl_mia').DataTable();
        $('#tbl_liberty').DataTable();
        $('#example').dataTable({
          "searching": true
        });

        var table = $('#example').DataTable();

        $("#example_length").append($("#categoryFilter"));
        $("#asd").append($("#categoryFilter"));

        var categoryIndex = 0;
        $("#example th").each(function (i) {
          if ($($(this)).html() == "Company") {
            categoryIndex = i; return false;
          }
        });

        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selectedItem = $('#categoryFilter').val()
          var category = data[categoryIndex];
          if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
          }
          return false;
        }
      );

      $("#categoryFilter").change(function (e) {
        table.draw();
      });

      table.draw();


       })
      

      function selector(){
        document.getElementById('add_button').setAttribute('onclick','addSelector()')
      }
      function rmd(){
       document.getElementById('add_button').setAttribute('onclick','addRmd()')
      }
      function mia(){
        document.getElementById('add_button').setAttribute('onclick','addMia()')
      }
      function liberty(){
        document.getElementById('add_button').setAttribute('onclick','addLiberty()')
      }
      function addSelector(){
        $(".add_selector_modal").modal("show");
      }
      function addRmd(){
    
        $(".add_rmd_modal").modal("show");
      }
      function addMia(){
        $(".add_mia").modal("show");
      }
      function addLiberty(){
        $(".addliberty").modal("show");
      }

      function editRmd(id){
        $.ajax({
            method: "get",
            dataType: "json",
            url: "../includes/upload_kml.inc.php?rmdid=" + id,
            success: function (response){
            $.each(response, function(index, data) {
                    $('#rmd_id').val(id)
                    $('#edit_dates').val(data.date)
                    $('#edit_time').val(data.time)
                    $('#edit_frequency').val(data.frequency)
                    $('#edit_clarity').val(data.clarity)
                    $('#edit_direction').val(data.direction)
                    $('#edit_subject').val(data.subject)
                    $('#edit_callsign').val(data.callsign)
                    $('#edit_reciever').val(data.reciever)
                    $('#edit_fc').val(data.fc)
                    $('#edit_src').val(data.src)
                    $('#edit_grid').val(data.grid_coordinate)
                    
                });
            }
        })
        // $('#prof_uid').val(prof_id);
        $('.edit_rmd_modal').modal(); 
      }

      function editSelector(id){
        $.ajax({
            method: "get",
            dataType: "json",
            url: "../includes/upload_kml.inc.php?selector_id=" + id,
            success: function (response){
            $.each(response, function(index, data) {
                    $('#selector_edit_id').val(id)
                    $('#selector_date').val(data.date)
                    $('#selector_company').val(data.company)
                    $('#selector_alias_name').val(data.name)
                    $('#selector_position').val(data.position)
                    $('#selector_unit').val(data.unit)
                    $('#selector_name').val(data.selector_name)
                    $('#selector_imsi').val(data.imsi)
                    $('#selector_imei').val(data.imei)
                    $('#selector_time').val(data.time)
                    $('#selector_lac_cid').val(data.lac_cid)
                    $('#selector_remarks').val(data.remarks)
                    $('#selector_network').val(data.network)
                    $('#selector_tower_location').val(data.tower_location)
                    $('#selector_covered_area').val(data.covered_areas)
                    
                });
            }
        })
        // $('#prof_uid').val(prof_id);
        $('.edit_selector_modal').modal(); 
      }

      function editMia(id){
        $.ajax({
            method: "get",
            dataType: "json",
            url: "../includes/upload_kml.inc.php?mia_id=" + id,
            success: function (response){
            $.each(response, function(index, data) {
                    $('#mia_id').val(id)
                    $('#mia-target_name').val(data.target_name)
                    $('#mia-position').val(data.position)
                    $('#mia-unit').val(data.unit)
                    $('#mia-network').val(data.network)
                    $('#mia-selector').val(data.selector)
                    $('#mia-imei').val(data.imei)
                    $('#mia-imsi').val(data.imsi)
                    $('#mia-rssi').val(data.rssi)
                    $('#mia-bearing_direction').val(data.bearing_direction)
                    $('#mia-probable_location').val(data.probable_location)
                    $('#mia-call').val(data.mia_call)
                    $('#mia-sms').val(data.mia_sms)
                    $('#mia-remarks').val(data.remarks)
                    $('#mia-date').val(data.date)
                    $('#mia-time').val(data.time)
                 
                    
                });
            }
        })
        // $('#prof_uid').val(prof_id);
        $('.edit_mia').modal(); 
      }

      function editLiberty(id){
        $.ajax({
            method: "get",
            dataType: "json",
            url: "../includes/upload_kml.inc.php?liberty_id=" + id,
            success: function (response){
            $.each(response, function(index, data) {
                    $('#liberty_id').val(id)
                    $('#liberty-name').val(data.name)
                    $('#liberty-position').val(data.position)
                    $('#liberty-activity').val(data.activity)
                    $('#liberty-unit').val(data.unit)
                    $('#liberty-imsi').val(data.liberty_imsi)
                    $('#liberty-imei').val(data.liberty_imei)
                    $('#liberty-model').val(data.model)
                    $('#liberty-location').val(data.location)
                    $('#liberty-message').val(data.message)
                    $('#liberty-network').val(data.network)
                    $('#liberty-cid').val(data.cid)
                    $('#liberty-ta').val(data.ta)
                    $('#liberty-number').val(data.phone_number)


                    
                });
            }
        })
        // $('#prof_uid').val(prof_id);
        $('.editliberty').modal(); 
      }


      function delSelector(id){
        var confirmation = confirm("are you sure you want to remove the item?");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/upload_kml.inc.php?delete_selector=" + id,
                success: function (response){
                $("#selector_"+id).remove();
                }
            })
        }
      }

      function delRmd(id){
        var confirmation = confirm("are you sure you want to remove the item?");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/upload_kml.inc.php?delete_rmd=" + id,
                success: function (response){
                $("#rmd_"+id).remove();
                }
            })
        }
      }

      function delMia(id){
        var confirmation = confirm("are you sure you want to remove the item?");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/upload_kml.inc.php?delete_mia=" + id,
                success: function (response){
                $("#mia_"+id).remove();
                }
            })
        }
      }

      function delLiberty(id){
        var confirmation = confirm("are you sure you want to remove the item?");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/upload_kml.inc.php?delete_liberty=" + id,
                success: function (response){
                $("#liberty_"+id).remove();
                }
            })
        }
      }
      
    </script>
  </body>
</html>

<?php
 }
 else{
    header('location: ../loginssss.php');
 }
}
else{
  header('location: ../login.html');
}

?>