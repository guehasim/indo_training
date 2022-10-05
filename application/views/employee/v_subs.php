        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h2>Data Subsection</h2>
              </div>

            </div>

            <div class="clearfix"></div>
            <div>
              <?php echo $this->session->flashdata('msg'); ?>
            </div> 

            <div class="row">              
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambah-data"><i class="fa fa-plus"></i> Tambah</button>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            
                            <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Subsection</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $no = 1; foreach ($subs->result() as $ad): ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $ad->NamaSubs;?></td>
                          <td>
                            <button class="btn btn-info btn-sm"  data-toggle="modal" data-target="#edit-info-<?php echo $ad->ID_Subs;?>"><i class="fa fa-pencil"></i> Edit </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Subs;?>"><i class="fa fa-trash-o"></i> Delete </button>                                                      
                          </td>
                        </tr>

                        <!-- modal delete -->
                        <div class="modal fade" id="edit-info-<?php echo $ad->ID_Subs;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content edit-dialog-modal">
                              <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Subsection/update" method="post">    
                                <?php
                                  $this->load->helper("form");
                                ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Update Subsection</h4>                                  
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $ad->ID_Subs;?>">
                                  <div class="item form-group form-check">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Subsection <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                      <input type="text" name="nama" id="first-name" class="form-control" value="<?php echo $ad->NamaSubs;?>" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">SIMPAN</button>
                                  <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                                </div>
                              </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- end modal delete-->

                        <!-- modal delete -->
                        <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Subs;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content edit-dialog-modal">
                              <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Subsection/delete" method="post">    
                                <?php
                                  $this->load->helper("form");
                                ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Hapus Data Subsection</h4>                                  
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $ad->ID_Subs;?>">
                                  Apakah anda benar mau menghapus data "<?php echo $ad->NamaSubs;?>" ini?
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                  <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                                </div>
                              </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- end modal delete-->
                        
                    <?php endforeach ?>
                      </tbody>
                    </table>
					
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


<!-- modal delete -->
  <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content edit-dialog-modal">
        <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Subsection/simpan" method="post">    
          <?php
            $this->load->helper("form");
          ?>
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Tambah Subsection</h4>                                  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <br>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Subsection <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="text" name="nama" id="first-name" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">SIMPAN</button>
            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- end modal delete-->
        