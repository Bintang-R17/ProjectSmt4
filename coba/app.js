const app = document.getElementById("app");

const routes = {
  "/dashboard": "views/dashboard.html",
  "/pasien": "views/pasien-list.html",
};

async function loadView(viewPath) {
  const res = await fetch(viewPath);
  const html = await res.text();
  app.innerHTML = html;
}

function getRoute() {
  const hash = location.hash.slice(1) || "/dashboard";

  // handle dynamic route: /pasien/12 or /pasien/12/hasil-lab
  if (/^\/pasien\/\d+\/hasil-lab$/.test(hash)) {
    return { path: "views/hasil-lab.html", dynamic: true };
  }
  if (/^\/pasien\/\d+$/.test(hash)) {
    return { path: "views/pasien-detail.html", dynamic: true };
  }

  return { path: routes[hash] || "views/404.html", dynamic: false };
}

window.addEventListener("hashchange", async () => {
  const { path } = getRoute();
  await loadView(path);
});
window.addEventListener("load", async () => {
  const { path } = getRoute();
  await loadView(path);
});
