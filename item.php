<?php
include_once "layouts/header.php";
?>
      <!-- partial -->
      <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                     <!-- Form Modal Button -->
            <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b> Add item</b></a>
              </div>
              <!-- Search Button -->
              <div class="input-group col-md-4">
              <input type="text" class="form-control" name="" id="" placeholder="အမည်">
                <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div>
             

            <!-- large modal for Customer Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Customer Registration Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action="">
                    <div class="modal-body">
                    <h4>Add Items</h4>
                    <p >ငှားရမ်းသူ</p>
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">Items Name</label>
                                                <input type="text" name="" id="" class="form-control" placeholder="ပစ္စည်းအမျိုးအမည်">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">Item Type</label>
                                                <input type="text" name="" id="" class="form-control" placeholder="ပစ္စည်းအမျိုးအစား">
                                            </div>
                                        </div>   
                    </div>     
                                      
                                        
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" name="submit" class="btn btn-primary">Submit</button>
      </div>
                </form>
                </div>
                </div>
            </div>
</div>
<div class="container-fluid mt-3">
        <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Category Table</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="example" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>စဥ်</th>
                                                    <th>ပစ္စည်းအမည်</th>
                                                    <th>ပစ္စည်းအမျိုးအစား</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
      </div>
            </div>
      </div>
      <!-- main-panel ends -->

<?php 
include_once "layouts/footer.php";
?>
