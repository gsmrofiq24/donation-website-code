<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

require_once 'db.php';
$conn->set_charset("utf8mb4");

$search = $_GET['search'] ?? '';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

$query = "SELECT * FROM donations WHERE 1=1";
$params = [];
$types = '';

if ($search) {
    $query .= " AND (name LIKE ? OR mobile LIKE ? OR email LIKE ? OR trx_id LIKE ?)";
    $searchParam = "%$search%";
    $params = array_merge($params, array_fill(0, 4, $searchParam));
    $types .= 'ssss';
}

if ($from && $to) {
    $query .= " AND DATE(created_at) BETWEEN ? AND ?";
    $params[] = $from;
    $params[] = $to;
    $types .= 'ss';
}

$query .= " ORDER BY id DESC";
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>📊 অনুদান ড্যাশবোর্ড</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background-color: #f8f9fa;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .status-approved { color: green; font-weight: bold; }
        .status-pending { color: orange; font-weight: bold; }
        .status-rejected { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📋 অনুদান ড্যাশবোর্ড</h3>
        <div>
            <a href="export_csv.php" class="btn btn-success btn-sm">⬇️ CSV এক্সপোর্ট</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">🚪 লগআউট</a>
        </div>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="নাম, মোবাইল, ইমেইল, TrxID" value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-md-3">
            <input type="date" name="from" class="form-control" value="<?= htmlspecialchars($from) ?>">
        </div>
        <div class="col-md-3">
            <input type="date" name="to" class="form-control" value="<?= htmlspecialchars($to) ?>">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">🔍 ফিল্টার</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>নাম</th>
                    <th>মোবাইল</th>
                    <th>ইমেইল</th>
                    <th>পরিমাণ (৳)</th>
                    <th>Trx ID</th>
                    <th>তারিখ</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['mobile']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>৳<?= htmlspecialchars($row['amount']) ?></td>
                    <td><?= htmlspecialchars($row['trx_id']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td class="status-<?= strtolower($row['status']) ?>">
                        <?= $row['status'] ?>
                    </td>
                    <td>
                        <a href="approve_donor.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">✔️</a>
                        <a href="reject_donor.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">❌</a>
                        <a href="edit_donor.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">✏️</a>
                        <a href="delete_donor.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি নিশ্চিত?')">🗑️</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>