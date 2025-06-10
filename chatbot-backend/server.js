// server.js

const express = require('express');
const cors = require('cors');
const { GoogleGenerativeAI } = require('@google/generative-ai');
require('dotenv').config(); // Memuat environment variables dari file .env

// Inisialisasi Aplikasi Express
const app = express();
const port = 5000; // Server akan berjalan di port 5000

// Middleware
app.use(cors()); // Mengizinkan koneksi dari semua domain (penting agar front-end bisa akses)
app.use(express.json()); // Memungkinkan server membaca request body dalam format JSON

// --- KONFIGURASI GOOGLE GEMINI API ---
const apiKey = process.env.GOOGLE_API_KEY;
if (!apiKey) {
    console.error("Error: Pastikan GOOGLE_API_KEY sudah diatur di file .env");
    process.exit(1);
}
const genAI = new GoogleGenerativeAI(apiKey);
// Kode Anda yang baru dan sudah diperbaiki
const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash-latest" });

// --- KEPRIBADIAN & PENGETAHUAN CHATBOT ---
const CHATBOT_PERSONA = `
Kamu adalah "Sahabat Cerdas SD Negeri 1 Pematang Baru". 
Tugasmu adalah menjawab pertanyaan dari Bapak, Ibu, atau calon siswa baru dengan bahasa yang ramah, sopan, dan mudah dimengerti.

Gunakan informasi berikut sebagai basis pengetahuanmu:
- Nama Sekolah: SD Negeri 1 Pematang Baru
- Alamat: Jalan Pematang Binjai, Pematang Baru, Kec. Palas, Kabupaten Lampung Selatan, Lampung 35594
- Jam Operasional Kantor: Senin-Jumat, 08:00 - 14:00 WIB
- Pendaftaran Peserta Didik Baru (PPDB): Dibuka setiap tanggal 1 Juni - 15 Juli.
- Syarat Pendaftaran: Fotokopi Akta Kelahiran, Fotokopi Kartu Keluarga (KK), dan mengisi formulir pendaftaran yang disediakan di sekolah. Usia minimal 6 tahun pada bulan Juli.
- Biaya Formulir: Gratis.
- Ekstrakurikuler: Pramuka Siaga, Menggambar dan Mewarnai, Menari, dan Dokter Kecil (UKS).
- Fasilitas: Ruang kelas yang nyaman, perpustakaan, lapangan olahraga, dan UKS.
- Kontak: Untuk pertanyaan lebih lanjut, Bapak/Ibu bisa menghubungi kantor administrasi kami langsung di sekolah.
- 

Jika ada pertanyaan di luar konteks sekolah atau kamu tidak tahu jawabannya, jawab dengan sopan: "Mohon maaf, saya hanya bisa menjawab pertanyaan seputar SD Negeri 1 Pematang Baru ya. Untuk informasi lebih lanjut, Bapak/Ibu bisa menghubungi kantor administrasi kami langsung di sekolah."
`;


// Fungsi untuk memulai sesi chat dengan 'kepribadian' yang sudah ditentukan
async function initializeChat() {
    const chat = model.startChat({
        history: [
            { role: 'user', parts: [{ text: CHATBOT_PERSONA }] },
            { role: 'model', parts: [{ text: "Tentu, saya adalah Asisten Cerdas SMA Harapan Bangsa. Ada yang bisa saya bantu?" }] }
        ]
    });
    return chat;
}

let chatSession;
initializeChat().then(chat => {
    chatSession = chat;
    console.log("✅ Sesi chat dengan AI berhasil dimulai.");
});

// --- API ENDPOINT UNTUK CHAT ---
// Ini adalah alamat yang akan dipanggil oleh front-end Anda
app.post('/chat', async (req, res) => {
    if (!chatSession) {
        return res.status(503).json({ error: "Sesi chat belum siap, silakan coba lagi sesaat." });
    }

    try {
        const userMessage = req.body.message;
        if (!userMessage) {
            return res.status(400).json({ error: "Pesan tidak boleh kosong" });
        }

        // Kirim pesan ke Gemini dan dapatkan hasilnya
        const result = await chatSession.sendMessage(userMessage);
        const response = await result.response;
        const text = response.text();

        // Kirim balasan dari AI ke front-end
        res.json({ reply: text });

    } catch (error) {
        console.error("Error saat berkomunikasi dengan AI:", error);
        res.status(500).json({ error: "Terjadi kesalahan pada server AI." });
    }
});


// --- MENJALANKAN SERVER ---
app.listen(port, () => {
    console.log(`🚀 Server back-end AI berjalan di http://localhost:${port}`);
    console.log("   (Biarkan terminal ini tetap terbuka selama chatbot digunakan)");
});