<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/pending_countbar.php';?>

<section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Audit Findings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of Audit Findings</li>
            </ol>
          </div>
          <div class="col-sm-6">
              <div class="row">
                    <div class="col-4">
                <label for="">Audited Date From:</label> <input type="date" id="auditeddatefrom" class="form-control" value="<?=$server_month;?>" autocomplete=off>
                    </div>
                    <div class="col-4">
                <label for="">Audited Date To:</label>  <input type="date" id="auditeddateto" class="form-control" value="<?=$server_date_only;?>" autocomplete=off> 
                  </div>
                  <div class="col-4">
                <span style="visibility: hidden;">.</span>
                  <div class="input-group input-group-sm" style="width: 100px;">
                   <button class="btn btn-primary" id="searchReqBtn" onclick="load_count()">Search <i class="fas fa-search"></i></button> 
               
                </div>
              </div>
                  </div>
                  
          </div>

          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <div class="row">
                     <input type="hidden" name="server_date" id="server_date" value="<?=$server_date_only;?>">
                </h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <a href="" style="color:black;" data-toggle="modal" data-target="#sec1">    <div class="info-box">
                         <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                          <div class="info-box-content">
                            <span class="info-box-text"><b>Section 1</b></span>
                            <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec1"></label></label></label>  /  <label>Total: <label id="grand_total"></label></label> </span>
                          </div>
                          </div>
                        </a>
                    </div>

                     <div class="col-3">
                          <a href="" style="color:black;" data-toggle="modal" data-target="#sec2">    <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text"><b>Section 2</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec2"></label></label> / <label>Total: <label id="grand_total2"></label></label></span>
                              </div>
             
                               </div>
                          </a>
                    </div>

                     <div class="col-3">
                           <a href="" style="color:black;" data-toggle="modal" data-target="#sec3">   <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text"><b>Section 3</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec3"></label></label> / <label>Total: <label id="grand_total3"></label></label></span>
                              </div>

                              </div>
                            </a>
                    </div>

                     <div class="col-3">
                            <a href="" style="color:black;" data-toggle="modal" data-target="#sec4">  <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text"><b>Section 4</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec4"></label></label> / <label>Total: <label id="grand_total4"></label></label></span>
                              </div>
                              </div>
                            </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                          <a href="" style="color:black;" data-toggle="modal" data-target="#sec5">    <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                 <span class="info-box-text"><b>Section 5</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec5"></label></label></label>  /  <label>Total: <label id="grand_total5"></label></label> </span>
                              </div>
                              </div>
                            </a>
                    </div>

                     <div class="col-3">
                          <a href="" style="color:black;" data-toggle="modal" data-target="#sec6">    <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text"><b>Section 6</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec6"></label></label> / <label>Total: <label id="grand_total6"></label></label></span>
                              </div>
                              </div>
                            </a>
                    </div>

                     <div class="col-3">
                          <a href="" style="color:black;" data-toggle="modal" data-target="#sec7">    <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text"><b>Section 7</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec7"></label></label> / <label>Total: <label id="grand_total7"></label></label></span>
                              </div>
                              </div>
                            </a>
                    </div>

                     <div class="col-3">
                           <a href="" style="color:black;" data-toggle="modal" data-target="#sec8">   <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text"><b>Section 8</b></span>
                                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec8"></label></label> / <label>Total: <label id="grand_total8"></label></label></span>
                              </div>
                              </div>
                            </a>
                    </div>
                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>
</div>
</section>

<?php include 'plugins/footer.php';?>
<?php include 'plugins/script/pending_count_script.php'; ?>