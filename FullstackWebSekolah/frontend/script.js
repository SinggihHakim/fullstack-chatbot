


window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 40) {
        navbar.classList.add('scrolled'); // Tambahkan kelas 'scrolled' saat discroll
    } else {
        navbar.classList.remove('scrolled'); // Hapus kelas 'scrolled' jika kembali ke atas
    }
});



const apiKey = "AIzaSyBSb-cAzfeD1phSFTb3VyubYlv6HlLoe_c"; // Ganti dengan API key Anda

let booksData = []; // Tempat menyimpan buku yang diambil dari API

// Fungsi untuk mencari buku dari API Google Books
function searchBooks() {
  const query = document.getElementById("searchInput").value.toLowerCase();
  const sortOrder = document.getElementById("sortOrder").value; // Ambil nilai dari dropdown
  const url = `https://www.googleapis.com/books/v1/volumes?q=${query}&key=${apiKey}`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      const booksData = data.items || [];
      const filteredBooks = linearSearchBooks(booksData, query); // Pencarian menggunakan linear search
      const sortedBooks = mergeSortBooks(filteredBooks, sortOrder); // Pengurutan menggunakan Merge Sort
      renderBooks(sortedBooks);
    })
    .catch((error) => console.error("Error:", error));
}

// Fungsi Linear Search
function linearSearchBooks(bookArray, query) {
  return bookArray.filter((book) => {
    const bookInfo = book.volumeInfo;
    return (
      bookInfo.title?.toLowerCase().includes(query) || // Cari di judul
      bookInfo.authors?.some((author) => author.toLowerCase().includes(query)) || // Cari di penulis
      bookInfo.description?.toLowerCase().includes(query) // Cari di deskripsi
    );
  });
}

// Fungsi Merge Sort (Divide and Conquer)
function mergeSortBooks(bookArray, sortOrder) {

  if (bookArray.length <= 1) return bookArray;

  const mid = Math.floor(bookArray.length / 2);
  const left = mergeSortBooks(bookArray.slice(0, mid), sortOrder);
  const right = mergeSortBooks(bookArray.slice(mid), sortOrder);

  return merge(left, right, sortOrder);
}

// Fungsi untuk menggabungkan dua array dalam Merge Sort
function merge(left, right, sortOrder) {
  let result = [];
  while (left.length && right.length) {
    const bookA = left[0].volumeInfo;
    const bookB = right[0].volumeInfo;

    let comparison = 0;
    switch (sortOrder) {
      case "az":
        comparison = bookA.title.localeCompare(bookB.title); // A-Z
        break;
      case "za":
        comparison = bookB.title.localeCompare(bookA.title); // Z-A
        break;
      case "newest":
        comparison = new Date(bookB.publishedDate) - new Date(bookA.publishedDate); // Terbaru
        break;
      case "oldest":
        comparison = new Date(bookA.publishedDate) - new Date(bookB.publishedDate); // Terlama
        break;
      default:
        comparison = 0; // Tidak ada pengurutan
    }

    if (comparison <= 0) {
      result.push(left.shift());
    } else {
      result.push(right.shift());
    }
  }

  return result.concat(left, right);
}

// Fungsi untuk menampilkan daftar buku
function renderBooks(bookArray) {
  const bookList = document.getElementById("bookList");
  bookList.innerHTML = ""; // Hapus daftar buku sebelumnya

  bookArray.forEach((book) => {
    const bookInfo = book.volumeInfo;
    const bookItem = document.createElement("div");
    bookItem.className = "col mb-4"; // Menggunakan col untuk setiap buku
    bookItem.innerHTML = `
      <a href="${bookInfo.infoLink}" target="_blank" class="text-decoration-none">
        <div class="card h-100">
          <img src="${bookInfo.imageLinks?.thumbnail || 'https://via.placeholder.com/150'}" class="card-img-top" alt="${bookInfo.title}" style="max-width: 100%; height: auto;" />
          <div class="card-body">
            <h5 class="card-title">${bookInfo.title}</h5>
            <p><strong>Penulis:</strong> ${bookInfo.authors?.join(", ") || "Tidak tersedia"}</p>
            <p><strong>Tahun Terbit:</strong> ${bookInfo.publishedDate || "Tidak tersedia"}</p>
            <p><strong>Deskripsi:</strong> ${bookInfo.description ? bookInfo.description.substring(0, 150) + "..." : "Tidak tersedia"}</p>
          </div>
        </div>
      </a>
    `;
    bookList.appendChild(bookItem);
  });
}




