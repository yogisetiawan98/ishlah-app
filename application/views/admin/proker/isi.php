 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-2 text-gray-800">Kelola Isi Proker</h1>
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
             <h6 class="m-0 font-weight-bold text-primary">Data Proker</h6>
         </div>
         <div class="card-body">

             <a href="<?= base_url('divisi_proker/tambah_isi') ?>" class="btn btn-primary btn-icon-split mb-3">
                 <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Artikel</button> <br> <br> -->
                 <span class="icon text-white-50">
                     <i class="fas fa-plus"></i>
                 </span>
                 <span class="text">Tambah Isi Proker</span>
             </a>

             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No.</th>
                             <th>Divisi Proker</th>
                             <th>Judul Proker</th>
                             <th>Deskripsi Proker</th>
                             <th>Cover Proker</th>
                             <th>Action</th>
                         </tr>
                     </thead>

                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($row as $data) { ?>
                             <tr>
                                 <td><?= $no++ ?></td>
                                 <td><?= $data->nama_divisi ?></td>
                                 <td><?= $data->judul_proker ?></td>
                                 <td><?= $data->deskripsi_proker ?></td>
                                 <td><img src="<?= base_url('assets/cover_proker/' . $data->cover_proker) ?>" alt="" width="90" height="110"></td>
                                 <td>
                                     <?= anchor('divisi_proker/edit_isi/' . $data->id, '<div class="btn btn-outline-primary"><i class="far fa-edit"></i></div>') ?>

                                     <span onclick="javascript: return confirm('Anda Yakin ingin menghapus <?php echo $data->nama_divisi ?> ?')"><?= anchor('divisi_proker/hapus_isi/' . $data->id . '/' . $data->cover_proker, '<div class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></div>') ?></span>


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