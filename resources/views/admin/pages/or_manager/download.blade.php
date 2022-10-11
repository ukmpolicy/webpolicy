@php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data MemberOR.xls");
@endphp
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Whatsapp</th>
            <th>Jurusan</th>
            <th>Program Studi</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Tempat Lahir</th>
            <th>Pas Foto</th>
            <th>Bukti PKKMB</th>
            <th>Bukti Follow IG</th>
            <th>Kuisioner</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->nim }}</td>
                <td>{{ $member->nama }}</td>
                <td>{{ $member->email }}</td>
                <td>`{{ $member->no_wa }}</td>
                <td>{{ $member->jurusan }}</td>
                <td>{{ $member->prodi }}</td>
                <td>{{ $member->alamat }}</td>
                <td>{{ $member->tgl_lahir }}</td>
                <td>{{ $member->tmp_lahir }}</td>
                <td><a href="{{ asset('uploads/'.$member->pas_foto) }}">download</a></td>
                <td><a href="{{ asset('uploads/'.$member->bkpkkmb) }}">download</a></td>
                <td><a href="{{ asset('uploads/'.$member->bukti_follow) }}">download</a></td>
                <td><a href="{{ asset('uploads/'.$member->kuisioner) }}">download</a></td>
            </tr>
        @endforeach
    </tbody>
</table>