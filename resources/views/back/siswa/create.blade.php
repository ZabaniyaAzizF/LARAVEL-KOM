<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
</head>
<body>
    <h1>Tambah Siswa</h1>
    <form action="{{ route('Data-siswa.store') }}" method="POST">
        @csrf
        <label for="nama_siswa">Nama Siswa:</label>
        <input type="text" id="nama_siswa" name="nama_siswa" required><br>

        <label for="nis">NIS:</label>
        <input type="text" id="nis" name="nis" required><br>

        <label for="kelas_kode">Kelas Kode:</label>
        <input type="text" id="kelas_kode" name="kelas_kode" required><br>

        <button type="submit">Tambah Siswa</button>
    </form>
</body>
</html>
