# TP3DPBO20234C2

![Screenshot 2024-04-30 203336](https://github.com/LegiKuswandi/TP3DPBO20234C2/assets/147142081/0a4c0a94-689a-4b52-9f41-bf74ae6baa1c)

## Penjelasan Class

### `MagicType`

Class ini merepresentasikan jenis-jenis sihir yang ada dalam dunia Black Clover.

#### Properties:

- `id_magic_type`: Integer, merupakan ID unik untuk setiap jenis sihir.
- `magic_type`: String, merepresentasikan nama jenis sihir.

### `Squad`

Class ini merepresentasikan berbagai skuad yang ada dalam dunia Black Clover.

#### Properties:

- `id_squad`: Integer, merupakan ID unik untuk setiap skuad.
- `squad_name`: String, merepresentasikan nama skuad.

### `TCharacter`

Class ini merepresentasikan karakter-karakter dalam dunia Black Clover.

#### Properties:

- `id_character`: Integer, merupakan ID unik untuk setiap karakter.
- `character_name`: String, merepresentasikan nama karakter.
- `character_age`: Integer, merepresentasikan usia karakter.
- `character_height`: Integer, merepresentasikan tinggi karakter.
- `character_foto`: String, merepresentasikan nama berkas foto karakter.
- `id_squad`: Integer, merupakan ID skuad yang terkait dengan karakter.
- `id_magic_type`: Integer, merupakan ID jenis sihir yang dimiliki karakter.

#### Relationships:

- Setiap karakter terkait dengan satu skuad (many-to-one relationship).
- Setiap karakter memiliki satu jenis sihir (many-to-one relationship).

#### Halaman Depan 
Menampilkan list character, dapat melakukan sort dan juga search
![Screenshot 2024-04-30 201807](https://github.com/LegiKuswandi/TP3DPBO20234C2/assets/147142081/57474927-65c4-4b57-8470-610d9ea0b0b7)

#### Halaman Detail Character
Menampilkan detail dari character yang dipilih
![Screenshot 2024-04-30 202644](https://github.com/LegiKuswandi/TP3DPBO20234C2/assets/147142081/5d95c86a-94d8-4a94-a548-080d752b2ac3)

#### Halaman tambah character 
untuk memasukan data character baru
![Screenshot 2024-04-30 201821](https://github.com/LegiKuswandi/TP3DPBO20234C2/assets/147142081/7c233c75-c6eb-462f-b7d8-cb5b67d4620d)

#### Halaman list squad
Menampilkan list squad, dapat melakukan sort, search, delete, update dan add
![Screenshot 2024-04-30 201834](https://github.com/LegiKuswandi/TP3DPBO20234C2/assets/147142081/f423649b-30af-4bba-ac6f-af3687010ed9)

#### Halaman list magic type
Menampilkan list magic type, dapat melakukan sort, search, delete, update dan add