let borrowData = JSON.parse(localStorage.getItem('borrowData')) || []; // Ambil data peminjaman dari localStorage atau set ke array kosong
const borrowForm = document.getElementById('borrowForm');
const borrowList = document.getElementById('borrowList');
const submitButton = borrowForm.querySelector('button[type="submit"]');

// Simpan data ke localStorage
function saveToLocalStorage() {
  localStorage.setItem('borrowData', JSON.stringify(borrowData));
}

// Tambah Peminjaman
borrowForm.addEventListener('submit', function (e) {
  e.preventDefault();
  
  const nama = document.getElementById('nama').value.trim();
  const kelas = document.getElementById('kelas').value.trim();
  const nisn = document.getElementById('nisn').value.trim();
  
  if (nama && kelas && nisn) {
    const today = new Date();
    const returnDate = new Date();
    returnDate.setDate(today.getDate() + 7); // Pengembalian dalam 7 hari

    const peminjaman = formatDate(today);
    const pengembalian = formatDate(returnDate);

    // Tambahkan data peminjaman ke dalam array
    borrowData.push({ nama, kelas, nisn, peminjaman, pengembalian });
    
    saveToLocalStorage(); // Simpan data ke localStorage
    renderBorrowList(); // Update daftar peminjaman
    borrowForm.reset(); // Reset form
  } else {
    alert("Semua data harus diisi!");
  }
});

// Render daftar peminjaman
function renderBorrowList() {
  borrowList.innerHTML = ''; // Clear daftar peminjaman

  borrowData.forEach((item, index) => {
    borrowList.innerHTML += `
      <tr>
        <td>${index + 1}</td>
        <td>${item.nama}</td>
        <td>${item.kelas}</td>
        <td>${item.nisn}</td>
        <td>${item.peminjaman}</td>
        <td>${item.pengembalian}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick="editBorrow(${index})">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteBorrow(${index})">Hapus</button>
        </td>
      </tr>
    `;
  });
}

// Format tanggal ke DD/MM/YYYY
function formatDate(date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

// Edit data peminjaman
function editBorrow(index) {
  const item = borrowData[index];
  document.getElementById('nama').value = item.nama;
  document.getElementById('kelas').value = item.kelas;
  document.getElementById('nisn').value = item.nisn;

  // Ubah tombol submit menjadi "Simpan Perubahan"
  submitButton.textContent = "Simpan Perubahan";
  submitButton.onclick = function() {
    saveChanges(index);
  };
}

// Simpan perubahan data peminjaman
function saveChanges(index) {
  const nama = document.getElementById('nama').value.trim();
  const kelas = document.getElementById('kelas').value.trim();
  const nisn = document.getElementById('nisn').value.trim();
  
  if (nama && kelas && nisn) {
    borrowData[index] = { ...borrowData[index], nama, kelas, nisn }; // Update data
    saveToLocalStorage(); // Simpan ke localStorage
    renderBorrowList(); // Update daftar peminjaman
    borrowForm.reset(); // Reset form
    submitButton.textContent = "Tambah Peminjaman"; // Reset tombol
    submitButton.onclick = function() {
      borrowForm.submit();
    };
  } else {
    alert("Semua data harus diisi!");
  }
}

// Hapus data peminjaman
function deleteBorrow(index) {
  borrowData.splice(index, 1); // Hapus data dari array
  saveToLocalStorage(); // Perbarui localStorage
  renderBorrowList(); // Update daftar peminjaman
}

// Render daftar peminjaman yang disimpan di localStorage saat halaman dimuat
renderBorrowList();

