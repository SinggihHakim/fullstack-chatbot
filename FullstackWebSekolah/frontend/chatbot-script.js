// File: chatbot-script.js

document.addEventListener("DOMContentLoaded", () => {

    // --- BAGIAN 1: LOGIKA UNTUK MEMBUKA & MENUTUP POPUP CHATBOT ---
    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const closeBtn = document.querySelector(".close-btn");
    const body = document.querySelector("body");

    // Cek apakah elemen-elemen ini ada di halaman yang sedang dibuka
    if (chatbotToggler && closeBtn && body) {
        // Event listener untuk ikon chat yang melayang
        chatbotToggler.addEventListener("click", () => {
            // Menambah atau menghapus class 'show-chatbot' pada body
            // CSS akan menangani animasi muncul/hilangnya popup
            body.classList.toggle("show-chatbot");
        });

        // Event listener untuk tombol 'X' di dalam popup
        closeBtn.addEventListener("click", () => {
            // Selalu menghapus class 'show-chatbot' untuk menutup popup
            body.classList.remove("show-chatbot");
        });
    }

    // --- BAGIAN 2: LOGIKA UNTUK MENGIRIM & MENERIMA PESAN CHAT ---
    const chatBox = document.getElementById("chat-box");
    const userInput = document.getElementById("user-input");
    const sendBtn = document.getElementById("send-btn");

    // Cek apakah elemen-elemen chatbox ada di halaman ini
    if (chatBox && userInput && sendBtn) {

        // Fungsi untuk menambahkan pesan ke tampilan chat
        const addMessage = (text, className) => {
            const messageDiv = document.createElement("div");
            messageDiv.className = `message ${className}`;
            const p = document.createElement("p");
            p.innerHTML = text; // innerHTML agar bisa merender animasi loading
            messageDiv.appendChild(p);
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Otomatis scroll ke bawah
            return messageDiv; // Kembalikan elemen untuk referensi (penting untuk hapus loading)
        };

        // Fungsi untuk mengirim pesan ke server back-end
        const sendMessage = async () => {
            const userMessage = userInput.value.trim();
            if (userMessage === "") return; // Jangan kirim jika kosong

            // 1. Tampilkan pesan pengguna di chat
            addMessage(userMessage, "user-message");
            userInput.value = ""; // Kosongkan input field

            // 2. Tampilkan animasi "sedang mengetik..."
            const loadingIndicator = addMessage("<span></span><span></span><span></span>", "ai-message loading-message");

            // 3. Kirim permintaan ke server
            try {
                const response = await fetch("http://127.0.0.1:5000/chat", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ message: userMessage }),
                });

                // 4. Hapus animasi loading
                chatBox.removeChild(loadingIndicator);

                if (!response.ok) {
                    throw new Error("Gagal menghubungi server AI.");
                }

                // 5. Tampilkan balasan dari AI
                const data = await response.json();
                addMessage(data.reply, "ai-message");

            } catch (error) {
                console.error("Error:", error);
                // Hapus juga loading jika error
                if(document.body.contains(loadingIndicator)) {
                    chatBox.removeChild(loadingIndicator);
                }
                addMessage("Maaf, koneksi sedang bermasalah. Coba lagi nanti.", "ai-message");
            }
        };

        // Tambahkan event listener untuk tombol kirim dan tombol Enter
        sendBtn.addEventListener("click", sendMessage);
        userInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                sendMessage();
            }
        });
    }
});