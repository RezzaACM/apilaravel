<h1>Selamat, {{$customer->name}}</h1>
<p>Akun Anda Berhasil Terdaftar</p>

<p>Silahkan Klik Tombol dibawah ini untuk verifikasi email</p>
<button style="btn btn-success"></button>

<?php

$token = $customer->remember_token

?>

<p>Atau klik link berikut: <a class="link" href=<?php echo "localhost:4200/login/".$token?>>{{$customer->remember_token}}</a> </p>
