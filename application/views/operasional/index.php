<div class="bradcam_area breadcam_bg overlay">
        <h3>Data Operasional Cafe</h3>      
</div>
        <div class="container"> 
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section_title text-center mb-10">
                            <h2>Daftar Operasional Cafe</h2>
                            <button class="btn btn-success fa fa-plus-square"><?php echo anchor('operasional/tambah_data','Tambah Data');?></button>
                            <button class="btn btn-default" onclick="reload_table_menu()"><i class="fa fa-refresh"></i> Reload</button>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table id="table_menu" class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr bgcolor="brown" align="center">
                                        <th style="width: 30px;">No.</th>
                                        <th>Nama Operasional</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th style="width:150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no= 1; ?>
                                <?php foreach($tb_operasional as $operasional) {?>
                                    <tr>
                                        <th><?=$no ?> </th>
                                        <th><?php echo $operasional->nama_operasional?></th>
                                        <th><?php echo $operasional->deskripsi?></th>
                                        <th><?php echo $operasional->jumlah?></th>
                                        <th><?php echo $operasional->tanggal?></th>
                                        <th><?php echo $operasional->tipe?></th>
                                        <th> 
                                            <button class="btn btn-primary"><?php echo anchor('operasional/edit_data/'.$operasional->kd_operasional,'Edit');?></button>
                                            <button class="btn btn-danger"><?php echo anchor('operasional/hapus/'.$operasional->kd_operasional,'Hapus');?></button>
                                        </th>
                                    </tr>   
                                    <?php $no++ ?> 
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                     </div>
                </div>
            </div>
        </div>

