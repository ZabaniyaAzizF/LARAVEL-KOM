<form method="GET" action="{{ route('Data-siswa') }}">
    <select name="kelas_kode">
        <option value="">Pilih Kelas</option>
        @foreach($kelas as $kls)
            <option value="{{ $kls->kode }}" {{ request('kelas_kode') == $kls->kode ? 'selected' : '' }}>
                {{ $kls->nama }}
            </option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nis }}</td>
                <td>{{ $user->kelas->nama }}</td>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        @endforeach
    </tbody>
</table>
