<?php
date_default_timezone_set('Asia/Seoul');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $detail = $_POST["detail"];
    $author = $_SESSION['user']['name'];
    $time = date("Y-m-d H:i:s");
    $email = $_SESSION['user']['email'];
    
    $postsFile = './data/posts.json';
    $posts = file_exists($postsFile) ? json_decode(file_get_contents($postsFile), true) : [];

    if (!is_array($posts)) {
        $posts = [];
    }

    $ids = array_column($posts, 'id');
    $id = !empty($ids) ? max($ids) + 1 : 1;

    $posts[] = [
        "id" => $id,
        "title" => $title,
        "detail" => $detail,
        "author" => $author,
        "time" => $time,
        "email" => $email
    ];

    file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<script>alert('게시물 작성이 성공적으로 완료되었습니다.'); window.location.href = './';</script>";
    exit;

}
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
                            <h4>게시물 작성</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="title" class="form-label">제목</label>
                                    <input type="text" name="title" class="form-control" id="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="detail" class="form-label">내용</label>
                                    <input type="text" name="detail" class="form-control" id="detail" required>
                                </div>
                                <button type="submit" class="btn" style="background-color: salmon; color: white; width: 100%;">작성 완료하기</button>
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