<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
<div class="container my-5 p-3 shadow rounded">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
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
                    <td class="text-capitalize">{{ $member->interested_in }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>