<?php
    session_start();
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama = $_POST["nama"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $hp = $_POST["hp"];


         /* Assume all is ok so far */
        $sql='SELECT username FROM anggota WHERE username=?';
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$username);
        $stmt->execute();

        $stmt->bind_result( $found );
        $stmt->fetch();

        if(!$found){
            // Insert data ke tabel member
            $sql = "INSERT INTO anggota (nama, username, password, email, hp) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $nama, $username, $password, $email, $hp);

            if($stmt->execute()){
                echo "Pendaftaran berhasil. Silahkan <a href='index.php'>Login</a>";
            }else {
                echo "Error:".$sql."<br>".$conn->error;
            }
        }else {
            /* username is taken */
            // $errors[]='Sorry, that username is already in use.';
            echo "<script>
                alert('Username sudah ada coba masukkan lagi!');
                window.location.href='register.php';
            </script>";
        }
    



    $stmt->close();
    }
    $conn->close();
?>