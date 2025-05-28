<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Form Lapangan dengan Hapus Data</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    label { display: block; margin-top: 10px; }
    input, select { width: 200px; padding: 5px; margin-top: 5px; }
    button { margin-top: 15px; padding: 7px 15px; margin-right: 5px; }
    table { margin-top: 20px; border-collapse: collapse; width: 80%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #eee; }
    tr:hover { background: #f9f9f9; cursor: pointer; }
    .btn-hapus { color: red; cursor: pointer; }
  </style>
</head>
<body>

  <h2>Form Data Lapangan</h2>

  <form id="lapanganForm">
    <label>Nama Lapangan
      <input type="text" id="nama" required />
    </label>

    <label>Jenis Lapangan
      <select id="jenis" required>
        <option value="">-- Pilih Jenis --</option>
        <option value="Futsal">Futsal</option>
        <option value="Basket">Basket</option>
        <option value="Badminton">Badminton</option>
        <option value="Tenis">Tenis</option>
      </select>
    </label>

    <label>Harga per Jam (Rp)
      <input type="number" id="harga" min="0" required />
    </label>

    <label>Status
      <select id="status" required>
        <option value="">-- Pilih Status --</option>
        <option value="Tersedia">Tersedia</option>
        <option value="Tidak Tersedia">Tidak Tersedia</option>
      </select>
    </label>

    <button type="submit" id="btnSimpan">Simpan</button>
    <button type="submit" id="btnSimpan">Hapus</button>

    <button type="button" id="btnUpdate" style="display:none;">Update</button>
    <button type="button" id="btnBatal" style="display:none;">Batal</button>
  </form>

  <script>
    const form = document.getElementById('lapanganForm');
    const btnSimpan = document.getElementById('btnSimpan');
    const btnUpdate = document.getElementById('btnUpdate');
    const btnBatal = document.getElementById('btnBatal');
    const tbody = document.querySelector('#tableLapangan tbody');
    

    function loadForm(index) {
      const item = dataLapangan[index];
      document.getElementById('nama').value = item.nama;
      document.getElementById('jenis').value = item.jenis;
      document.getElementById('harga').value = item.harga;
      document.getElementById('status').value = item.status;

      editIndex = index;
      btnSimpan.style.display = 'none';
      btnUpdate.style.display = 'inline-block';
      btnBatal.style.display = 'inline-block';
    }

    function resetForm() {
      form.reset();
      editIndex = null;
      btnSimpan.style.display = 'inline-block';
      btnUpdate.style.display = 'none';
      btnBatal.style.display = 'none';
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const nama = document.getElementById('nama').value.trim();
      const jenis = document.getElementById('jenis').value;
      const harga = document.getElementById('harga').value;
      const status = document.getElementById('status').value;

      if(editIndex === null) {
        dataLapangan.push({ nama, jenis, harga, status });
      } else {
        dataLapangan[editIndex] = { nama, jenis, harga, status };
      }

</body>
</html>