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
            "url": "<?php echo site_url('anggota/fetchAnggota')?>",
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

        $.get("<?=base_url()?>anggota/fetchViewAnggota/" + $(this).data("noanggota"), function(data, status){
            let jsondata = JSON.parse(data)['0'];
            // console.log(jsondata);

            let modalTitle = jsondata.Nama;
            let ModalContent = `
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?=base_url()?>uploads/foto/${jsondata.NamaFoto}" alt="${modalTitle}" class="img-fluid">
                </div>
                <div class="col-sm-6">
                    <p class="text-justify">
                    No Induk : <strong>${jsondata.NoInduk}</strong><br/>
                    Nama : <strong>${jsondata.Nama}</strong><br/>
                    Kelas : <strong>${jsondata.Klas}</strong><br/>
                    Kelompok : <strong>${jsondata.Kelompok}</strong><br/>
                    Tempat, Tanggal Lahir : <strong>${jsondata.TempatLahir}, ${jsondata.Tanggal}</strong><br/>
                    Jenis Kelamin : <strong>${jsondata.Kelamin}</strong><br/>
                    Alamat : <strong>${jsondata.Alamat}</strong><br/>
                    Tahun Masuk : <strong>${jsondata.Masuk}</strong><br/>
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