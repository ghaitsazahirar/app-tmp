<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/NiceAdmin/assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/NiceAdmin/assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/NiceAdmin/assets/css/style.css') ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <?= $this->include('admin/header') ?>
    <?= $this->include('admin/sidebar') ?>
    <?= $this->renderSection('content') ?>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/chart.js/chart.umd.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/echarts/echarts.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/NiceAdmin/assets/js/main.js') ?>"></script>

    <script>
    let isEdit = false;
    let editId = null;

    // TAMPILKAN MODAL CREATE
    function showCreateModal() {
        isEdit = false;
        editId = null;
        document.getElementById('adminForm').reset();
        document.getElementById('adminModalTitle').textContent = 'Tambah Admin';
        document.getElementById('adminPassword').required = true;
        $('#adminModal').modal('show');
    }

    // TAMPILKAN MODAL EDIT DENGAN DATA ADMIN
    function editAdmin(id) {
        fetch(`/edit/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.id) {
                    isEdit = true;
                    editId = id;

                    document.getElementById('adminName').value = data.name;
                    document.getElementById('adminEmail').value = data.email;
                    document.getElementById('adminPassword').value = '';
                    document.getElementById('adminPassword').required = false;
                    document.getElementById('adminModalTitle').textContent = 'Edit Admin';

                    $('#adminModal').modal('show');
                } else {
                    Swal.fire('Error', 'Admin tidak ditemukan', 'error');
                }
            });
    }

    // SUBMIT FORM (CREATE / UPDATE)
    document.getElementById('adminForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const ladda = Ladda.create(document.querySelector('#submitBtn'));
        ladda.start();

        const formData = new FormData(this);
        const url = isEdit ? `/update/${editId}` : '/store';

        fetch(url, {
            method: 'POST',
            body: formData
        }).then(res => res.json())
        .then(res => {
            ladda.stop();
            if (res.status === 'success') {
                Swal.fire('Berhasil', isEdit ? 'Data NiceAdmin diperbarui' : 'NiceNiceAdmin ditambahkan', 'success')
                    .then(() => location.reload());
            } else {
                Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
            }
        }).catch(() => {
            ladda.stop();
            Swal.fire('Gagal', 'Server error', 'error');
        });
    });

    // HAPUS Admin
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin hapus?',
            text: 'Data tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/delete/${id}`, {
                    method: 'DELETE'
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'deleted') {
                        Swal.fire('Dihapus', 'Data NiceAdmin berhasil dihapus', 'success')
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
                    }
                })
                .catch(() => Swal.fire('Gagal', 'Server error', 'error'));
            }
        });
    }
</script>

</body>
</html>