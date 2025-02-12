<?php
$postsFile = './data/posts.json';
$posts = file_exists($postsFile) ? json_decode(file_get_contents($postsFile), true) : [];
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include("./component/header.php") ?>

    <main>
        <?php
            if(!empty($posts)) {
                foreach ($posts as $post) {
                    $divinnertext = "";
                    $divinnertext .= "<div>";
                    $divinnertext .= "<p> 제목:".$post['title']."</p>" ;
                    $divinnertext .= "<p> 내용:".$post['detail']."</p>" ;
                    $divinnertext .= "<p> 작성자:".$post['author']."</p>" ;
                    $divinnertext .= "<p> 작성일자:".$post['time']."</p>" ;
                    if(!isset($_SESSION['user'])) {
                        $divinnertext .= "</div>";
                        $divinnertext .= "<br>";
                    } else if($post['email'] === $_SESSION['user']['email']) {
                        $divinnertext .= "<button type='submit' class='btn btn-danger'>삭제하기</button>" ;
                        $divinnertext .= "</div>";
                        $divinnertext .= "<br>";                        
                    }

                    echo $divinnertext;
                }
                
            }
        ?>
    </main>

    <?php include("./component/footer.php") ?>
</body>

</html>