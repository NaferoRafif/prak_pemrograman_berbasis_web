<form action="simpan.php" method="POST">
    <label for="npm">NPM:</label>
    <input type="text" name="npm" id="npm" required><br>

    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="prodi">Program Studi:</label>
    <input type="text" name="prodi" id="prodi" required><br>

    <label for="angkatan">Angkatan:</label>
    <input type="number" name="angkatan" id="angkatan" required><br>

    <label for="ipk">IPK:</label>
    <input type="number" step="0.01" name="ipk" id="ipk" required><br>

    <input type="submit" value="Simpan">
</form>