<h1>Selamat, {{$reset->email}}</h1>
<p>Akun Anda Berhasil Terdaftar</p>

<p>Silahkan Klik Tombol dibawah ini untuk verifikasi email</p>
<button style="btn btn-success"></button>

<?php

$token = $reset->token

?>

<p>Atau klik link berikut: <a class="link" href=<?php echo "localhost:4200/reset-password/reset".$token?>>{{$reset->token}}</a> </p>
