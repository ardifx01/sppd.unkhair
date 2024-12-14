<div>
    <div class="row m-b-20">
        <div class="col-md-12">
            <center><img src="{{ asset('images/unkhair.png') }}" class="logo-icon" alt=""></center><br>
            <h4 class="text-center">{{ $judul }}</h4>
        </div>
    </div>
    <hr>

    @if ($flash = flashAllert())
        {!! $flash !!}
    @endif

    <form wire:submit="checklogin">
        <div class="form-group rounded">
            <label><b>Masukkan Username:</b></label>
            <input type="text" name="username"
                class="form-control form-control-lg @error('username') form-control-danger @enderror"
                value="{{ old('username') }}" wire:model="username" placeholder="Masukkan Username">
            <span class="form-bar"></span>
            @error('username')
                <span class="text-danger">{!! $message !!}</span>
            @enderror
        </div>

        <div class="form-group rounded">
            <label><b>Password:</b></label>
            <input type="password" name="password"
                class="form-control form-control-lg @error('password') form-control-danger @enderror"
                value="{{ old('password') }}" wire:model="password" placeholder="Password">
            <span class="form-bar"></span>
            @error('password')
                <span class="text-danger">{!! $message !!}</span>
            @enderror
        </div>


        <div class="row m-t-25 mb-2">
            <div class="col-md-12">
                <div class="text-center">
                    <button type="submit"
                        class="btn btn-primary btn-md btn-block waves-effect waves-light text-center mb-3"
                        wire:loading.attr="disabled" wire:target="checklogin">
                        <span wire:loading.remove wire.target="checklogin"><i class="fa fa-sign-in"></i> Masuk</span>
                        <span wire:loading wire.target="checklogin">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Waiting...
                        </span>
                    </button>
                </div>
                <div class="border border-danger rounded p-2 text-center">
                    <a href="{{ route('frontend.beranda') }}" class="text-danger" style="font-size:12px">Kembali ke
                        Halaman
                        Utama</a>
                </div>
            </div>
        </div>
    </form>
</div>
