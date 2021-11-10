<?php

function koneksi() {
    return mysqli_connect('localhost', 'root','', 'pweb_1');
}

function query($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    // if(mysqli_num_rows($result) == 1) {
    //     return mysqli_fetch_assoc($result);
    // }

    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    return $rows;
}

function query2($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    return $result;
}


function tambah($data) {
    $conn = koneksi(); 
    
    $E_On = htmlspecialchars($data['E_ON']);
    $E_Of = htmlspecialchars($data['E_OF']);
    $E_Act = htmlspecialchars($data['E_ACT']);
    $E_Dis = htmlspecialchars($data['E_DIS']);
    $E_Reason = htmlspecialchars($data['E_REASON']);
    // $usrIdKjd = htmlspecialchars($data['USR_ID_KJD']);


    $query = "INSERT INTO event(E_ON,E_OF,E_ACT,E_DIS,E_REASON) VALUES ('$E_On', '$E_Of', '$E_Act', '$E_Dis', '$E_Reason');";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    //kalo gagal nampilkan error
    //echo mysqli_error($conn);

    //memberitahu apakah ada baris yang terkena perbuatan sesuatu, 
    //1 ada yang affected
    //0 no rows affected
    //-1 ada error
    return mysqli_affected_rows($conn);
}


// function hapus($kjdId) {
//     $conn = koneksi();
//     mysqli_query($conn, "DELETE FROM kejadian WHERE KJD_ID = $kjdId") or die(mysqli_error($conn));

//     return mysqli_affected_rows($conn); 

// }

// function ubah($idKej) {

//     $conn = koneksi(); 
    
//     $kjdId = htmlspecialchars($idKej['KJD_ID']);
//     $kjdOn = htmlspecialchars($idKej['KJD_ON']);
//     $kjdOf = htmlspecialchars($idKej['KJD_OF']);
//     $kjdAct = htmlspecialchars($idKej['KJD_ACT']);
//     $kjdDis = htmlspecialchars($idKej['KJD_DIS']);
//     $rIdKjd = htmlspecialchars($idKej['R_ID_KJD']);
//     $usrIdKjd = htmlspecialchars($idKej['USR_ID_KJD']);


//     $query = "UPDATE kejadian SET 
//                 KJD_ACT = '$kjdAct',
//                 KJD_DIS = '$kjdDis',
//                 R_ID_KJD = '$rIdKjd',
//                 USR_ID_KJD = '$usrIdKjd'
//               WHERE KJD_ID = '$kjdId'";

//     mysqli_query($conn, $query) or die(mysqli_error($conn));

//     //kalo gagal nampilkan error
//     //echo mysqli_error($conn);

//     //memberitahu apakah ada baris yang terkena perbuatan sesuatu, 
//     //1 ada yang affected
//     //0 no rows affected
//     //-1 ada error
//     return mysqli_affected_rows($conn);

// }


// function cari($keyword , $someoneLogged) {
//     $conn = koneksi();

//     $query = "SELECT KJD_ID, KJD_ON, KJD_OF, KJD_ACT, KJD_DIS, R_ID_KJD, USR_ID_KJD, R_DESC 
//                 FROM kejadian INNER JOIN reason ON kejadian.R_ID_KJD = reason.R_ID
//                 WHERE  
//                 (KJD_ACT LIKE '%$keyword%' OR
//                 KJD_DIS LIKE '%$keyword%') AND
//                 USR_ID_KJD = $someoneLogged
//                 ORDER BY KJD_ID	
//             ";

// // $dataKejadian = query("SELECT KJD_ID, KJD_ON, KJD_OF, KJD_ACT, KJD_DIS, R_ID_KJD, USR_ID_KJD, R_DESC 
// // FROM kejadian INNER JOIN reason ON kejadian.R_ID_KJD = reason.R_ID 
// // WHERE USR_ID_KJD=$idOrangLogin");

//     $result = mysqli_query($conn, $query);

//     $rows = [];
//     while($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }

//     return $rows;

// }

function login($dataLogin) {
    $conn = koneksi();

    $username = htmlspecialchars($dataLogin['username']);
    $password = htmlspecialchars($dataLogin['password']);

    $query = "SELECT * FROM user
                WHERE  
                user_username = '$username' && user_password = '$password' && 
                (SELECT user_id FROM user WHERE user_username = '$username' );
            ";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $idLogged = $row['user_id'];
        $_SESSION['login'] = true;
        header("Location: 2_halaman-tabel.php?user_id=$idLogged");
        // echo "<pre>";
        // echo var_dump($row);
        // echo "</pre>";
        //return mysqli_fetch_assoc($result);
    } else {
        return [
            'error' => true,
            'pesan' => 'Username/Password Salah!'
        ];
    }

    


}

// function login($dataLogin) {
//     $conn = koneksi();

//     $username = htmlspecialchars($dataLogin['username']);
//     $password = htmlspecialchars($dataLogin['password']);

//     $query = "SELECT * FROM user
//                 WHERE  
//                 USR_USERNAME = '$username' && USR_PASSSWORD = '$password' && 
//                 (SELECT USR_ID FROM user WHERE USR_USERNAME = '$username' );
//             ";
//     $result = mysqli_query($conn, $query);

//     if(mysqli_num_rows($result) == 1) {

//         $row = mysqli_fetch_assoc($result);
//         // echo "<pre>";
//         // echo var_dump($row);
//         // echo "</pre>";
//         //return mysqli_fetch_assoc($result);
//     }

//     $idLogged = $row['USR_ID'];
    

//     // $rows = [];
//     // while($row = mysqli_fetch_assoc($result)) {
//     //     $rows[] = $row;
//     // }
//     // echo "<pre>";
//     // echo var_dump($rows);
//     // echo "</pre>";


//     // exit;
//     if($result) {
        
//         $_SESSION['login'] = true;
//         // echo "<pre>";
//         // echo var_dump($loginUser);
//         // echo "</pre>";

//         header("Location: 2_halaman-tabel.php?USR_ID=$idLogged");
//     } else {
//         return [
//             'error' => true,
//             'pesan' => 'Username/Password Salah!'
//         ];
//     }


// }


// function login($dataLogin) {
//     $conn = koneksi();

//     $username = htmlspecialchars($dataLogin['username']);
//     $password = htmlspecialchars($dataLogin['password']);

//     $idLogin = query("SELECT USR_ID FROM user WHERE USR_USERNAME = '$username' " );
//     $dataLogin['login'] = $idLogin; 

//     $loginUser = query("SELECT * FROM user WHERE USR_USERNAME = '$username' && USR_PASSSWORD = '$password' ");

//     //if(query("SELECT * FROM user WHERE USR_USERNAME = '$username' && USR_PASSSWORD = '$password' ")) {

//         if($loginUser) {
        
//         $_SESSION['login'] = true;
//         echo "<pre>";
//         echo var_dump($dataLogin);
//         echo "</pre>";

//         header("Location: 2_halaman-tabel.php");
//     } else {
//         return [
//             'error' => true,
//             'pesan' => 'Username/Password Salah!'
//         ];
//     }


// }
