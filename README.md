# lib-user-auth-jwt

Adalah module authorizer untuk module `lib-user`. Module ini mengambil data header `Authorization`
mengidentifiksi user.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-user-auth-jwt
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi untuk menset opsi session.

```php
return [
    'libUserAuthJwt' => [
        'expires' => 604800
    ]
];
```

## Penggunaan

Ketika service `user` di panggil, module ini akan langsung digunakan untuk mengidentifikasi 
user yang sedang login.

Untuk mendapatkan token login untuk user, gunakan library `LibUserAuthJwt\Authorizer\Jwt`
dengan method `loginById`.

```php
use LibUserAuthJwt\Authorizer\Jwt;

$result = Jwt::loginById(1);
// $result = [
//     'type' => 'bearer',
//     'expires' => 60480,
//     'token' => 'random-string'
// ];
```

Nilai yang dikembalikan oleh method `loginById` yang harus digunakan untuk authorize user
di request selanjutnya.

Silahkan mengacu pada library `lib-jwt` untuk konfigurasi jwt.