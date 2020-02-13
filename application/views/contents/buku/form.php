
<div class="position-relative form-group">
    <label for="nobuku" class="">No Buku</label>
    <input name="nobuku" id="nobuku" placeholder="No Buku" type="text" class="form-control" value="<?=$nobuku?>" readonly>
    <span class="text-danger"><?php echo form_error("nobuku"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul" id="judul" placeholder="Judul Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Judul:''?>">
    <span class="text-danger"><?php echo form_error("judul"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="pengarang" class="">Pengarang</label>
    <input name="pengarang" id="pengarang" placeholder="Pengarang Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Pengarang:''?>">
    <span class="text-danger"><?php echo form_error("pengarang"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="ukuran" class="">Ukuran</label>
    <input name="ukuran" id="ukuran" placeholder="Ukuran Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Ukuran:''?>">
    <span class="text-danger"><?php echo form_error("ukuran"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="ddcno" class="">DDCNo</label>
    <input name="ddcno" id="ddcno" placeholder="DDCNo Buku" type="text" class="form-control"value="<?=!empty($data)?$data->DDCNo:''?>">
    <span class="text-danger" ><?php echo form_error("ddcno"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="kategori" class="">Kategori</label>
    <select name="kategori" id="kategori" class="form-control">
        
        <option value="0">Please select</option>
        <?php 
        
        if($kategori->num_rows() >0){
            foreach($kategori->result() as $d){
        ?>
        <option value="<?=$d->NoKategori?>"><?=$d->Deskripsi?></option>
        <?php
            }
        }
        ?>
    </select>
    <span class="text-danger"><?php echo form_error("kategori"); ?><span>
    <!-- <input name="kategori" id="kategori" placeholder="Kategori Buku" type="text" class="form-control"> -->
</div>
<div class="position-relative form-group">
    <label for="penerbit" class="">Penerbit</label>
    <input name="penerbit" id="penerbit" placeholder="Penerbit Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Penerbit:''?>">
    <span class="text-danger"><?php echo form_error("penerbit"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="isbn" class="">ISBN</label>
    <input name="isbn" id="isbn" placeholder="ISBN Buku" type="text" class="form-control" value="<?=!empty($data)?$data->ISBN:''?>">
    <span class="text-danger"><?php echo form_error("isbn"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="tahunterbit" class="">Tahun Terbit</label>
    <input name="tahunterbit" id="tahunterbit" placeholder="Tahun Terbit Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Tahunterbit:''?>">
    <span class="text-danger"><?php echo form_error("tahunterbit"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="jumlahhalaman" class="">Jumlah Halaman</label>
    <input name="jumlahhalaman" id="jumlahhalaman" placeholder="Jumlah Halaman Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Jumlahhalaman:''?>">
    <span class="text-danger"><?php echo form_error("jumlahhalaman"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="jumlahbuku" class="">Jumlah Buku</label>
    <input name="jumlahbuku" id="jumlahbuku" placeholder="Jumlah Buku Buku" type="text" class="form-control" value="<?=!empty($data)?$data->JumlahBuku:''?>">
    <span class="text-danger"><?php echo form_error("jumlahbuku"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="asal" class="">Asal</label>
    <input name="asal" id="asal" placeholder="Asal Buku" type="text" class="form-control" value="<?=!empty($data)?$data->Asal:''?>">
    <span class="text-danger"><?php echo form_error("asal"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="sinopsis" class="">Sinopsis</label>
    <textarea name="sinopsis" id="sinopsis" cols="10" rows="4" placeholder="Sinopsis Buku" class="form-control"><?=!empty($data)?$data->Sinopsis:''?></textarea>
    <span class="text-danger"><?php echo form_error("sinopsis"); ?><span>
</div>
<div class="position-relative form-group">
    <label for="sampul" class="">Sampul</label>
    <input name="sampul" id="sampul" type="file" class="form-control-file">
    <span class="text-danger"><?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');} ?><span>
</div>

<button class="mt-1 btn btn-primary">Submit</button>