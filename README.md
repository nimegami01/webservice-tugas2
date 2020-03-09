# webservice-tugas2

##API Documentations

###POST http://webservice.postku.org/tugas2/tambah.php

###Parameter:
- show (int): memasukkan/mengambil data.
value 1 (memasukkan data)
value 2 (mengambil data)
- asset (text): memasukkan nama data.
- desc_ (text): memasukkan deskripsi data.
- poly (int): memasukkan poly data.
value 1 (low poly)
value 2 (high poly)

###Contoh memasukkan data:
Request Body: { 'show' : 1, 'asset': 'wira', 'desc_': 'Bos Polisi', 'poly': 2}
Success Respon Body: {'status': 1, ' Berhasil di Masukkan.'}

###Contoh Mengambil data:
Request Body: { 'show' : 2}
Success Respon Body: {'status': 1, data: {'0': 'id', '1': 'asset', '2': 'deskrisi'}, {value..}, {value..}}
