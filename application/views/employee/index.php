        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h2>Data Employee</h2>
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
                    <table id="datatable-keytable" class="table table-striped table-bordered" width="150%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>ID Number</th>
                          <th>Name</th>
                          <th>Department</th>
                          <th>Subsection</th>
                          <th>Position</th>
                          <th>Start Work</th>
                          <th>Education</th>
                          <th>Photo</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $no = 1; foreach ($karyawan->result() as $ad): ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $ad->NikKaryawan;?></td>
                          <td><?php echo $ad->NamaKaryawan;?></td>
                          <td><?php echo $ad->NamaDept;?></td>
                          <td><?php echo $ad->NamaSubs;?></td>
                          <td><?php echo $ad->NamaPosition;?></td>
                          <td><?php echo date('d M y',strtotime($ad->TglKerja));?></td>
                          <td><?php echo $ad->NamaEducation;?></td>
                          <td>
                            <?php if ($ad->ImageKaryawan != null): ?>
                              <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/<?php echo $ad->ImageKaryawan;?>" style="height: 50px; text-align:center; display: block;">
                            <?php else: ?>
                              <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/no-image.jpg" style="height: 50px; text-align:center; display: block;">
                            <?php endif ?>
                          </td>
                          <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-info-<?php echo $ad->ID_Karyawan;?>"><i class="fa fa-pencil"></i> Edit </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Karyawan;?>"><i class="fa fa-trash-o"></i> Delete </button>                                                      
                          </td>
                        </tr>

                        <!-- modal delete -->
                        <div class="modal fade" id="edit-info-<?php echo $ad->ID_Karyawan;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content edit-dialog-modal">
                              <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Karyawan/update" method="post" enctype="multipart/form-data">     
                                
                                <?php
                                  $this->load->helper("form");
                                ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Edit Employee</h4>                                  
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <br>

                                <input type="text" name="id" value="<?php echo $ad->ID_Karyawan;?>" hidden>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ID Number <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input type="number" name="nik" id="first-name" class="form-control" value="<?php echo $ad->NikKaryawan;?>" autocomplete="off" required>
                                  </div>
                                </div>


                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="nama" id="first-name" class="form-control" value="<?php echo $ad->NamaKaryawan;?>" autocomplete="off" required>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Department <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <select class="form-control" name="dept">
                                      <?php foreach ($dept->result() as $as): ?>
                                        <?php
                                        if ($ad->ID_Dept == $as->ID_Dept) {
                                            $tampil = "selected";
                                         } else{
                                            $tampil = "";
                                         }
                                         ?>
                                        <option value="<?php echo $as->ID_Dept;?>" <?php echo $tampil;?>><?php echo $as->NamaDept;?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Subsection <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <select class="form-control" name="subs">
                                      <?php foreach ($sub->result() as $as): ?>
                                        <?php
                                        if ($ad->ID_Subs == $as->ID_Subs) {
                                            $tampil = "selected";
                                         } else{
                                            $tampil = "";
                                         }
                                         ?>
                                        <option value="<?php echo $as->ID_Subs;?>" <?php echo $tampil;?>><?php echo $as->NamaSubs;?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Position <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <select class="form-control" name="position">
                                      <?php foreach ($pos->result() as $as): ?>
                                        <?php
                                        if ($ad->ID_Position == $as->ID_Position) {
                                            $tampil = "selected";
                                         } else{
                                            $tampil = "";
                                         }
                                         ?>
                                        <option value="<?php echo $as->ID_Position;?>" <?php echo $tampil;?>><?php echo $as->NamaPosition;?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Start Work <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input id="birthday" name="tgl" class="date-picker form-control" value="<?php echo date('d/m/Y',strtotime($ad->TglKerja)) ?>" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
                                     <script>
                                        function timeFunctionLong(input) {
                                          setTimeout(function() {
                                            input.type = 'text';
                                          }, 60000);
                                        }
                                      </script>
                                    </div>
                                </div>
                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Education <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <select class="form-control" name="edu">
                                      <?php foreach ($edu->result() as $as): ?>
                                        <?php
                                        if ($ad->ID_Education == $as->ID_Education) {
                                            $tampil = "selected";
                                         } else{
                                            $tampil = "";
                                         }
                                         ?>
                                        <option value="<?php echo $as->ID_Education;?>" <?php echo $tampil;?>><?php echo $as->NamaEducation;?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Foto <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <?php if ($ad->ImageKaryawan != null): ?>
                                      <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/<?php echo $ad->ImageKaryawan;?>" style="height: 70px; text-align:center; display: block;">
                                    <?php else: ?>
                                      <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/no-image.jpg" style="height: 70px; text-align:center; display: block;">
                                    <?php endif ?>
                                  </div>
                                </div>
                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input type="file" name="image" class="form-control">
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
                        <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Karyawan;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content edit-dialog-modal">
                              <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Karyawan/delete" method="post">    
                                <?php
                                  $this->load->helper("form");
                                ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Hapus Data Karyawan</h4>                                  
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $ad->ID_Karyawan;?>">
                                  Apakah anda benar mau menghapus data "<?php echo $ad->NamaKaryawan;?>" ini?
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

<!-- modal tambah -->
  <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content edit-dialog-modal">
        <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Karyawan/simpan" method="post" enctype="multipart/form-data">    
          <?php
            $this->load->helper("form");
          ?>
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Tambah Employee</h4>                                  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <br>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ID Number <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="number" name="nik" id="first-name" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="text" name="nama" id="first-name" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Department <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <select class="form-control" name="dept">
                <option></option>
                <?php foreach ($dept->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_Dept;?>"><?php echo $ad->NamaDept;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Subsection <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <select class="form-control" name="subs">
                <option></option>
                <?php foreach ($sub->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_Subs;?>"><?php echo $ad->NamaSubs;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Position <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <select class="form-control" name="position">
                <option></option>
                <?php foreach ($pos->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_Position;?>"><?php echo $ad->NamaPosition;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Start Work <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input id="birthday" name="tgl" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
               <script>
                  function timeFunctionLong(input) {
                    setTimeout(function() {
                      input.type = 'text';
                    }, 60000);
                  }
                </script>
              </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Education <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <select class="form-control" name="edu">
                <option></option>
                <?php foreach ($edu->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_Education;?>"><?php echo $ad->NamaEducation;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Foto <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="file" name="image" class="form-control">
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