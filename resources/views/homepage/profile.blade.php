@extends('homepage.layouts.main')

@section('content')
<div class="container-xxl py-5 bg-primary hero-header mb-5">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated zoomIn">Profile</h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Profile User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button class="btn btn-warning align-self-end mb-3" id="edit" onclick="edit()">Edit profile <i
                        class="fas fa-edit"></i></button>
                <button class="btn btn-danger align-self-end d-none mb-3" id="back" onclick="back()">Batal <i
                        class="fas fa-times"></i></button>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-3 col-sm-12 text-center pt-3">
                    <img src="@if ($user -> image)
                        {{ $user -> image }}
                        @elseif($user -> gender == 'Perempuan')
                        {{ asset('img/woman.png') }}
                        @elseif($user -> gender == 'Laki-Laki')
                        {{ asset('img/man.png') }}
                        @else
                        {{ asset('img/user.png') }}
                    @endif" alt="" width="250px" class="rounded-circle img-thumbnail mb-3 img-fluid">
                    <h4 id="username">{{ $user -> username }}</h4>
                    <form action="/profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-start d-none" id="update">
                            <label for="formFile" class="form-label">Update Foto</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                            <input type="hidden" name="oldImage" value="{{ $user -> image }}">
                        </div>
                </div>
                <div class="col-lg-9 col-sm-12">

                    <div class="bio">

                        <div class="card mb-3">
                            <div class="card-header">
                                Informasi Data Diri
                            </div>
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#preview-account">Data
                                            Akun
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#preview-personal">Data
                                            Personal
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane active fade show  profile-edit pt-3" id="preview-account">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Nama</label>
                                                    <h4>{{ $user -> name }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Username</label>
                                                    <h4>{{ $user -> username }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Phone</label>
                                                    <h4>{{ $user -> phone }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Jenis Kelamin</label>
                                                    <h4>{{ $user -> gender }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Alamat</label>
                                                    <h4>{{ $user -> address }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Alamat Email</label>
                                                    <h4>{{ $user -> email }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show profile-overview" id="preview-personal">
                                        @if ($kyc)
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Nama Lengkap (Sesuai KTP)</label>
                                                    <h4>{{ $kyc -> nama_lengkap }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">NIK</label>
                                                    <h4>{{ $kyc -> nik }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Foto KTP</label>
                                                    <img src="{{ $kyc -> ktp }}" alt="" width="368px"
                                                        class="img-fluid p-0">
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <h4 class="text-center mt-2">Anda belum mengisikan Data Personal!</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form d-none">


                        <div class="card mb-3">
                            <div class="card-header">
                                Informasi Data Diri
                            </div>
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Data Akun
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Data Personal
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane active fade show  profile-edit pt-3" id="profile-edit">
                                        <h6>Data yang akan dimunculkan di akun anda</h6>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                                <input type="text" class="form-control" value="{{ $user -> name }}"
                                                    id="exampleInputEmail1" name="name">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                                <input type="text" class="form-control" value="{{ $user -> username }}"
                                                    id="exampleInputEmail1" name="username">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">No HP</label>
                                                <input type="text" class="form-control" value="{{ $user -> phone }}"
                                                    id="exampleInputEmail1" name="phone">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                                <select class="form-select" name="gender">
                                                    <option value="Laki-Laki"
                                                        {{ $user -> gender == 'Laki-laki' ? 'selected' : '' }}>Laki-Laki
                                                    </option>
                                                    <option value="Perempuan"
                                                        {{ $user -> gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" value="{{ $user -> address }}"
                                                    id="exampleInputEmail1" name="address">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-5">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="email" class="form-control" value="{{ $user -> email }}"
                                                    id="exampleInputEmail1" name="email">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade show profile-overview" id="profile-overview">
                                        <h6>Isikan data sesuai dengan KTP anda</h6>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama Lengkap (Sesuai
                                                    KTP)</label>
                                                <input type="text" class="form-control" @if ($kyc)
                                                    value="{{ $kyc -> nama_lengkap }}" @endif id="exampleInputEmail1"
                                                    name="nama_lengkap">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">NIK</label>
                                                <input type="text" class="form-control" @if ($kyc)
                                                    value="{{ $kyc -> nik }}" @endif id="exampleInputEmail1" name="nik">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Foto KTP</label>
                                                @if ($kyc)
                                                <img src="{{ $kyc -> ktp }}" alt="" width="368px" class="img-fluid">
                                                @endif
                                                <input type="file" class="form-control" id="exampleInputEmail1"
                                                    name="ktp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit <i
                                    class="fas fa-check-circle"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const edit = () => {
        document.querySelector('.bio').classList.add('d-none');
        document.querySelector('.form').classList.remove('d-none');
        document.querySelector('#edit').classList.add('d-none');
        document.querySelector('#back').classList.remove('d-none');
        document.querySelector('#update').classList.remove('d-none');
        document.querySelector('#username').classList.add('d-none');
    }
    const back = () => {
        document.querySelector('.bio').classList.remove('d-none');
        document.querySelector('.form').classList.add('d-none');
        document.querySelector('#edit').classList.remove('d-none');
        document.querySelector('#back').classList.add('d-none');
        document.querySelector('#update').classList.add('d-none');
        document.querySelector('#username').classList.remove('d-none');
    }
</script>
@endsection