<script type="text/javascript">
        function loadTraining()
        {
            var tiket = $("#topik_pilih").val();
            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>Log/pilih_trainer",
                data:"id=" + tiket,
                success: function(html)
                { 
                   $("#tampil_trainer").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>Log/pilih_lokasi",
                data:"id=" + tiket,
                success: function(html)
                { 
                   $("#tampil_lokasi").html(html);
                }
            }); 
        }

        function loadIdentitas() 
        {
          var nik = $("#nik_pilih").val();

          $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>Log/pilih_id",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_id").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>Log/pilih_nama",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_nama").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>Log/pilih_dept",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_dept").html(html);
                }
            });
        }
    </script>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h2>Log Pelatihan</h2>
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
                      <form method="post" action="<?php echo base_url(); ?>Log/laporan">
                        <div class="col-sm-2 col-sm-2">
                          <?php
                            if(isset($_POST['period_awal'])){
                              if ($_POST['period_awal'] == NULL) {
                                $oke_awal = "";
                              }else{
                                $oke_awal = $_POST['period_awal'];
                              }
                            }else{
                              $oke_awal = "";
                            }
                              
                          ?>
                          <input id="birthday" name="period_awal" value="<?php echo $oke_awal;?>" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" placeholder="Tanggal Awal" required>
                          </div>

                          <div class="col-sm-2 col-sm-2">
                          <?php
                            if(isset($_POST['period_akhir'])){
                              if ($_POST['period_akhir'] == NULL) {
                                $oke_akhir = "";
                              }else{
                                $oke_akhir = $_POST['period_akhir'];
                              }
                            }else{
                              $oke_akhir = "";
                            }
                              
                          ?>
                          <input id="birthday" name="period_akhir" value="<?php echo $oke_akhir;?>" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" placeholder="Tanggal Akhir" required>
                           <script>
                              function timeFunctionLong(input) {
                                setTimeout(function() {
                                  input.type = 'text';
                                }, 60000);
                              }
                            </script>
                          </div>


                          <div class="col-md-2 col-sm-2 ">
                            <select class="form-control" name="dept">
                              <option value="0">-Departement-</option>
                              <?php foreach ($dept->result() as $ad): ?>
                                <option value="<?php echo $ad->ID_Dept ?>"><?php echo $ad->NamaDept;?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="d-inline-flex align-items-center btn btn-info py-0">
                              <i class="fa fa-search"></i>
                              <input type="submit" name="submitdata" class="btn btn-info" value="Search" style="padding-bottom: 2px;" />
                            </div>

                            <div class="d-inline-flex align-items-center btn btn-warning py-0">
                              <i class="fa fa-arrow-circle-left" style="color:#FFFFFF;"></i>
                              <input type="submit" name="submitdata" class="btn btn-warning btn-xs" style="color:#FFFFFF;padding-bottom: 2px;" value="Reset"/>
                            </div>

                            <div class="d-inline-flex align-items-center btn btn-dark py-0">
                              <i class="fa fa-print"></i>
                              <input type="submit" name="submitdata" class="btn btn-dark btn-xs button-solid" formtarget="_blank" value="Print" style="padding-bottom: 2px;" />
                            </div>

                            <div class="d-inline-flex align-items-center btn btn-success py-0">
                              <i class="fa fa-print"></i>
                              <input type="submit" name="submitdata" class="btn btn-success btn-xs" value="Excel" style="padding-bottom: 2px;" />
                            </div>
                          </div>
                          <div>
                          </div>
                        </form>  
                    <div class="col-sm-12">                            
                    <div class="card-box table-responsive">
                    <table id="datatable-keytable" class="table table-striped table-bordered" width="150%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>ID Number</th>
                          <th>Nama</th>
                          <th>Department</th>
                          <th>Tgl Pelatihan</th>
                          <th>Topik Pelatihan</th>
                          <th>Trainer</th>
                          <th>Lokasi</th>
                          <th>Pelapor</th>
                          <th>Pemeriksa</th>
                          <th>Tgl</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $no = 1; foreach ($log->result() as $ad): ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $ad->NikKaryawan;?></td>
                          <td><?php echo $ad->NamaKaryawan;?></td>
                          <td><?php echo $ad->NamaDept;?></td>
                          <td><?php echo date('d M y',strtotime($ad->TglPelatihan));?></td>
                          <td><?php echo $ad->NamaMateri;?></td>
                          <td><?php echo $ad->Trainer;?></td>
                          <td><?php echo $ad->Lokasi;?></td>
                          <td><?php echo $ad->Pelapor;?></td>
                          <td><?php echo $ad->Pemeriksa;?></td>
                          <td><?php echo date('d M y',strtotime($ad->TglNow));?></td>
                          <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-info-<?php echo $ad->ID_TrainingRecord;?>"><i class="fa fa-pencil"></i> Edit </button> <br />
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_TrainingRecord;?>"><i class="fa fa-trash-o"></i> Delete </button>                                                      
                          </td>
                        </tr>

                        <!-- modal delete -->
                        <div class="modal fade" id="edit-info-<?php echo $ad->ID_TrainingRecord;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content edit-dialog-modal">
                              <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Log/update" method="post">  

                                <?php
                                  $this->load->helper("form");
                                ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Update Pelatihan</h4>                                  
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <br>
                                
                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ID Number <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input type="number" name="nik" onkeypress="loadIdentitas()" id="nik_pilih" value='<?php echo $ad->NikKaryawan;?>' autocomplete="off" class="form-control" required>
                                  </div>
                                </div>
                                <input type="text" name="id" value="<?php echo $ad->ID_TrainingRecord;?>" hidden>

                                <div id="tampil_id"><input type="text" name="id_karyawan" value="<?php echo $ad->ID_Karyawan;?>" hidden></div>
                                
                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <div id="tampil_nama"><input type="text" class="form-control" value="<?php echo $ad->NamaKaryawan;?>" disabled></div>              
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Department <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <div id="tampil_dept"><input type="text" class="form-control" value="<?php echo $ad->NamaDept;?>" disabled></div>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Pelatihan <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input id="birthday" name="Tgl" value="<?php echo date('d/m/Y',strtotime($ad->TglPelatihan));?>" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
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
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Topik Pelatihan <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <select class="form-control" name="id_detail" id="topik_pilih" onclick="loadTraining()">
                                      <?php foreach ($training->result() as $as): ?>
                                        <?php
                                        if ($ad->ID_DetailTraining == $as->ID_DetailTraining) {
                                            $tampil = "selected";
                                         } else{
                                            $tampil = "";
                                         }
                                         ?>
                                        <option value="<?php echo $as->ID_DetailTraining?>" <?php echo $tampil;?>><?php echo $as->NamaMateri;?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Trainer <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <div id="tampil_trainer"><input type="text" class="form-control" value="<?php echo $ad->Trainer;?>" disabled></div>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Lokasi <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <div id="tampil_lokasi"><input type="text" class="form-control" value="<?php echo $ad->Lokasi;?>" disabled></div>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pelapor <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="pelapor" class="form-control" value="<?php echo $ad->Pelapor;?>" required>
                                  </div>
                                </div>

                                <div class="item form-group form-check">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pemeriksa <span class="required">*</span>
                                  </label>
                                  <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="pemeriksa" class="form-control" value="<?php echo $ad->Pemeriksa;?>" required>
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
                        <div class="modal fade" id="hapus-info-<?php echo $ad->ID_TrainingRecord;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content edit-dialog-modal">
                              <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>Log/delete" method="post">    
                                <?php
                                  $this->load->helper("form");
                                ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Hapus Data Pelatihan</h4>                                  
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $ad->ID_TrainingRecord;?>">
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
        <form class="form-validate form-horizontal " action="<?php echo base_url(); ?>Log/simpan" method="post">    
          <?php
            $this->load->helper("form");
          ?>
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Tambah Pelatihan</h4>                                  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <br>
          
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ID Number <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="number" name="nik" onkeypress="loadIdentitas()" id="nik_pilih" autocomplete="off" class="form-control" required>
            </div>
          </div>

          <div id="tampil_id"></div>
          
          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <div id="tampil_nama"><input type="text" class="form-control" disabled></div>              
            </div>
          </div>

          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Department <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <div id="tampil_dept"><input type="text" class="form-control" disabled></div>
            </div>
          </div>

          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Pelatihan <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input id="birthday" name="Tgl" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Topik Pelatihan <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <select class="form-control" name="id_detail" id="topik_pilih" onclick="loadTraining()">
                <option></option>
                <?php foreach ($training->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_DetailTraining?>"><?php echo $ad->NamaMateri;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Trainer <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <div id="tampil_trainer"><input type="text" class="form-control" disabled></div>
            </div>
          </div>

          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Lokasi <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <div id="tampil_lokasi"><input type="text" class="form-control" disabled></div>
            </div>
          </div>

          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pelapor <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="text" name="pelapor" class="form-control" required>
            </div>
          </div>

          <div class="item form-group form-check">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pemeriksa <span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
              <input type="text" name="pemeriksa" class="form-control" required>
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