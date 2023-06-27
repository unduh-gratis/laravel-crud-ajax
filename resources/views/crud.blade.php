@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">CRUD with Ajax</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a name="tambah" id="tambah" class="btn btn-success float-right mb-3" href="javascript:;" role="button" data-toggle="modal" data-target="#crudModal">Tambah</a>

                    <div id="tabel"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crudModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-biodata">
            @csrf
            <input type="hidden" name="metode" id="metode">
            <input type="hidden" name="id" id="idnya">
            <div class="form-group">
                <label for="nama">Nama*</label>
                <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" autofocus required>
            </div>
            <div class="form-group">
                <label for="username">Username*</label>
                <input type="text" class="form-control" name="username" id="username" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat*</label>
                <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="telp">No.Telepon*</label>
                <input type="text" class="form-control" name="telp" id="telp" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="pendidikan">Pendidikan Terakhir</label>
              <select class="form-control" name="pendidikan" id="pendidikan" required>
                <option value="">Pilih...</option>
                @foreach ($data_pendidikan as $pendidikan)
                <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                @endforeach
              </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            tampil();
        });

        function tampil() {
            $.ajax({
                url: '{{url("crud/tampil")}}',
                type: 'GET',
                success: (html) => {
                    $('#tabel').html(html);
                },
                error: ()=> {
                    alert('Lakukan "php artisan migrate" terlebih dahulu');
                }
            })
        }

        $( "#tambah" ).click(()=> {
            $('#crudModalLabel').html('Tambah Data');
            $('button.btn-primary').html('Simpan Data');
            $('#metode').val('tambah');
            $('#nama').val('');
            $('#username').val('');
            $('#alamat').val('');
            $('#telp').val('');
            $('#pendidikan').val('');
        });

        $('button.btn-primary').click(()=>{
            var metode = $('#metode').val();
            var data = $('#form-biodata').serialize();

            if (metode == 'tambah') {
                $.ajax({
                    url: '{{url("crud/tambah")}}',
                    type: 'POST',
                    data: data,
                    dataType:"json",
                    success: () => {
                        $('#crudModal').modal('hide');
                        tampil();
                    },
                    complete:()=>{
                        $("#form-biodata")[0].reset();
                    },
                    error: () => {
                        alert('Gagal tambah data');
                    }
                })
            }else{
                $.ajax({
                    url: '{{url("crud/ubah")}}',
                    type: 'POST',
                    data: data,
                    dataType:"json",
                    success: () => {
                        $('#crudModal').modal('hide');
                        tampil();
                    },
                    complete:()=>{
                        $("#form-biodata")[0].reset();
                    },
                    error: () => {
                        alert('Gagal ubah data');
                    }
                })
            }
        })

        function ubah(id) {
            $('#crudModalLabel').html('Ubah Data');
            $('button.btn-primary').html('Ubah Data');
            $('#metode').val('ubah');
            $.ajax({
                url: '{{url("crud/ambil")}}',
                type: 'POST',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType:"json",
                success: (res) => {
                    $('#nama').val(res.nama);
                    $('#username').val(res.username);
                    $('#alamat').val(res.alamat);
                    $('#telp').val(res.telp);
                    $('#pendidikan').val(res.pendidikan);
                    $('#idnya').val(res.id);
                },
                error: ()=> {
                    alert('Lakukan "php artisan migrate" terlebih dahulu');
                }
            })
        }

        function hapus(id) {
            $.ajax({
                url: '{{url("crud/hapus")}}',
                type: 'POST',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType:"json",
                success: () => {
                    tampil();
                },
                error: ()=> {
                    alert('Error hapus data');
                }
            })
        }

    </script>
@endpush
