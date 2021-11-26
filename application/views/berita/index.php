        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><i class="far fa-newspaper"></i> <?= $title; ?></h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
                        </div>

                        <div class="row mt-2 ml-md-2 text-center">
                    <div class="col-md-1">

                     </div>
                    <div class="col-sm-10">
                        <?= form_error('image', '<div class="error">', '</div>'); ?>    
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div> 
                        <div class="card-body">

                        <a href="<?= base_url('berita/tambah');?>" class="btn btn-info btn-icon-split mb-3 mt-1">
                              <span class="icon text-white-50">
                              <i class="fas fa-plus-circle"></i>
                              </span>
                              <span class="text">Tambah Buku</span>
                        </a>

                                  
                                    
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul Buku</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Kategori</th>
                                            <th>isi Buku</th>
                                            <th>Peminjam</th>
                                            <th>Action</th>
                                           
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php foreach($berita as $brt) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= character_limiter($brt['judul'],25 );  ?></td>
                                            <td><?= $brt['tanggal']; ?></td>

                                            
                                            <td>
                                                <?php $cek = 'draff' ?>
                                                <?php if($brt['status'] == $cek ) : ?>
                                                    <i class="fas fa-times-circle"></i>
                                                    draff
                                               <?php else: ?>
                                                <i class="fas fa-check-circle"></i>
                                                    publish
                                                <?php endif; ?>
                                                <td><?= character_limiter($brt['kategori'],25 );  ?></td>
                                                <td><?= character_limiter($brt['isi'],25 );  ?></td>
                                            </td>
                                            <td><?= $brt['user']; ?></td>
                                            <td>
                                            <a href="<?= base_url('berita/view/'); ?><?= $brt['id'];?>" class="badge badge-primary">
                                            <i class="far fa-eye"></i>
                                                view</a>
                                            <a href="<?= base_url('berita/edit/'); ?><?= $brt['id'];?>" class="badge badge-success">
                                                <i class="fas fa-edit"></i>
                                                edit</a>
                                            <a href="<?= base_url('berita/delete/'); ?><?= $brt['id'];?>/<?= $brt['gambar'];?>" class="badge badge-danger" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Berita?');">
                                                <i class="far fa-trash-alt"></i>
                                                delete</a>
                                            </td>
                                            
                                        </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->