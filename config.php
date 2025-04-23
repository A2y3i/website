<!-- index.html -->
<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ระบบค้นหาหนังสือ</title>
    <style>
      body {
          font-family: 'Kanit', sans-serif;
      }
      .card-header {
          background-color: #004e92;
          color: white;
      }
      .card-body {
          background-color: #f9f9f9;
      }
      .card-title {
          color: #004e92;
      }
    </style>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-sm ps-3 pe-3">
        <a class="navbar-brand" href="#">ห้องสมุดและพิพิธภัณฑ์เสรีไทยอนุสรณ์</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!-- หน้า Page -->
    <div class="container my-5">
      <h2>ระบบค้นหาข้อมูลห้องสมุด</h2>
      
      <!-- Search Bar -->
      <div class="mb-3">
          <input type="text" class="form-control" id="searchInput" placeholder="ค้นหาหนังสือ..." onkeyup="searchData()">
      </div>

      <!-- Results -->
      <div id="results" class="row row-cols-1 row-cols-md-3 g-4">
          <!-- ผลลัพธ์การค้นหาจะแสดงที่นี่ -->
      </div>
    </div>

    <footer class="bg-dark text-white text-center py-4">
      <p>&copy; 2025 ห้องสมุดเสรีไทยอนุสรณ์. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // ฟังก์ชันสำหรับค้นหาข้อมูล
      function searchData() {
          let input = document.getElementById('searchInput').value.toLowerCase();
          let resultsContainer = document.getElementById('results');
          resultsContainer.innerHTML = '';  // Clear previous results

          if (input.length > 0) {
              // ส่งคำค้นหาผ่าน AJAX ไปยัง PHP
              fetch(`search_books.php?search=${input}`)
                  .then(response => response.json())
                  .then(data => {
                      if (data.length === 0) {
                          resultsContainer.innerHTML = '<div class="col-12"><p>ไม่พบข้อมูลที่ค้นหา</p></div>';
                      } else {
                          data.forEach(item => {
                              const card = document.createElement('div');
                              card.classList.add('col');
                              card.innerHTML = `
                                  <div class="card h-100">
                                      <img src="${item.imageUrl}" class="card-img-top" alt="${item.title}">
                                      <div class="card-body">
                                          <h5 class="card-title">${item.title}</h5>
                                          <p class="card-text">${item.description}</p>
                                          <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
                                      </div>
                                  </div>
                              `;
                              resultsContainer.appendChild(card);
                          });
                      }
                  })
                  .catch(error => {
                      console.error('Error fetching data:', error);
                  });
          }
      }
    </script>
  </body>
</html>

