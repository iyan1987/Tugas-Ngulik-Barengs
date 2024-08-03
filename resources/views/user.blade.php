<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>    
<body>



    <div class="container">
        <h1>Data User</h1>
        <a href="{{ route('user.tambah') }}" class="btn btn-primary">+ Tambah User</a>
        ||
        <a href="{{ route('user.tong') }}" class="btn btn-primary">TONG SAMPAH</a>


        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>Photo</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Job</th>
                <th>Gender</th>
                <th>Hobbies</th>
                <th>Opsi</th>
            </tr>
            <?php $i = ($user->currentpage()-1)* $user->perpage() + 1;?>
            @foreach($user as $u)
            <tr>
                <td>{{ $i++ }}</td>
                <td><img src="{{ asset('storage/user/'.$u->photo) }}" class="rounded" style="width: 150px"></td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->job }}</td>
                <td>{{ $u->gender }}</td>
                <td>{{ $u->hobbies }}</td>
                <td>
                    <a href="{{ url('user/edit/'.$u->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ url('user/hapus/'.$u->id) }}" class="btn btn-danger">Hapus</a>                    
                </td>
            </tr>
            @endforeach
        </table>

        <!-- {{ $user->links() }} -->

            {!! $user->withQueryString()->links('pagination::bootstrap-5') !!}


    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
