<?php

$action = $_REQUEST['action'];

if (!empty($action)) {
    require_once 'includes/Barang.php';
    $obj = new Barang();
}

if ($action == 'adduser' && !empty($_POST)) {
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $photo = $_FILES['photo'];
    $barangId = (!empty($_POST['userid'])) ? $_POST['userid'] : '';

    // file (photo) upload
    $imagename = '';
    if (!empty($photo['name'])) {
        $imagename = $obj->uploadPhoto($photo);
        $barangData = [
            'nama_barang' => $nama_barang,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok,
            'photo' => $imagename,
        ];
    } else {
        $barangData = [
            'nama_barang' => $nama_barang,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok
        ];
    }

    if($barangId){
        $obj->update($barangData, $barangId);
    } else {
        $barangId = $obj->add($barangData);
    }


    if (!empty($barangId)) {
        $barangg = $obj->getRow('id', $barangId);
        echo json_encode($barangg);
        exit();
    }
}

if ($action == "getusers") {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 4;
    $start = ($page - 1) * $limit;

    $barang = $obj->getRows($start, $limit);
    if (!empty($barang)) {
        $barangList = $barang;
    } else {
        $barangList = [];
    }
    $total = $obj->getCount();
    $barangArr = ['count' => $total, 'barang' => $barangList];
    echo json_encode($barangArr);
    exit();
}

if ($action == "getuser") {
    $barangId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($barangId)) {
        $barangg = $obj->getRow('id', $barangId);
        echo json_encode($barangg);
        exit();
    }
}

if ($action == "deleteuser") {
    $barangId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($barangId)) {
        $isDeleted = $obj->deleteRow($barangId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

if($action == 'search') {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']) : '';
    $results = $obj-> searchBarang($queryString);
    echo json_encode($results);
    exit();
}