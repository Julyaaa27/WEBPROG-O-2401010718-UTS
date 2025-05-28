<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Form Tambah Data Lapangan</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    label { display: block; margin-top: 10px; }
    input, select { width: 250px; padding: 5px; margin-top: 5px; }
    button { margin-top: 15px; padding: 7px 20px; }
  </style>
</head>
<body>

  <h2>Tambah Data Lapangan</h2>

  <form id="formLapangan">
    <label>Nama Lapangan:
      <input type="text" id="nama" required placeholder="Masukkan nama lapangan" />
    </label>

    <label>Jenis Lapangan:
      <select id="jenis" required>
        <option value="" disabled selected>-- Pilih jenis lapangan --</option>
        <option value="Futsal">Futsal</option>
        <option value="Basket">Basket</option>
        <option value="Badminton">Badminton</option>
        <option value="Tenis">Tenis</option>
      </select>
    </label>

    <label>Harga per Jam (Rp):
      <input type="number" id="harga" min="0" required placeholder="Masukkan harga per jam" />
    </label>

    <label>Status:
      <select id="status" required>
        <option value="" disabled selected>-- Pilih status --</option>
        <option value="Tersedia">Tersedia</option>
        <option value="Tidak Tersedia">Tidak Tersedia</option>
      </select>
    </label>

    <button type="submit">Simpan</button>
  </form>

  <script>
    const form = document.getElementById('formLapangan');

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      // Ambil data dari form
      const nama = document.getElementById('nama').value.trim();
      const jenis = document.getElementById('jenis').value;
      const harga = document.getElementById('harga').value;
      const status = document.getElementById('status').value;

      // Proses data (misal, kirim ke server atau tampilkan)
      alert(`Data berhasil disimpan:\nNama: ${nama}\nJenis: ${jenis}\nHarga: Rp${harga}\nStatus: ${status}`);

      // Reset form setelah submit
      form.reset();
    });
  </script>

</body>
</html>