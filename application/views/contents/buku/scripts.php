<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
 
$(document).ready(function() {
 

    //datatables
    $('#datatable').DataTable({ 
 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('buku/fetchBuku')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false,
        },
        ],
 
    });
    
    $('#datatable').on('click', 'tbody tr td .open-modal', function () {
        //clean modal
        $("#modalTitle").html('');
        $(".modal-body").html('');

        // console.log($(this).data("nobuku"));
        $.get("<?=base_url()?>/buku/fetchViewBuku/" + $(this).data("nobuku"), function(data, status){
            let jsondata = JSON.parse(data)['0'];
            console.log(jsondata);

            let modalTitle = jsondata.Judul;
            let ModalContent = `
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?=base_url()?>uploads/buku_sampul/${jsondata.Sampul}" alt="${modalTitle}" class="img-fluid">
                </div>
                <div class="col-sm-6">
                    <p class="text-justify">
                    Sinopsis : <br><span class="text-secondary">${jsondata.Sinopsis}</span><br>
                    Kategori: <strong>${jsondata.Kategori}</strong>
                    <hr>
                    No ISBN : <strong>${jsondata.ISBN}</strong><br>
                    Nama Pengarang : <strong>${jsondata.Pengarang}</strong><br>
                    Nama Penerbit : <strong>${jsondata.Penerbit}</strong><br>
                    Tahun Terbit : <strong>${jsondata.Tahun}</strong><br>
                    DDCNo: <strong>${jsondata.DDCNo}</strong><br>
                    Jumlah Halaman: <strong>${jsondata.Jumlahhalaman}</strong><br>
                    Ukuran: <strong>${jsondata.Ukuran}</strong><br>
                    Keterangan : <strong>${jsondata.Keterangan}</strong>
                    </p>
                </div>
            </div>
            `;

            $("#modalTitle").append(modalTitle);
            $(".modal-body").append(ModalContent);
        })
    });

 
});


</script>
