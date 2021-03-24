<script type="text/javascript">

    $(document).ready(function() {
        for(B=1; B<=1; B++){
            BarisBaru();
        }
        $('#BarisBaru').click(function(){
            BarisBaru();
        });

        $("#TabelTransaksi tbody").find('input[type=text],textarea,select').filter(':visible:first').focus();
    });

    // baris baru
    function BarisBaru()
    {
        var Nomor = $('#TabelTransaksi tbody tr').length + 1;
        var Baris = "<tr>";
            Baris += "<td>"+Nomor+"</td>";
            Baris += "<td>";
                Baris += "<input type='text' style='height :30px;' class='form-control' name='kd_barang[]' id='pencarian_kode' placeholder='Ketik Kode / Nama Menu'>";
                Baris += "<div id='hasil_pencarian'></div>";
            Baris += "</td>";
            Baris += "<td></td>";
            Baris += "<td>";
                Baris += "<input type='hidden' name='harga_satuan[]'>";
                Baris += "<span></span>";
            Baris += "</td>";
            Baris += "<td><input type='text' class='form-control' style='height:30px;' id='jumlah_beli' name='jumlah_beli[]' onkeypress='return isNumberKey(event)' disabled></td>";
            Baris += "<td>";
                Baris += "<input type='hidden' name='sub_total[]'>";
                Baris += "<span></span>";
            Baris += "</td>";
            Baris += "<td><button class='btn btn-default' style='height :25px; width :25px;'  id='HapusBaris'><i class='fa fa-times' style='color:red;'></i></button></td>";
            Baris += "</tr>";

        $('#TabelTransaksi tbody').append(Baris);

        $('#TabelTransaksi tbody tr').each(function(){
            $(this).find('td:nth-child(2) input').focus();
        });

        HitungTotalBayar();
    }

    function HitungTotalBayar()
    {
        var Total = 0;
        $('#TabelTransaksi tbody tr').each(function(){
            if($(this).find('td:nth-child(6) input').val() > 0)
            {
                var SubTotal = $(this).find('td:nth-child(6) input').val();
                Total = parseInt(Total) + parseInt(SubTotal);
            }
        });

        $('#TotalBayar').html(to_rupiah(Total));
        $('#TotalBayarHidden').val(Total);

        $('#UangCash').val('');
        $('#UangKembali').val('');
    }

    // hapus baris
    $(document).on('click', '#HapusBaris', function(e){
        e.preventDefault();
        $(this).parent().parent().remove();

        var Nomor = 1;
        $('#TabelTransaksi tbody tr').each(function(){
            $(this).find('td:nth-child(1)').html(Nomor);
            Nomor++;
        });

        HitungTotalBayar();
    });

    function AutoCompleteGue(Lebar, KataKunci, Indexnya)
    {
        $('div#hasil_pencarian').hide();
        var Lebar = Lebar + 25;

        var Registered = '';
        $('#TabelTransaksi tbody tr').each(function(){
            if(Indexnya !== $(this).index())
            {
                if($(this).find('td:nth-child(2) input').val() !== '')
                {
                    Registered += $(this).find('td:nth-child(2) input').val() + ',';
                }
            } 
        });

        if(Registered !== ''){
            Registered = Registered.replace(/,\s*$/,"");
        }

        $.ajax({
            url: "<?= base_url('transaksi/kode_barange'); ?>",
            type: "POST",
            cache: false,
            data:'keyword=' + KataKunci + '&registered=' + Registered,
            dataType:'json',
            success: function(json){
                if(json.status == 1)
                {
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').css({ 'width' : Lebar+'px' });
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').show('fast');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').html(json.datanya);
                }
                if(json.status == 0)
                {
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').prop('disabled', true).val('');
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(0);
                    $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html('');
                }
            }
        });

        HitungTotalBayar();
    }

    $(document).on('keyup', '#pencarian_kode', function(e){
        if($(this).val() !== '')
        {
            var charCode = e.which || e.keyCode;
            if(charCode == 40)
            {
                if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
                {
                    var Selanjutnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').next();
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');

                    Selanjutnya.addClass('autocomplete_active');
                }
                else
                {
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                }
            } 
            else if(charCode == 38)
            {
                if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
                {
                    var Sebelumnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').prev();
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
                
                    Sebelumnya.addClass('autocomplete_active');
                }
                else
                {
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
                }
            }
            else if(charCode == 13)
            {
                var Field = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)');
                var Kodenya = Field.find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
                var Barangnya = Field.find('div#hasil_pencarian li.autocomplete_active span#barangnya').html();
                var Harganya = Field.find('div#hasil_pencarian li.autocomplete_active span#harganya').html();
                
                Field.find('div#hasil_pencarian').hide();
                Field.find('input').val(Kodenya);

                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(3)').html(Barangnya);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4) input').val(Harganya);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4) span').html(to_rupiah(Harganya));
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').removeAttr('disabled').val(1);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) input').val(Harganya);
                $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) span').html(to_rupiah(Harganya));
                
                var IndexIni = $(this).parent().parent().index() + 1;
                var TotalIndex = $('#TabelTransaksi tbody tr').length;
                if(IndexIni == TotalIndex){
                    BarisBaru();

                    $('html, body').animate({ scrollTop: $(document).height() }, 0);
                }
                else {
                    $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').focus();
                }
            }
            else 
            {
                AutoCompleteGue($(this).width(), $(this).val(), $(this).parent().parent().index());
            }
        }
        else
        {
            $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian').hide();
        }

        HitungTotalBayar();
    });

    $(document).on('click', '#daftar-autocomplete li', function(){
        $(this).parent().parent().parent().find('input').val($(this).find('span#kodenya').html());
        
        var Indexnya = $(this).parent().parent().parent().parent().index();
        var NamaBarang = $(this).find('span#barangnya').html();
        var Harganya = $(this).find('span#harganya').html();

        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').hide();
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html(NamaBarang);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val(Harganya);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html(to_rupiah(Harganya));
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').removeAttr('disabled').val(1);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(Harganya);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(to_rupiah(Harganya));

        var IndexIni = Indexnya + 1;
        var TotalIndex = $('#TabelTransaksi tbody tr').length;
        if(IndexIni == TotalIndex){
            BarisBaru();
            $('html, body').animate({ scrollTop: $(document).height() }, 0);
        }
        else {
            $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').focus();
        }

        HitungTotalBayar();
    });

    $(document).on('keyup', '#jumlah_beli', function(){
        var Indexnya = $(this).parent().parent().index();
        var Harga = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val();
        var JumlahBeli = $(this).val();
        var KodeBarang = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2) input').val();
                   
        var SubTotal = parseInt(Harga) * parseInt(JumlahBeli);
        if(SubTotal > 0){
            var SubTotalVal = SubTotal;
            SubTotal = to_rupiah(SubTotal);
        } else {
            SubTotal = '';
            var SubTotalVal = 0;
        }

        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(SubTotalVal);
        $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(SubTotal);
        HitungTotalBayar();
    });

    $(document).on('keydown', '#jumlah_beli', function(e){
        var charCode = e.which || e.keyCode;
        if(charCode == 9){
            var Indexnya = $(this).parent().parent().index() + 1;
            var TotalIndex = $('#TabelTransaksi tbody tr').length;
            if(Indexnya == TotalIndex){
                BarisBaru();
                return false;
            }
        }

        HitungTotalBayar();
    });

    $(document).on('keyup', '#UangCash', function(){
        HitungTotalKembalian();
    });
    function HitungTotalKembalian()
    {
        var Cash = $('#UangCash').val();
        var TotalBayar = $('#TotalBayarHidden').val();

        if(parseInt(Cash) >= parseInt(TotalBayar)){
            var Selisih = parseInt(Cash) - parseInt(TotalBayar);
            $('#UangKembali').val(to_rupiah(Selisih));
        } else {
            $('#UangKembali').val('');
        }
    }

    function to_rupiah(angka){
        var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2    = '';
        for(var i = 0; i < rev.length; i++){
            rev2  += rev[i];
            if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                rev2 += '.';
            }
        }
        return 'Rp. ' + rev2.split('').reverse().join('');
    }

    $(document).on('keydown', 'body', function(e){
        var charCode = ( e.which ) ? e.which : event.keyCode;

        if(charCode == 118) //F7
        {
            BarisBaru();
            return false;
        }

        if(charCode == 119) //F8
        {
            $('#UangCash').focus();
            return false;
        }

        if(charCode == 120) //F9
        {
            CetakStruk();
            return false;
        }
        if(charCode == 121) //F10
        {
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-sm');
            $('#ModalHeader').html('Konfirmasi');
            $('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
            $('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanTransaksi'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
            $('#ModalGue').modal('show');

            setTimeout(function(){ 
                $('button#SimpanTransaksi').focus();
            }, 500);

            return false;
        }
    });

    $(document).on('click', 'button#SimpanTransaksi', function(){
    SimpanTransaksi();
    });

    $(document).on('click', 'button#CetakStruk', function(){
        CetakStruk();
    });
    function CetakStruk()
    {
        if($('#TotalBayarHidden').val() > 0)
        { 
            if($('#UangCash').val() !== '')
            {
                var FormData = "kd_transaksi="+encodeURI($('#kd_transaksi').val());
                FormData += "&tanggal="+encodeURI($('#tanggal').val());
                FormData += "&nomeja="+encodeURI($('#nomeja').val());
                FormData += "&" + $('#TabelTransaksi tbody input').serialize();
                FormData += "&cash="+$('#UangCash').val();
                FormData += "&catatan="+encodeURI($('#catatan').val());
                FormData += "&grand_total="+$('#TotalBayarHidden').val();

                window.open("<?= base_url('transaksi/transaksi_cetak/?'); ?>" + FormData,'_blank');
            }
            else
            {
                $('.modal-dialog').removeClass('modal-lg');
                $('.modal-dialog').addClass('modal-sm');
                $('#ModalHeader').html('Oops !');
                $('#ModalContent').html('Harap masukan Total Bayar');
                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
                $('#ModalGue').modal('show');
                $("#ModalGue").css("z-index", "1500");
            }
        }
        else
        {
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-sm');
            $('#ModalHeader').html('Oops !');
            $('#ModalContent').html('Harap pilih barang terlebih dahulu');
            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
            $('#ModalGue').modal('show');
            $("#ModalGue").css("z-index", "1500");

        }
    }
    $(document).on('click', '#Simpann', function(){
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-sm');
        $('#ModalHeader').html('Konfirmasi');
        $('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
        $('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanTransaksi'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
        $('#ModalGue').modal('show');

        setTimeout(function(){ 
            $('button#SimpanTransaksi').focus();
        }, 500);
    });
    function SimpanTransaksi()
    {
        var FormData = "kd_transaksi="+encodeURI($('#kd_transaksi').val());
        FormData += "&tanggal="+encodeURI($('#tanggal').val());
        FormData += "&nomeja="+encodeURI($('#nomeja').val());
        FormData += "&" + $('#TabelTransaksi tbody input').serialize();
        FormData += "&cash="+$('#UangCash').val();
        FormData += "&catatan="+encodeURI($('#catatan').val());
        FormData += "&grand_total="+$('#TotalBayarHidden').val();

        $.ajax({
            url: "<?= base_url('transaksi/simpan_transaksi'); ?>",
            type: "POST",
            cache: false,
            data: FormData,
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    alert(data.pesan);
                    window.location.href="<?= base_url('transaksi/index'); ?>";
                }
                else 
                {
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('#ModalHeader').html('Oops !');
                    $('#ModalContent').html(data.pesan);
                    $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
                    $('#ModalGue').modal('show');
                }   
            }
        });
    }

</script>

<div class="modal" id="ModalGue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times-circle'></i></button>
                        <h4 class="modal-title" id="ModalHeader"></h4>
                    </div>
                    <div class="modal-body" id="ModalContent"></div>
                    <div class="modal-footer" id="ModalFooter"></div>
                </div>
            </div>
        </div>
        
        <script>
              var checkeventcount = 1,prevTarget;
    $('.modal').on('show.bs.modal', function (e) {
        if(typeof prevTarget == 'undefined' || (checkeventcount==1 && e.target!=prevTarget))
        {  
          prevTarget = e.target;
          checkeventcount++;
          e.preventDefault();
          $(e.target).appendTo('body').modal('show');
        }
        else if(e.target==prevTarget && checkeventcount==2)
        {
          checkeventcount--;
        }
     });
        // $('#ModalGue').appendTo("body").modal('show');
        $('#ModalGue').on('hide.bs.modal', function () {
           setTimeout(function(){ 
                $('#ModalHeader, #ModalContent, #ModalFooter').html('');
           }, 500);
        });
        </script>
