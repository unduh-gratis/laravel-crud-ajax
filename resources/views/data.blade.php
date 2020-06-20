<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Alamat</th>
            <th scope="col">Telepon</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i => $d)
        <tr>
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->telp }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="javascript:;" role="button" onclick="ubah({{ $d->id }})" data-toggle="modal" data-target="#crudModal">Edit</a>
                <a class="btn btn-danger btn-sm" href="javascript:;" role="button" onclick="hapus({{ $d->id }})">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
