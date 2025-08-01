// Smooth scroll only for internal links (starts with "#")
document.querySelectorAll('nav a').forEach(link => {
  link.addEventListener('click', e => {
    const href = link.getAttribute('href');
    if (href.startsWith("#")) {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }
  });
});


window.addEventListener('DOMContentLoaded', () => {
  const paketDipilih = localStorage.getItem('paketDipilih');
  if (paketDipilih) {
    const inputPaket = document.getElementById('paketDipilih');
    if (inputPaket) inputPaket.value = paketDipilih;
  }
});

const bookingForm = document.getElementById('bookingForm');
if (bookingForm) {
  bookingForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const data = new FormData(bookingForm);
    const status = document.getElementById('bookingStatus');

    fetch('https://script.google.com/macros/s/AKfycbyUlZqTqa8zSjg_jKU7C5MbP2s7vUvxHd3iMavxG8HB5Q2BpKbGz_6rLdL0mtxHSd-P7w/exec', {
      method: 'POST',
      body: data
    })
    .then(res => res.text())
    .then(result => {
      status.textContent = '✅ Data berhasil dikirim!';
      bookingForm.reset();
      localStorage.removeItem('paketDipilih');
    })
    .catch(err => {
      status.textContent = '❌ Gagal mengirim. Coba lagi nanti.';
      console.error(err);
    });
  });
}

function bukaModal(namaPaket) {
  document.getElementById('modalPaketNama').innerText = namaPaket;
  const modal = new bootstrap.Modal(document.getElementById('modalPaket'));
  modal.show();
}

function isiBookingPaket() {
  const input = document.getElementById('paketDipilih');
  input.value = document.getElementById('modalPaketNama').innerText;
}

document.getElementById("notifLogin").textContent = "Login gagal. Coba lagi.";
document.getElementById("loginBtn").textContent = "Memproses...";
setTimeout(() => {
  document.getElementById("loginBtn").textContent = "Masuk";
}, 2000);
function loginUser(event) {
  event.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (email === "baraganteng@gmail.com" && password === "123456") {
    localStorage.setItem("login", "true");
    localStorage.setItem("role", "admin");
    window.location.href = "admin/dashboard.html";
    return;
  }

  if (email === "mukhlis@gmail.com" && password === "123456") {
    localStorage.setItem("login", "true");
    localStorage.setItem("nama", "Ahmad Fauzi");
    localStorage.setItem("role", "jamaah");
    window.location.href = "dashboard.html";
    return;
  }

  alert("Email atau password salah!");
}
