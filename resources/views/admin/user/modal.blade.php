<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="modalTitle">Hapus Data?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-white">&times;</span>
              </button>
          </div>
          <div class="modal-body text-left">
              <div class="row">
                  <div class="col-6">Nama</div>
                  <div class="col-6">: <span id="modalNama"></span></div>
              </div>
              <div class="row">
                  <div class="col-6">Email</div>
                  <div class="col-6">: <span id="modalEmail" class="badge badge-primary"></span></div>
              </div>
              <div class="row">
                  <div class="col-6">Jabatan</div>
                  <div class="col-6">: <span id="modalJabatan" class="badge"></span></div>
              </div>
              <div class="row">
                  <div class="col-6">Status</div>
                  <div class="col-6">: <span id="modalStatus" class="badge"></span></div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                  <i class="fas fa-times"></i> Tutup
              </button>
              <form id="deleteForm" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash"></i> Hapus
                  </button>
              </form>
          </div>
      </div>
  </div>
</div>

<script>
  $(document).ready(function() {
      $('.delete-btn').click(function() {
          const id = $(this).data('id');
          const nama = $(this).data('nama');
          const email = $(this).data('email');
          const jabatan = $(this).data('jabatan');
          const tugas = $(this).data('tugas');

          // Isi modal dengan data yang sesuai
          $('#modalNama').text(nama);
          $('#modalEmail').text(email);
          $('#modalJabatan').text(jabatan);

          // Tentukan warna badge jabatan
          if (jabatan === 'Admin') {
              $('#modalJabatan').removeClass().addClass('badge badge-dark');
          } else {
              $('#modalJabatan').removeClass().addClass('badge badge-info');
          }

          // Tentukan status tugas
          if (tugas) {
              $('#modalStatus').text('Sudah Ditugaskan').removeClass().addClass('badge badge-success');
          } else {
              $('#modalStatus').text('Belum Ditugaskan').removeClass().addClass('badge badge-danger');
          }

          // Update form action sesuai ID yang diklik
          $('#deleteForm').attr('action', '/userDestroy/' + id);
      });
  });
</script>
