<?php
require_once '../config.php';
requireAdmin();

// Fetch all coaches
$stmt = $pdo->query("SELECT * FROM coaches ORDER BY name");
$coaches = $stmt->fetchAll();

// Handle errors from process pages
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Coaches - Admin</title>
    <link rel="stylesheet" href="../Home.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/admin-modals.js" defer></script>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="../index.php"><img src="../Gambar/Header Foto/logo.png" alt="Logo" /></a>
        </div>
        <div class="search-bar">
            <img src="../Gambar/Header Foto/Search.png" alt="Search" />
            <input type="text" placeholder="Search..." />
        </div>
        <div class="lgokanan">
            <a href="../logout.php"><img src="../Gambar/Header Foto/User.png" alt="Logout" /></a>
        </div>
    </header>
    <hr style="margin-top: 20px" />
    <!-- Navbar -->
    <nav>
        <a href="../index.php">Home</a>
        <a href="../pages/courts.php">Courts</a>
        <a href="../pages/coaches.php">Coaches</a>
        <a href="dashboard.php">Admin</a>
    </nav>

    <div class="Lokasi">
        <h2>Manage Coaches</h2>
    </div>

    <div class="container">
        <div class="content">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <button class="btn btn-primary" style="margin-bottom:30px;" onclick="openAddModal()">Add New Coach</button>

            <!-- <div class="grid">
                <?php foreach ($coaches as $coach): ?>
                    <div class="coach-card">
                        <img src="../<?= htmlspecialchars($coach['image_path']) ?>" alt="<?= htmlspecialchars($coach['name']) ?>" />
                        <div class="coach-info">
                            <h4><?= htmlspecialchars($coach['name']) ?></h4>
                            <p><strong>Specialty:</strong> <?= htmlspecialchars($coach['specialty']) ?></p>
                            <p><strong>Price:</strong> Rp<?= number_format($coach['price'], 0, ',', '.') ?>/sesi</p>
                            <p><strong>Description:</strong> <?= htmlspecialchars(substr($coach['description'], 0, 100)) ?>...</p>
                            <button class="btn btn-secondary" onclick="openEditModal(<?= $coach['id'] ?>, '<?= htmlspecialchars($coach['name']) ?>', '<?= htmlspecialchars($coach['specialty']) ?>', <?= $coach['price'] ?>, '<?= htmlspecialchars($coach['image_path']) ?>', '<?= htmlspecialchars($coach['description']) ?>')">Edit</button>
                            <button class="btn btn-secondary" onclick="openTimesModal(<?= $coach['id'] ?>, '<?= htmlspecialchars($coach['name']) ?>')">Manage Times</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> -->

            <div class="grids" style="
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px; /* Jarak 30px antar baris dan kolom */
">
                <?php foreach ($coaches as $coach): ?>
                    <div class="cards" style="justify-self: center; width:300px; display: flex; justify-content: center;">
                        <img style="height:90%;" src="../<?= htmlspecialchars($coach['image_path']) ?>"
                            alt="<?= htmlspecialchars($coach['name']) ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Add Coach Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('addModal')">&times;</span>
            <h3>Add New Coach</h3>
            <form method="POST" action="../process/add_coach.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="specialty">Specialty:</label>
                    <input type="text" id="specialty" name="specialty">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="image_path">Image Path:</label>
                    <input type="text" id="image_path" name="image_path" placeholder="e.g. Gambar/Coach/coach.jpg">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Coach</button>
            </form>
        </div>
    </div>

    <!-- Edit Coach Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('editModal')">&times;</span>
            <h3>Edit Coach</h3>
            <form method="POST" action="../process/edit_coach.php">
                <input type="hidden" id="edit_coach_id" name="coach_id">
                <div class="form-group">
                    <label for="edit_name">Name:</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit_specialty">Specialty:</label>
                    <input type="text" id="edit_specialty" name="specialty">
                </div>
                <div class="form-group">
                    <label for="edit_price">Price:</label>
                    <input type="number" id="edit_price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="edit_image_path">Image Path:</label>
                    <input type="text" id="edit_image_path" name="image_path">
                </div>
                <div class="form-group">
                    <label for="edit_description">Description:</label>
                    <textarea id="edit_description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Coach</button>
            </form>
        </div>
    </div>

    <!-- Manage Times Modal -->
    <div id="timesModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('timesModal')">&times;</span>
            <h3 id="timesModalTitle">Manage Time Slots</h3>
            <div id="timesContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function openEditModal(id, name, specialty, price, imagePath, description) {
            document.getElementById('edit_coach_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_specialty').value = specialty;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_image_path').value = imagePath;
            document.getElementById('edit_description').value = description;
            document.getElementById('editModal').style.display = 'block';
        }

        function openTimesModal(coachId, coachName) {
            document.getElementById('timesModalTitle').textContent = `Manage Time Slots for ${coachName}`;
            document.getElementById('timesContent').innerHTML = '<p>Loading...</p>';
            document.getElementById('timesModal').style.display = 'block';

            // Load time slots via AJAX
            fetch(`../process/get_coach_times.php?coach_id=${coachId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('timesContent').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('timesContent').innerHTML = '<p>Error loading time slots.</p>';
                });
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>

</html>