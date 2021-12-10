@php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data MemberOR.xls");
@endphp
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Handphone</th>
            <th>Jurusan</th>
            <th>Program Studi</th>
            <th>Bidang Minat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $member->nim }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone_number }}</td>
                <td>{{ $member->major }}</td>
                <td>{{ $member->study_program }}</td>
                <td>{{ $member->interested_in }}</td>
            </tr>
        @endforeach
    </tbody>
</table>