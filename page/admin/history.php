<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/historybar.php';?>

<section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">History</li>
            </ol>
          </div>
          <div class="col-sm-6">
              <div class="row">
                    <div class="col-4">
                <label for="">Audited Date From:</label> <input type="date" id="auditedhistorydatefrom" class="form-control" value="<?=$server_month;?>" autocomplete=off>
                    </div>
                    <div class="col-4">
                <label for="">Audited Date To:</label>  <input type="date" id="auditedhistorydateto" class="form-control" value="<?=$server_date_only;?>" autocomplete=off> 
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
                <div class="col-4">
                  <label>Employee ID: </label>
                  <input type="text" name="empid" id="empidhistory" class="form-control">
                 </div>

                  <div class="col-4">
                    <label>Full Name: </label>
                    <input type="text" name="fname" id="fnamehistory" class="form-control">
                  </div>

                   <div class="col-4">
                    <label>Line No: </label>
                    <input type="text" name="linen" id="linenhistory" class="form-control">
                  </div>

              </div>
              <br>
              <div class="row">
                  <div class="col-4">
                    <label>Car Maker: </label>
                    <input type="text" name="carmaker" id="carmakerhistory" class="form-control">
                  </div>

                  <div class="col-4">
                    <label>Car Model: </label>
                    <input type="text" name="carmodel" id="carmodelhistory" class="form-control">
                  </div>

                  <div class="col-4">
                    <label>Position: </label>
                    <select id="positionhistory" class="form-control" autocomplete=off> 
                      <option value="">Select Position</option>
                        <option value="associate">Associate</option>
                        <option value="expert">Expert</option>
                        <option value="jr.staff">Jr. Staff</option>
                        <option value="staff">Staff</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="assistant manager">Assistant Manager</option>
                        <option value="manager">Manager</option>
                    </select>
                  </div>
              </div>
 
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_list_of_history_findings()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>



              <div class="row">
                  <div class="col-12">
                   
                      &nbsp;
                       <button class="btn btn-success " onclick="export_history_list('history_list_data')">Export</button>
                       &nbsp;
                       
                  </div>

                  <div class="col-3">
                      
                  </div>

              </div>


              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="history_list_data">
                 <thead>
            
                    <th style="text-align:center;">#</th>
                    <th style="text-align:center; display: none;">Audit Code:</th>
                    <th style="text-align:center;">Date Audited</th>
                    <th style="text-align:center;">Full Name</th>
                    <th style="text-align:center;">Employee ID</th>
                    <th style="text-align:center;">Position </th>
                    <th style="text-align:center;">Provider</th>
                    <th style="text-align:center;">Group</th>
                    <th style="text-align:center;">Car Maker</th>
                    <th style="text-align:center;">Car Model</th>
                    <th style="text-align:center;">Line No.</th>
                    <th style="text-align:center;">Process</th>
                    <th style="text-align:center;">Audit Findings</th>
                    <th style="text-align:center;">Audited By</th>
                    <th style="text-align:center;">Audit Category</th>
                    <th style="text-align:center;">Remarks</th> 
                    <th style="text-align:center;">Concerned Group</th>              
                    <th style="text-align:center;">AGENCY Status</th> 
                    <th style="text-align:center;">HR Status</th> 
                    <th style="text-align:center;">Updated By</th>
                    <th style="text-align:center">Date Edited</th>

                </thead>
                <tbody id="history_data" style="text-align:center;"></tbody>
                </table>
                <div class="row">
                  <div class="col-6">
                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="audit_data">
   
                    <div class="spinner" id="spinner" style="display:none;">
                        
                        <div class="loader float-sm-center"></div>    
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
<?php include 'plugins/script/history_script.php'; ?>