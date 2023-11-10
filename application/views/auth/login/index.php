<div class="card mb-0">
    <div class="card-body">
        <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
            <img src="<?= base_url()?>assets/img/logo.jpg" width="180" alt="">
        </a>
        <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                    Ingat Saya
                </label>
            </div>
            <a class="text-primary fw-bold" href="<?= base_url() ?>auth/forgot_password">Forgot Password ?</a>
        </div>
            <a href="<?= base_url()?>dashboard" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</a>
        </form>
    </div>
</div>
                   