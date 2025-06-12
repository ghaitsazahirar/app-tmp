<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- dist CSS Files -->
  <link href="<?= base_url('assets/dist/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/simple-datatables/style.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/theme/layout-css/style-admin.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/theme/layout-css/style-headnav.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/theme/layout-css/style-sidenav.css') ?>" rel="stylesheet">
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <?= $this->include('layouts/partials-admin/header') ?>
    <?= $this->include('layouts/partials-admin/sidebar') ?>
    <?= $this->renderSection('content') ?>

  <!-- dist JS Files -->
  <script src="<?= base_url('assets/dist/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/chart.js/chart.umd.js') ?>"></script>
  <script src="<?= base_url('assets/dist/echarts/echarts.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/quill/quill.js') ?>"></script>
  <script src="<?= base_url('assets/dist/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?= base_url('assets/dist/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/php-email-form/validate.js') ?>"></script>
  <!-- Tambahkan ini di <head> atau sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/theme/js/main-admin.js') ?>"></script>
    <script>
    const baseUrl = "<?= base_url() ?>";
    let isEdit = false;
    let editId = null;

    // TAMPILKAN MODAL TAMBAH
    function openCreateModal() {
        isEdit = false;
        editId = null;
        $('#adminForm')[0].reset();
        $('#adminModalTitle').text('Tambah Admin');
        $('#adminPassword').prop('required', true);
        $('#adminModal').modal('show');
    }

    // TAMPILKAN MODAL EDIT
    function editAdmin(id) {
        $.get(`${baseUrl}/edit/${id}`, function (data) {
        if (data.id) {
            isEdit = true;
            editId = id;

            $('#adminName').val(data.name);
            $('#adminEmail').val(data.email);
            $('#adminPassword').val('');
            $('#adminPassword').prop('required', false);
            $('#adminModalTitle').text('Edit Admin');

            $('#adminModal').modal('show');
        } else {
            Swal.fire('Error', 'Admin tidak ditemukan', 'error');
        }
        }).fail(() => {
        Swal.fire('Gagal', 'Tidak dapat mengambil data', 'error');
        });
    }

    // SUBMIT FORM (CREATE / UPDATE)
    $('#adminForm').on('submit', function (e) {
        e.preventDefault();

        const ladda = Ladda.create(document.querySelector('#submitBtn'));
        ladda.start();

        const formData = new FormData(this);
        const url = isEdit ? `${baseUrl}/update/${editId}` : `${baseUrl}/store`;

        $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            ladda.stop();
            if (res.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: isEdit ? 'Admin berhasil diupdate!' : 'Admin berhasil ditambahkan!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => location.reload());
            } else {
            Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
            }
        },
        error: function () {
            ladda.stop();
            Swal.fire('Gagal', 'Server error', 'error');
        }
        });
    });

    // HAPUS ADMIN
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
                Swal.fire({
                    icon: 'success',
                    title: 'Admin dihapus!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
                } else {
                Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Gagal', 'Server error', 'error');
            });
        }
        });
    }
    </script>

</body>
</html>