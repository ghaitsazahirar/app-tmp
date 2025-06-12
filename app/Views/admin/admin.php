<?= $this->extend('tmp/admin') ?>
<?= $this->section('admin') ?>
 <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p>

                <div class="table-responsive">
                    <button class="btn btn-primary mb-3" onclick="openCreateModal()">Add Admin</button>
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= esc($admin['id']) ?></td>
                            <td><?= esc($admin['name']) ?></td>
                            <td><?= esc($admin['email']) ?></td>
                            <td><?= esc(substr($admin['password'], 0, 10)) ?>...</td>
                            <td>
                            <button 
                                class="btn btn-warning btn-sm ladda-button" 
                                data-style="expand-left" 
                                onclick="editAdmin(<?= $admin['id'] ?>)">
                                <span class="ladda-label">Edit</span>
                            </button>
                            <button 
                                class="btn btn-danger btn-sm ladda-button" 
                                data-style="expand-left" 
                                onclick="confirmDelete(<?= $admin['id'] ?>)">
                                <span class="ladda-label">Delete</span>
                            </button>
                            </td>
                        </tr>
                        <?php endforeach ?>                 
                    </tbody>
                </table>
                </div>
              <!-- End Table with stripped rows -->

                <!-- Modal -->
                <div class="modal fade" id="adminModal" tabindex="-1">
                <div class="modal-dialog">
                    <form class="modal-content" id="adminForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminModalTitle">Tambah Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="adminName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="adminName" name="name" required>
                        </div>
                        <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="adminEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary ladda-button" data-style="expand-left" id="submitBtn">
                        <span class="ladda-label">Simpan</span>
                        </button>
                    </div>
                    </form>
                    
                </div>
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?= $this->endSection() ?>