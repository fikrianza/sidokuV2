                
                  <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title"><b>Folders</b></h3>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <?php //if($_SESSION['level']=='1'){ ?>
                              <li id="sent"><a href="<?php echo base_url('admin/surat/disposisi') ?>"><i class="fa fa-inbox"></i> Terkirim </a></li>                             
                            <?php //} ?>
                            <?php if($_SESSION['level']=='2' || $_SESSION['level']=='3' || $_SESSION['level']=='4' || $_SESSION['level']=='5'){ ?>
                              <li id="inbox">
                                <a href="<?php echo base_url('admin/surat/disposisi_inbox'); ?>"><i class="fa fa-envelope-o"></i> Pesan Masuk
                                <?php foreach($list_not_read as $x){ ?>
                                  <span class="label label-primary pull-right"><?php echo $x->c ?></span></a></li>
                                 <?php  } ?>
                                </a>     
                              </li>          
                            <?php } ?>
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  