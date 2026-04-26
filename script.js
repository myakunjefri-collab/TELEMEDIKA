function updateClock() {
    const clockElement = document.getElementById('clock');
    if (clockElement) {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        clockElement.textContent = `${hours}:${minutes}:${seconds}`;
    }
}

function setGreeting() {
    const greetingElement = document.getElementById('greeting');
    const navGreeting = document.getElementById('nav-greeting');
    if (greetingElement) {
        const hour = new Date().getHours();
        let greet;
        
        if (hour < 12) greet = "Selamat Pagi ☀️";
        else if (hour < 15) greet = "Selamat Siang 🌤️";
        else if (hour < 18) greet = "Selamat Sore 🌅";
        else greet = "Selamat Malam 🌙";
        
        greetingElement.textContent = greet;
        if (navGreeting) navGreeting.textContent = greet;
    }
}

const quotes = [
    "Tidak peduli bagaimana kerasnya kehidupan yang kamu miliki di masa lalu, kamu selalu bisa memulainya kembali.",
    "Berjalanlah jangan berlari, karena hidup adalah perjalanan dan bukannya pelarian.",
    "Tidak peduli hal apapun yang kamu alami, selalu ada cahaya diujung terowongan.",
    "Tidak ada yang tidak mungkin. Batasan hanya ada dalam pikiran kita.",
    "Jangan biarkan masa lalu mencuri kebahagiaanmu saat ini."
];

function setRandomQuote() {
    const quoteElement = document.getElementById('quote-container');
    if (quoteElement) {
        const randomIndex = Math.floor(Math.random() * quotes.length);
        quoteElement.textContent = `"${quotes[randomIndex]}"`;
    }
}

function initDarkMode() {
    const darkModeBtn = document.getElementById('toggle-dark');
    if(!darkModeBtn) return; 

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        darkModeBtn.textContent = '☀️ Light Mode';
    }

    darkModeBtn.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            darkModeBtn.textContent = '☀️ Light Mode';
        } else {
            localStorage.setItem('theme', 'light');
            darkModeBtn.textContent = '🌙 Dark Mode';
        }
    });
}

function initLogoutModal() {
    const navLogoutBtn = document.querySelector('a[href="/api/logout"]'); 
    const modalOverlay = document.getElementById('logout-modal');
    const btnCancel = document.getElementById('btn-cancel');

    if (navLogoutBtn && modalOverlay) {
        navLogoutBtn.addEventListener('click', function(e) {
            e.preventDefault(); 
            modalOverlay.classList.add('show'); 
        });
    }

    if (btnCancel && modalOverlay) {
        btnCancel.addEventListener('click', function() {
            modalOverlay.classList.remove('show');
        });
    }

    if(modalOverlay) {
        window.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('show');
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    updateClock();
    setGreeting();
    setRandomQuote();
    initDarkMode();
    initLogoutModal();

    setInterval(updateClock, 1000);
});

function validateForm() {
    const inputUsername = document.getElementById('username');
    const inputEmail = document.getElementById('email');
    const inputPassword = document.getElementById('password');

    if (inputUsername) {
        if (inputUsername.value.trim() === "") {
            alert("⚠️ Username tidak boleh kosong!");
            inputUsername.focus(); 
            return false; 
        }
        if (inputUsername.value.length < 3) {
            alert("⚠️ Username terlalu pendek, minimal 3 huruf.");
            inputUsername.focus();
            return false;
        }
    }

    if (inputEmail) {
        const emailValue = inputEmail.value.trim();
        if (emailValue === "") {
            alert("⚠️ Alamat Email tidak boleh kosong!");
            inputEmail.focus();
            return false;
        }
        if (!emailValue.includes('@') || !emailValue.includes('.')) {
            alert("⚠️ Format email tidak valid! Pastikan penulisan benar (contoh: pasien@email.com).");
            inputEmail.focus();
            return false;
        }
    }

    if (inputPassword) {
        if (inputPassword.value.trim() === "") {
            alert("⚠️ Password tidak boleh kosong!");
            inputPassword.focus();
            return false;
        }
        
        if (inputEmail && inputPassword.value.length < 6) { 
            alert("⚠️ Demi keamanan, password minimal harus 6 karakter!");
            inputPassword.focus();
            return false;
        }
    }

    return true; 
}