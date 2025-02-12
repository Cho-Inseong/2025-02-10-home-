<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $usersFile = './data/users.json';
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    if (!is_array($users)) {
        $users = [];
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            echo "<script>alert('이미 사용 중인 이메일입니다.');</script>";
            exit;
        }
    };

    $ids = array_column($users, 'id');
    $id = !empty($ids) ? max($ids) + 1 : 1;

    $users[] = [
        "id" => $id,
        "name" => $name,
        "email" => $email,
        "password" => $password
    ];

    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<script>alert('회원가입이 성공적으로 완료되었습니다.'); window.location.href = './';</script>";
    exit;
};
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include("./component/header.php") ?>

    <main class="register_main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: salmon; color: white; text-align: center;">
                            <h4>회원가입</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">이름</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">이메일</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">비밀번호</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                                <button type="submit" class="btn" style="background-color: salmon; color: white; width: 100%;">회원가입</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("./component/footer.php") ?>
</body>

</html>