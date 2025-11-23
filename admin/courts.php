<?php
require_once '../config.php';
requireAdmin();

// Fetch all courts
$stmt = $pdo->query("SELECT * FROM courts ORDER BY name");
$courts = $stmt->fetchAll();

// Handle errors from process pages
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courts - Admin</title>
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
        <h2>Manage Courts</h2>
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

            <button class="btn btn-primary" onclick="openAddModal()">Add New Court</button>

            <div class="grid">
                <?php foreach ($courts as $court): ?>
                    <div class="card">
                        <img src="../<?= htmlspecialchars($court['image_path']) ?>" alt="<?= htmlspecialchars($court['name']) ?>" />
                        <div class="info">
                            <p><strong><?= htmlspecialchars($court['name']) ?></strong></p>
                            <p><?= htmlspecialchars($court['location']) ?></p>
                            <p>Rp<?= number_format($court['price'], 0, ',', '.') ?>/sesi</p>
                            <button class="btn btn-secondary" onclick="openEditModal(<?= $court['id'] ?>, '<?= htmlspecialchars($court['name']) ?>', '<?= htmlspecialchars($court['location']) ?>', <?= $court['price'] ?>, '<?= htmlspecialchars($court['image_path']) ?>', '<?= htmlspecialchars($court['description']) ?>')">Edit</button>
                            <button class="btn btn-danger" onclick="openTimesModal(<?= $court['id'] ?>, '<?= htmlspecialchars($court['name']) ?>')">Manage Times</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Add Court Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('addModal')">&times;</span>
            <h3>Add New Court</h3>
            <form method="POST" action="../process/add_court.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="image_path">Image Path:</label>
                    <input type="text" id="image_path" name="image_path" placeholder="e.g. Gambar/Lapangan/court.jpg">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Court</button>
            </form>
        </div>
    </div>

    <!-- Edit Court Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('editModal')">&times;</span>
            <h3>Edit Court</h3>
            <form method="POST" action="../process/edit_court.php">
                <input type="hidden" id="edit_court_id" name="court_id">
                <div class="form-group">
                    <label for="edit_name">Name:</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit_location">Location:</label>
                    <input type="text" id="edit_location" name="location" required>
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
                <button type="submit" class="btn btn-primary">Update Court</button>
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

        function openEditModal(id, name, location, price, imagePath, description) {
            document.getElementById('edit_court_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_location').value = location;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_image_path').value = imagePath;
            document.getElementById('edit_description').value = description;
            document.getElementById('editModal').style.display = 'block';
        }

        function openTimesModal(courtId, courtName) {
            document.getElementById('timesModalTitle').textContent = `Manage Time Slots for ${courtName}`;
            document.getElementById('timesContent').innerHTML = '<p>Loading...</p>';
            document.getElementById('timesModal').style.display = 'block';

            // Load time slots via AJAX (simplified - in real app, use fetch API)
            fetch(`../process/get_court_times.php?court_id=${courtId}`)
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
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>
