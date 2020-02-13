<div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-display2 icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Data Pengembalian
                        <div class="page-title-subheading">
                            <a href="<?=base_url()?>">Home</a> / Pengembalian
                        </div>
                    </div>
                </div> 
            </div>
        </div> 

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Tambah Pengembalian</h5>
                        <form class="" method="POST" action="<?=base_url()?>kembali/store">
                            <label for="pinjam" class="">Data Peminjaman</label>
                            <select name="pinjam" id="pinjam" class="form-control">
                                
                                <option value="0">Please select</option>
                                <?php 
                                
                                if(!empty($pinjam)){
                                    foreach($pinjam as $pinjam_){
                                ?>
                                <option value="<?=$pinjam_->id_pinjam?>"><?=$pinjam_->KodeBuku?> - <?=$pinjam_->Judul?>; Peminjam : <?=$pinjam_->Nama?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error("jumlahbuku"); ?><span>
                        
                            <button class="mt-1 btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php if($this->uri->segment(2) == "stored"){?>

        <div class="alert alert-success" role="alert">
            Pengembalian berhasil disimpan
        </div>
        <?php } ?>
                       
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table class="mb-0 table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>No Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>No Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
