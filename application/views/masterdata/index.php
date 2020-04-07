<div class="bradcam_area breadcam_bg overlay">
        <h3>Data Menu D'jenius Cafe</h3>
</div>
    <!-- <div class="best_burgers_area"> -->
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section_title text-center mb-30">
                            <h2>Daftar Menu Cafe</h2>
                            <button class="btn btn-success" onclick="add_menu()"><i class="glyphicon glyphicon-plus"></i>Tambah Menu Baru</button>
                             <button class="btn btn-default" onclick="reload_table_menu()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="offset-2 col-lg-10 col-md-10">
                        <div class="table-responsive">
                            <table id="table_menu" class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr bgcolor="brown" align="center">
                                        <th style="width: 30px;">No.</th>
                                        <th>Nama Menu</th>
                                        <th>Harga Jual</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th style="width:150px;">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
