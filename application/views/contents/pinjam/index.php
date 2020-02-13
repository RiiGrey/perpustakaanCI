    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-display2 icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Data Peminjaman
                        <div class="page-title-subheading">
                            <a href="<?=base_url()?>">Home</a> / Peminjaman
                        </div>
                    </div>
                </div> 
            </div>
        </div> 

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Tambah Peminjaman</h5>
                        <form class="" method="POST" action="<?=base_url()?>pinjam/store">

                        <div class="position-relative form-group row">
                            <div class="col-sm-6">
                                <label for="buku" class="">No Buku</label>
                                <select name="buku" id="buku" class="form-control">
                                    
                                    <option value="0">Please select</option>
                                    <?php 
                                    
                                    if(!empty($buku)){
                                        foreach($buku as $buku_){
                                    ?>
                                    <option value="<?=$buku_->NoBuku?>"><?=$buku_->NoBuku?> - <?=$buku_->Judul?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                            
                                <label for="anggota" class="">No Anggota</label>
                                <select name="anggota" id="anggota" class="form-control">
                                    
                                    <option value="0">Please select</option>
                                    <?php 
                                    
                                    if(!empty($anggota)){
                                        foreach($anggota as $anggota_){
                                    ?>
                                    <option value="<?=$anggota_->NoAnggota?>"><?=$anggota_->NoAnggota?> - <?=$anggota_->Nama?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span class="text-danger"><?php echo form_error("anggota"); ?><span>
                        </div>
                            <button class="mt-1 btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php if($this->uri->segment(2) == "stored"){?>

        <div class="alert alert-success" role="alert">
            Peminjaman berhasil disimpan
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
                                    <th>Harus Kembali</th>
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
    
