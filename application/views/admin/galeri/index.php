 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
     </div>

     <?php if ($this->session->flashdata('flash')) : ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             Data <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     <?php endif; ?>

     <?php if ($this->session->flashdata('flash_hapus')) : ?>
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Data <strong>berhasil</strong> <?= $this->session->flashdata('flash_hapus'); ?>.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     <?php endif; ?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
         </div>
         <div class="card-body">
             <!-- <a href="#" class="btn btn-default btn-md mb-3" data-toggle="modal" data-target="#modal-default"><i class=" fas fa-plus"></i> Tambah User</a> -->
             <a href="#" class="btn btn-primary btn-icon-split mb-3" data-toggle="modal" data-target="#modal-default">
                 <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Artikel</button> <br> <br> -->
                 <span class="icon text-white-50">
                     <i class="fas fa-plus"></i>
                 </span>
                 <span class="text">Tambah Galeri</span>
             </a>
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No.</th>
                             <th>Judul</th>
                             <th>Galeri</th>
                             <th>Action</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($row as $data) { ?>
                             <tr>
                                 <td><?= $no++ ?></td>
                                 <td><?= $data->judul ?></td>
                                 <td><img src="<?= base_url('assets/galeri/' . $data->image_galeri) ?>" alt="" width="90" height="110"></td>
                                 <td>

                                     <?= anchor('galeri_admin/edit/' . $data->id, '<div class="btn btn-outline-primary"><i class="far fa-edit"></i></div>') ?>

                                     <span onclick="javascript: return confirm('Anda Yakin ingin menghapus <?php echo $data->judul ?> ?')"><?= anchor('galeri_admin/deletedata/' . $data->id . '/' . $data->image_galeri, '<div class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></div>') ?></span>


                                 </td>

                             </tr>
                         <?php } ?>

                     </tbody>
                 </table>
             </div>
         </div>
     </div>



 </div>
 <!-- /.container-fluid -->

 <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Tambah Galeri</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?= base_url('galeri_admin/insertdata') ?>" enctype="multipart/form-data">
                     <div class="form-group">
                         <label>Judul</label>
                         <input type="text" class="form-control" placeholder="Isi Judul Galeri" name="judul" required>
                     </div>
                     <div class="form-group">
                         <label>Upload Galeri</label>
                         <input type="file" class="form-control" name="fotopost" required>
                     </div>


             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary swalDefaultSuccess">Simpan</button>
             </div>
         </div>
         </form>

         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>