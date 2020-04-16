<h1>Selamat, {{$customer->name}}</h1>
<p>Akun Anda Berhasil Terdaftar</p>

<p>Silahkan Klik Tombol dibawah ini untuk verifikasi email</p>
<button style="btn btn-success"></button>

<p>Atau klik link berikut: <a href="{{url('api/customer/verifySuccess/'.$customer->remember_token)}}">{{$customer->remember_token}}</a> </p>