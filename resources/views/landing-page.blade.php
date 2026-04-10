 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">


 <style>
     .hero {
         background-color: #ffffff;
         color: #1f2937;
         min-height: 70vh;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         text-align: center;
         padding: 4rem 1rem;
     }

     .hero h1 {
         font-size: 3rem;
         font-weight: 700;
         margin-bottom: 1rem;
     }

     .hero p {
         font-size: 1.25rem;
         margin-bottom: 2rem;
         color: #4b5563;
     }

     .hero .btn-primary {
         font-size: 1.1rem;
         padding: 0.65rem 2rem;
         border-radius: 50px;
         transition: all 0.3s ease;
     }

     .hero .btn-primary:hover {
         transform: scale(1.05);
         box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
     }

     .info-cards {
         background-color: #f8fafc;
         padding: 4rem 1rem;
     }

     .card {
         border-radius: 15px;
         box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
         transition: transform 0.3s ease;
     }

     .card:hover {
         transform: translateY(-5px);
     }

     .modal-content {
         border-radius: 15px;
         overflow: hidden;
         box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
     }

     .modal-header {
         background-color: #0d6efd;
         color: white;
         border-bottom: none;
     }

     .modal-header .btn-close {
         filter: invert(1);
     }

     .modal-body form label {
         font-weight: 500;
     }

     .modal-body .btn-primary {
         background-color: #0d6efd;
         border-color: #0d6efd;
     }

     .modal-body .btn-primary:hover {
         background-color: #0b5ed7;
         border-color: #0b5ed7;
     }

     .footer {
         text-align: center;
         padding: 2rem 0;
         background-color: #f1f5f9;
         color: #6b7280;
     }
 </style>

 <div class="hero">
     <h1>Inventaris</h1>
     <p>Kelola data barang dengan mudah dan efisien</p>

     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
         Login
     </button>
 </div>

 <div class="info-cards container">
     <div class="row g-4">
         <div class="col-md-4">
             <div class="card p-4 text-center">
                 <h5 class="card-title">Kelola Barang</h5>
                 <p class="card-text">Tambah, edit, atau hapus data barang dengan mudah.</p>
             </div>
         </div>
         <div class="col-md-4">
             <div class="card p-4 text-center">
                 <h5 class="card-title">Laporan Cepat</h5>
                 <p class="card-text">Generate laporan inventaris dalam format PDF atau Excel.</p>
             </div>
         </div>
         <div class="col-md-4">
             <div class="card p-4 text-center">
                 <h5 class="card-title">User Friendly</h5>
                 <p class="card-text">Tampilan sederhana dan mudah digunakan untuk semua pengguna.</p>
             </div>
         </div>
     </div>
 </div>

 <div class="footer">
     &copy; 2026 InventarisApp. All rights reserved.
 </div>

 <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">

             <div class="modal-header">
                 <h5 class="modal-title">Login</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <div class="modal-body">
                 <form method="POST" action="{{ route('login') }}">
                     @csrf

                     <div class="mb-3">
                         <label class="form-label">Email</label>
                         <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                             required>
                     </div>

                     <div class="mb-3">
                         <label class="form-label">Password</label>
                         <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                             required>
                     </div>

                     <button type="submit" class="btn btn-primary w-100">
                         Login
                     </button>
                 </form>
             </div>

         </div>
     </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
