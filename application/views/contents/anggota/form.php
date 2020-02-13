<div class="position-relative form-group">
    <label for="noanggota" class="">No Anggota</label>
    <input name="noanggota" id="noanggota" placeholder="No Anggota" type="text" class="form-control" value="<?=!empty($noanggota)?$noanggota:''?>" readonly>
    <span class="text-danger"><?php echo form_error("noanggota"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="nama" class="">Nama Lengkap</label>
    <input name="nama" id="nama" placeholder="Nama Lengkap Anggota" type="text" class="form-control" value="<?=!empty($data)?$data->Nama:''?>">
    <span class="text-danger"><?php echo form_error("nama"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="noinduk" class="">No Induk</label>
    <input name="noinduk" id="noinduk" placeholder="No Induk Anggota" type="text" class="form-control" value="<?=!empty($data)?$data->NoInduk:''?>">
    <span class="text-danger"><?php echo form_error("noinduk"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="klas" class="">Kelas</label>
    <input name="klas" id="klas" placeholder="Kelas Anggota" type="text" class="form-control" value="<?=!empty($data)?$data->Klas:''?>">
    <span class="text-danger"><?php echo form_error("klas"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="kelompok" class="">Kelompok</label>
    <select name="kelompok" id="kelompok" class="form-control">
        <option>Siswa</option>
        <option>Guru</option>
    </select>
    <span class="text-danger"><?php echo form_error("kelompok"); ?><span>
</div>

<div class="position-relative form-group row">
    <div class="col-sm-3">

        <label for="tempat" class="">Tempat, Tanggal lahir</label>
        <input name="tempat" id="tempat" placeholder="Tempat Anggota" type="text" class="form-control" value="<?=!empty($data)?$data->TempatLahir:''?>">
        <span class="text-danger"><?php echo form_error("tempat"); ?><span>
    </div>
    <div class="col-sm-3">

        <label for="tanggal" class="">-</label>
        
        <select name="tanggal" id="tanggal" class="form-control">
        <?php 
            foreach($tgllahir['tanggal'] as $tanggal){
        ?>
            <option value="<?=$tanggal?>" <?=$viewtgllahir[0]==$tanggal?'selected':''?>><?=$tanggal?></option>

        <?php

            }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error("tanggal"); ?><span>
    </div>
    <div class="col-sm-3">

        <label for="bulan" class="">-</label>
        <select name="bulan" id="bulan" class="form-control">
        <?php 
            foreach($tgllahir['bulan'] as $bulan){
        ?>
            <option value="<?=$bulan?>" <?=$viewtgllahir[1]==$bulan?'selected':''?>><?=$bulan?></option>

        <?php

            }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error("bulan"); ?><span>
    </div>
    <div class="col-sm-3">

        <label for="tahun" class="">-</label>
        <select name="tahun" id="tahun" class="form-control">
        <?php 
            foreach($tgllahir['tahun'] as $tahun){
        ?>
            <option value="<?=$tahun?>" <?=$viewtgllahir[2]==$tahun?'selected':''?>><?=$tahun?></option>

        <?php

            }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error("tahun"); ?><span>
    </div>
</div>

<div class="position-relative form-group">
    <label for="kelamin" class="">Kelamin</label>
    <fieldset class="position-relative form-group">
        <div class="position-relative form-check">
            <label class="form-check-label">
                <input name="kelamin" type="radio" class="form-check-input" <?=$data->Kelamin=='Laki-Laki'?'checked':''?> value="Laki-Laki"> Laki-Laki
            </label>
        </div>
        <div class="position-relative form-check">
            <label class="form-check-label">
                <input name="kelamin" type="radio" class="form-check-input" <?=$data->Kelamin=='Perempuan'?'checked':''?>> Perempuan
            </label>
        </div>
    </fieldset>
    <span class="text-danger"><?php echo form_error("kelamin"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="alamat" class="">Alamat</label>
    <textarea name="alamat" id="alamat" cols="10" rows="4" placeholder="Alamat anggota" class="form-control"><?=!empty($data)?$data->Alamat:''?></textarea>
    <span class="text-danger"><?php echo form_error("alamat"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="keterangan" class="">Keterangan</label>
    <textarea name="keterangan" id="keterangan" cols="10" rows="4" placeholder="Keterangan" class="form-control"><?=!empty($data)?$data->Keterangan:''?></textarea>
    <span class="text-danger"><?php echo form_error("keterangan"); ?><span>
</div>

<div class="position-relative form-group">
    <label for="foto" class="">Foto</label>
    <input name="foto" id="foto" type="file" class="form-control-file">
    <span class="text-danger"><?php echo form_error("klas"); ?><span>
</div>

<button class="mt-1 btn btn-primary">Submit</button>