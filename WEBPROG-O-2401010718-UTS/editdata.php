<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Edit Data Lapangan</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    label { display: block; margin-top: 10px; }
    input, select { width: 250px; padding: 5px; margin-top: 5px; }
    button { margin-top: 15px; padding: 7px 20px; }
  </style>
</head>
<body>

  <h2>Edit Data Lapangan</h2>

  <form id="formEditLapangan">
    <label>Nama Lapangan:
      <input type="text" id="nama" required />
    </label>

    <label>Jenis Lapangan:
      <select id="jenis" required>
        <option value="Futsal">Futsal</option>
        <option value="Basket">Basket</option>
        <option value="Badminton">Badminton</option>
        <option value="Tenis">Tenis</option>
      </select>
    </label>

    <label>Harga per Jam (Rp):
      <input type="number" id="harga" min="0" required />
    </label>

    <label>Status:
      <select id="status" required>
        <option value="Tersedia">Tersedia</option>
        <option value="Tidak Tersedia">Tidak Tersedia</option>
      </select>
    </label>

    <button type="submit">Update</button>
    <button type="submit">Simpan</button>
  </form>

  <script>
    const dataLapangan = {
      nama: "Lapangan A",
      jenis: "Futsal",
      harga: 120000,
      status: "Tersedia"
    };


    function loadDataToForm(data) {
      document.getElementById('nama').value = data.nama;
      document.getElementById('jenis').value = data.jenis;
      document.getElementById('harga').value = data.harga;
      document.getElementById('status').value = data.status;
    }

    loadDataToForm(dataLapangan);

    const form = document.getElementById('formEditLapangan');
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const updatedData = {
        nama: document.getElementById('nama').value.trim(),
        jenis: document.getElementById('jenis').value,
        harga: document.getElementById('harga').value,
        status: document.getElementById('status').value
      };

      alert(`Data telah diperbarui:\nNama: ${updatedData.nama}\nJenis: ${updatedData.jenis}\nHarga: Rp${updatedData.harga}\nStatus: ${updatedData.status}`);


      console.log('Data terbaru:', updatedData);
      console.log('Data terbaru:', simpanData);
    });
    
  </script>

</body>
</html>