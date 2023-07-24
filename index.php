<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Form Penilaian Mahasiswa</title>
</head>

<?php
    // data array untuk opsi form
    $dataJenisKelamin = ["Laki-laki", "Perempuan"];
    $dataAgama = ["Islam", "Kristen", "Katolik", "Hindu", "Budha"];
    $dataJurusan = ["Komputer Akuntansi", "Teknik Informatika", "Sistem Informasi"];
    $dataMataKuliah = ["Algoritma", "Bahasa Pemograman", "Jaringan Komputer", "Akuntansi Keuangan", "Agama", "Bahasa Inggris", "Bahasa Indonesia"];

    $fileJson = "data/data_mahasiswa.json";
    $dataMahasiswa = array();
    $isiDataJson = file_get_contents($fileJson);
    $dataMahasiswa = json_decode($isiDataJson, true);

    function nh(){
        $nilai = $_POST['nilai'];

        if ($nilai <= 50) {
            return "E";
        }
        else if ($nilai >= 51 && $nilai <= 70) {
            return "D";
        }
        else if ($nilai >= 71 && $nilai <= 80) {
            return "C";
        }
        else if ($nilai >= 81 && $nilai <= 90) {
            return "B";
        }
        else if ($nilai >= 91 && $nilai <= 100) {
            return "A";
        }
        else {
            return "A+";
        }
    }

    function keterangan() {
        $nilai = $_POST['nilai'];

        if ($nilai <= 70) {
            return "Tidak Lulus";
        }
        else {
            return "Lulus";
        }

    }

    if (isset($_POST['btnSimpan'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $tempatLahir = $_POST['tempat'];
        $tanggalLahir = $_POST['tanggal'];
        $agama = $_POST['agama'];
        $alamat = $_POST['alamat'];
        $nomorTelepon = $_POST['telepon'];
        $email = $_POST['email'];
        $jurusan = $_POST['jurusan'];
        $mataKuliah = $_POST['matkul'];
        $nilai = $_POST['nilai'];
        $nh = nh();
        $keterangan = keterangan();

        $dataBaru = array(
            "nim" => $nim,
            "nama" => $nama,
            "jenisKelamin" => $jenisKelamin,
            "tempat" => $tempatLahir,
            "tanggal" => $tanggalLahir,
            "agama" => $agama,
            "alamat" => $alamat,
            "telepon" => $nomorTelepon,
            "email" => $email,
            "jurusan" => $jurusan,
            "matkul" => $mataKuliah,
            "nilai" => $nilai,
            "nh" => $nh,
            "keterangan" => $keterangan
        );


        if($dataMahasiswa === null) {
            $dataMahasiswa = array();
        }

        array_push($dataMahasiswa, $dataBaru);
    }

    $dataFormat = json_encode($dataMahasiswa, JSON_PRETTY_PRINT);
    file_put_contents($fileJson, $dataFormat);
?>


<body>
    <div class="container d-flex justify-content-center bg-primary text-light mt-5 mb-5">
        <h1>Form Mahasiswa</h1>
    </div>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="mb-2 col-6">
                    <td>
                    <label class="form-label">NIM</label>
                    <input class="form-control" type="number" name="nim" id="nim"/>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Alamat</label>
                    <input class="form-control" type="text" name="alamat" id="alamat"/>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                    <label class="form-label">Nama</label>
                    <input class="form-control" type="text" name="nama" id="nama"/>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">No Telepon</label>
                    <input class="form-control" type="number" name="telepon" id="telepon"/>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                    <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenisKelamin" id="jenisKelamin">
                            <?php
                                foreach($dataJenisKelamin as $jk) {
                                    echo "<option value='$jk'> $jk </option>";
                                }
                            ?>
                        </select>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" id="email"/>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                    <label class="form-label">Tempat Lahir</label>
                    <input class="form-control" type="text" name="tempat" id="tempat"/>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Jurusan</label>
                    <td>
                        <select class="form-control" name="jurusan" id="jurusan">
                            <?php
                                foreach($dataJurusan as $jurusan) {
                                    echo "<option value='$jurusan'> $jurusan </option>";
                                }
                            ?>
                        </select>
                        </td>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input class="form-control" type="date" name="tanggal" id="tanggal" />
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Mata Kuliah</label>
                    <select class="form-control" name="matkul" id="matkul">
                            <?php
                                foreach($dataMataKuliah as $matakuliah) {
                                    echo "<option value='$matakuliah'> $matakuliah </option>";
                                }
                            ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                        <label class="form-label">Agama</label>
                        <select class="form-control" name="agama" id="agama">
                                <?php
                                    foreach($dataAgama as $agama) {
                                        echo "<option value='$agama'> $agama </option>";
                                    }
                                ?>
                        </select>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Nilai</label>
                    <input class="form-control" type="number" name="nilai" id="nilai" />
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                    <label class="form-label"></label>
                    <input class="form-control bg-primary text-light" type="submit" value="Simpan" name="btnSimpan" id="btnSimpan">
                </div>
            </div>
        </form>
    </div>
    
    <div class="container d-flex justify-content-center bg-primary text-light my-5">
        <h1>Daftar Mahasiswa</h1>
    </div>
    <div class="container">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="bg-info">
                    <th class="text-center">NIM</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jurusan</th>
                    <th class="text-center">Mata Kuliah</th>
                    <th class="text-center">Nilai</th>
                    <th class="text-center">NH</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(is_array($dataMahasiswa)) {
                        foreach($dataMahasiswa as $mahasiswa){
                            echo "<tr>";
                            echo "<td>" . $mahasiswa['nim'] . "</td>";
                            echo "<td>" . $mahasiswa['nama'] . "</td>";
                            echo "<td>" . $mahasiswa['jenisKelamin'] . "</td>";
                            echo "<td>" . $mahasiswa['jurusan'] . "</td>";
                            echo "<td>" . $mahasiswa['matkul'] . "</td>";
                            echo "<td>" . $mahasiswa['nilai'] . "</td>";
                            echo "<td>" . $mahasiswa['nh'] . "</td>";
                            echo "<td>" . $mahasiswa['keterangan'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>