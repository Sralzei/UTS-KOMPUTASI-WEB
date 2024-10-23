<?php 
include 'config.php'; // Menghubungkan file konfigurasi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - Portofolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="certificatestyle.css"> 
    
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="home.php">Portofolio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Me</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php">Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="header">
        <h1>Portofolio Sertifikat</h1>
        <p>Koleksi sertifikat yang saya miliki di bidang Informatika dan Kesehatan.</p>
    </header>

    <!-- Certificate Section 1: Informatika -->
    <div class="certificate-section container">
        <h2 class="certificate-title">Sertifikat Informatika</h2>
        <div class="certificate-gallery">
            <?php
            // Query untuk mengambil data sertifikat Informatika
            $sql = "SELECT title, image_path FROM certificates WHERE category = 'informatika'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()): ?>
                    <div class="certificate-item" data-toggle="modal" data-target="#certificateModal" data-img="<?php echo $row['image_path']; ?>">
                        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?>">
                    </div>
                <?php endwhile; 
            else: ?>
                <p class="text-center">Tidak ada sertifikat di bidang Informatika.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Certificate Section 2: Kesehatan -->
    <div class="certificate-section container">
        <h2 class="certificate-title">Sertifikat Kesehatan</h2>
        <div class="certificate-gallery">
            <?php
            // Query untuk mengambil data sertifikat Kesehatan
            $sql = "SELECT title, image_path FROM certificates WHERE category = 'kesehatan'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()): ?>
                    <div class="certificate-item" data-toggle="modal" data-target="#certificateModal" data-img="<?php echo $row['image_path']; ?>">
                        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?>">
                    </div>
                <?php endwhile; 
            else: ?>
                <p class="text-center">Tidak ada sertifikat di bidang Kesehatan.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for displaying enlarged certificate -->
    <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="certificateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="certificateModalLabel">Sertifikat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Sertifikat" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#certificateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var imageSrc = button.data('img'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('#modalImage').attr('src', imageSrc);
          
            document.addEventListener('DOMContentLoaded', function() {
            // Animasi Header
            const header = document.querySelector('.header');
            header.classList.add('visible'); // Menambahkan kelas visible untuk header
});

        });
    </script>
</body>
</html>

<?php
$conn->close(); // Menutup koneksi
?>
