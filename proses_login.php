<?php 

session_start(); 

include("config.php"); 

//Mengambil data login yang dimasukkan user
$username = $_POST['username']; 
$password = $_POST['password']; 

//Mengambil data password di DB dan mencocokkan dengan data yang dimasukkan user
$sql = "SELECT password FROM anggota WHERE username = (?)"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

//eksekusi queri
$stmt->execute();
//menyimpan hasil(jadi bisa mengecek num_rows secara langsung)
$stmt->store_result();

if($stmt->num_rows()){
    $stmt->bind_result($hashed);
    $stmt->fetch();
    
    if(password_verify($password, $hashed)){
        $_SESSION['username'] = $username; 
        header("Location: welcome.php");
    } else{
        echo "<script>
            alert('Password salah. Coba lagi!');
            window.location.href='index.php';
        </script>";
    }
}else {
    echo "<script>
        alert('Akun tidak di temukan');
        window.location.href='index.php';
    </script>";
}
    $stmt->free_result();
    $stmt->close();
?>