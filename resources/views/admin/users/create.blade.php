@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3">
            <i class="fas fa-user-plus"></i>
            Tambah Admin User
        </h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        {{-- Name --}}
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        {{-- Email --}}
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        {{-- Password --}}
                        <div class="mb-3">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control"
                                       required>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('password', this)">

                                    <i class="fas fa-eye"></i>

                                </button>

                            </div>

                        </div>
                        {{-- Confirm --}}
                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-control"
                                       required>
                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('password_confirmation', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function togglePassword(id, btn)
{
    let input = document.getElementById(id);
    let icon = btn.querySelector("i");

    if (input.type === "password")
    {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
    else
    {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

</script>

@endsection