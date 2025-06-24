const app = document.getElementById("app");

const routes = {
  "/dashboard": "views/dashboard.html",
  "/pasien": "views/pasien-list.html",
};

function router() {
  const hash = location.hash.slice(1) || "/dashboard";
  const viewPath = routes[hash] || "views/404.html";
  fetch(viewPath)
    .then((res) => res.text())
    .then((html) => {
      app.innerHTML = html;

      // Load logic per halaman
      if (hash === "/pasien") {
        loadPasien();
      }
    });
}

window.addEventListener("load", router);
window.addEventListener("hashchange", router);

// Loader untuk daftar pasien
function loadPasien() {
  fetch("api/pasien.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("#tablePasien tbody");
      tbody.innerHTML = data
        .map(
          (row) => `
        <tr>
          <td>${row.id}</td>
          <td>${row.nama_lengkap}</td>
          <td>${row.username}</td>
          <td>${row.alamat}</td>
          <td>${row.tanggal_lahir}</td>
          <td><a href="#/pasien/${row.user_id}">Detail</a></td>
        </tr>
      `
        )
        .join("");
    });
}
