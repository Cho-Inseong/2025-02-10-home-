<header>
    <div>
        <span><a href="./">인성 블로그</a></span>
    </div>
    <ul>
        <?php
        if (isset($_SESSION['user'])) {
            echo "<li><a href='logout'>로그아웃</a></li>";
            echo "<li><a href='create_post'>글작성하기</a></li>";
            echo $_SESSION['user']['name'];
        }else {
            echo "
            <li><a href='login'>로그인</a></li>
            <li><a href='register'>회원가입</a></li>
            ";
        };
        ?>
    </ul>
</header>