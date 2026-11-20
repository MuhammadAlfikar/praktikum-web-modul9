<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
</head>
<body>

    <h1>Daftar Buku</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('buku.create') }}">Tambah Buku</a>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($bukus as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $buku->kode }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->kategori->nama }}</td>
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}">Edit</a>

                        <form action="{{ route('buku.destroy', $buku->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>