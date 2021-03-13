<div class="bradcam_area breadcam_bg overlay">
    <h3>Data Kategori</h3>
</div>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <div class="section_title text-center mb-30">
                    <button class="btn btn-success" onclick="add_kategori()"><i class="glyphicon glyphicon-plus"></i> Tambah Kategori Baru</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="offset-1 col-lg-8 col-md-8">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr bgcolor="aqua" align="center">
                                <th style="width: 30px;">No.</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>