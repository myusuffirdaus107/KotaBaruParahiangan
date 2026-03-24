@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">
        <h1 class="h3"><i class="fas fa-key"></i> Ubah Password</h1>
    </div>


    {{-- Alerts --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h5><i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan!</h5>

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif



    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.users.update-password') }}" method="POST">
                        @csrf


                        {{-- Current Password --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Password Saat Ini
                            </label>

                            <div class="input-group">
                                <input type="password"
                                       id="current_password"
                                       name="current_password"
                                       class="form-control"
                                       required>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePass('current_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>



                        {{-- Password Baru --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Password Baru
                            </label>

                            <div class="input-group">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control"
                                       required>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePass('password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <small class="text-muted">
                                Minimal 8 karakter
                            </small>
                        </div>



                        {{-- Konfirmasi --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Konfirmasi Password Baru
                            </label>

                            <div class="input-group">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-control"
                                       required>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePass('password_confirmation', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>



                        <div class="d-flex gap-2">

                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Ubah Password
                            </button>

                            <a href="{{ route('admin.dashboard') }}"
                               class="btn btn-secondary">

                                <i class="fas fa-arrow-left"></i>
                                Kembali

                            </a>

                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>

</div>


{{-- SCRIPT TOGGLE --}}
<script>

function togglePass(id, btn)
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