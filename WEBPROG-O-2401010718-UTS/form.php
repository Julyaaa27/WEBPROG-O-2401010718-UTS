<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Data Lapangan</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
    h2, h3 { color: #333; }
    form {
      background: white; padding: 20px; border-radius: 8px; max-width: 350px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    label { display: block; margin-top: 15px; font-weight: 600; color: #444; }
    input, select {
      width: 100%; padding: 8px; margin-top: 5px;
      border: 1px solid #ccc; border-radius: 4px;
      font-size: 14px;
      box-sizing: border-box;
    }
    button {
      margin-top: 20px; padding: 10px 20px; font-size: 15px;
      border: none; border-radius: 4px; cursor: pointer;
      transition: background-color 0.3s ease;
    }
    #btnSimpan { background-color: #28a745; color: white; }
    #btnSimpan:hover { background-color: #218838; }
    #btnUpdate { background-color: #007bff; color: white; display: none; }
    #btnUpdate:hover { background-color: #0069d9; }
    #btnBatal { background-color: #6c757d; color: white; margin-left: 10px; display: none; }
    #btnBatal:hover { background-color: #5a6268; }

    table {
      margin-top: 30px; width: 100%; border-collapse: collapse;
      background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ddd; padding: 12px; text-align: left;
      font-size: 14px;
    }
    th {
      background-color: #007bff; color: white;
    }
    tbody tr:hover {
      background-color: #f1f1f1; cursor: pointer;
    }
    .btn-hapus {
      color: #dc3545; cursor: pointer; font-weight: 600;
      text-decoration: underline;
      background: none; border: none; font-size: 14px;
    }
    .btn-hapus:hover {
      color: #b02a37;
    }

    @media (max-width: 600px) {
      form, table { width: 100%; }
    }
  </style>
</head>
<body>

  <h2>Manajemen Data Lapangan</h2>

  <form id="lapanganForm">
    <label for="nama">Nama Lapangan:</label>
    <input type="text" id="nama" required placeholder="Masukkan nama lapangan" />

    <label for="jenis">Jenis Lapangan:</label>
    <select id="jenis" required>
      <option value="" disabled selected>-- Pilih jenis lapangan --</option>
      <option value="Futsal">Futsal</option>
      <option value="Basket">Basket</option>
      <option value="Badminton">Badminton</option>
      <option value="Tenis">Tenis</option>
    </select>

    <label for="harga">Harga per Jam (Rp):</label>
    <input type="number" id="harga" min="0" required placeholder="Masukkan harga per jam" />

    <label for="status">Status:</label>
    <select id="status" required>
      <option value="" disabled selected>-- Pilih status --</option>
      <option value="Tersedia">Tersedia</option>
      <option value="Tidak Tersedia">Tidak Tersedia</option>
    </select>

    <button type="submit" id="btnSimpan">Simpan</button>
    <button type="button" id="btnUpdate">Update</button>
    <button type="button" id="btnBatal">Batal</button>
  </form>

  <h3>Daftar Lapangan</h3>
  <table id="tableLapangan">
    <thead>
      <tr>
        <th>Nama Lapangan</th>
        <th>Jenis Lapangan</th>
        <th>Harga per Jam (Rp)</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <!-- Data lapangan akan muncul di sini -->
    </tbody>
  </table>

  <script>
    const form = document.getElementById('lapanganForm');
    const btnSimpan = document.getElementById('btnSimpan');
    const btnUpdate = document.getElementById('btnUpdate');
    const btnBatal = document.getElementById('btnBatal');
    const tbody = document.querySelector('#tableLapangan tbody');

    let dataLapangan = [];
    let editIndex = null;

    // Render tabel data
    function renderTable() {
      tbody.innerHTML = '';
      if(dataLapangan.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td colspan="5" style="text-align:center; color:#777;">Belum ada data lapangan.</td>`;
        tbody.appendChild(tr);
        return;
      }

      dataLapangan.forEach((item, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.nama}</td>
          <td>${item.jenis}</td>
          <td>${Number(item.harga).toLocaleString('id-ID')}</td>
          <td>${item.status}</td>
          <td>
            <button class="btn-hapus" data-index="${index}" title="Hapus data ini">Hapus</button>
          </td>
        `;

        // Klik baris untuk edit, kecuali klik tombol hapus
        tr.addEventListener('click', (e) => {
          if(e.target.classList.contains('btn-hapus')) return;
          loadForm(index);
        });

        tbody.appendChild(tr);
      });

      // Pasang event klik hapus
      document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.stopPropagation();
          const idx = e.target.getAttribute('data-index');
          if(confirm('Yakin ingin menghapus data ini?')) {
            dataLapangan.splice(idx, 1);
            renderTable();
            resetForm();
          }
        });
      });
    }

    // Muat data ke form untuk edit
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

    // Reset form ke keadaan awal
    function resetForm() {
      form.reset();
      editIndex = null;
      btnSimpan.style.display = 'inline-block';
      btnUpdate.style.display = 'none';
      btnBatal.style.display = 'none';
    }

    // Tambah data baru
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const nama = document.getElementById('nama').value.trim();
      const jenis = document.getElementById('jenis').value;
      const harga = document.getElementById('harga').value;
      const status = document.getElementById('status').value;

      // Validasi sederhana
      if(!nama || !jenis || !harga || !status) {
        alert('Semua field harus diisi!');
        return;
      }

      if(editIndex === null) {
        // Tambah data baru
        dataLapangan.push({ nama, jenis, harga, status });
        alert('Data lapangan berhasil ditambahkan!');
      } else {
        alert('Edit aktif, gunakan tombol Update untuk menyimpan perubahan.');
      }

      renderTable();
      resetForm();
    });

    // Update data yang diedit
    btnUpdate.addEventListener('click', () => {
      if(editIndex === null) return alert('Tidak ada data yang sedang diedit!');

      const nama = document.getElementById('nama').value.trim();
      const jenis = document.getElementById('jenis').value;
      const harga = document.getElementById('harga').value;
      const status = document.getElementById('status').value;

      if(!nama || !jenis || !harga || !status) {
        alert('Semua field harus diisi!');
        return;
      }

      dataLapangan[editIndex] = { nama, jenis, harga, status };
      alert('Data lapangan berhasil diperbarui!');

      renderTable();
      resetForm();
    });

    // Batalkan edit
    btnBatal.addEventListener('click', () => {
      resetForm();
    });

    // Awal render
    renderTable();
  </script>

</body>
</html>
