@extends('homepage.layouts.main')

@section('content')
<div class="container-xxl py-5 bg-primary hero-header mb-5">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated zoomIn">Denda</h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Denda</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<form action="/denda" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Denda</h6>
                <h2 class="mt-2">Mohon bayar tagihan anda</h2>
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
            <div class="row g-4">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h4 class="mb-5">Pilih metode pembayaran!</h4>
                    @error('payment')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        @foreach ($banks as $bank)
                        <div class="col-4 mb-4">
                            <td style="padding:10px;">
                                <div class="form-check">
                                    <label class="form-check-label " for="exampleRadios{{ $loop -> iteration }}">
                                        <img src="{{ asset($bank->image) }}" alt="" height="100px"
                                            style="object-fit: fill;border-radius: 20px;" class="img-target">
                                    </label>
                                    <input class="form-check-input d-none opt-radio" type="radio" name="bank_id"
                                        id="exampleRadios{{ $loop -> iteration }}" value="{{ $bank->id }}">
                                </div>
                            </td>
                        </div>
                        @endforeach
                    </div>
                    <h4 class="mb-3">Instruksi Pembayaran</h4>
                    <div class="accordion" id="accordionExample">
                        @foreach ($banks as $bank)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $loop -> iteration }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop -> iteration }}" aria-expanded="false"
                                    aria-controls="collapse{{ $loop -> iteration }}">
                                    {{ $bank->name }} <img src="{{ asset($bank->image) }}" alt="" width="75px">
                                </button>
                            </h2>
                            <div id="collapse{{ $loop -> iteration }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $loop -> iteration }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li>No Rekening : {{ $bank->norek }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Total Denda</h4>
                            <h6 class="card-subtitle mb-2">Rp.{{ number_format($denda) }}</h6>
                            <input type="hidden" value="{{ $tanggal_kembali }}" name="tanggal_kembali">
                            <input type="hidden" value="{{ $orderDetail -> id }}" name="orderDetail">
                            <input type="hidden" value="{{ $denda }}" name="total">
                            <hr>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">
                                    <h6>*Upload bukti pembayaran</h6>
                                </label>
                                <input class="form-control" type="file" id="formFile" name="bukti_pembayaran" required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Selesaikan pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    const radio = document.querySelectorAll('.opt-radio');
    const target = document.querySelectorAll('.img-target');

    radio.forEach(function (item, index) {
        item.addEventListener('click', function () {
            target.forEach(function (item, index) {
                item.style.backgroundColor = 'white';
                item.style.transform = 'scale(1)';
            });
            target[index].style.backgroundColor = 'rgba(0,0,0,0.05)';
            target[index].style.transform = 'scale(1.2)';
        });
    });
</script>
@endsection