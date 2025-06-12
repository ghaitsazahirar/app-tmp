<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/NiceAdmin/assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/NiceAdmin/assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Vendor CSS Files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/spin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css">

  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/NiceAdmin/assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/NiceAdmin/assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <?= $this->include('admin/header') ?>
    <?= $this->include('admin/sidebar') ?>
    <?= $this->renderSection('admin') ?>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/chart.js/chart.umd.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/echarts/echarts.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/quill/quill.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?= base_url('assets/NiceAdmin/assets/vendor/php-email-form/validate.js') ?>"></script>
  <!-- Tambahkan ini di <head> atau sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/NiceAdmin/assets/js/main.js') ?>"></script>
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