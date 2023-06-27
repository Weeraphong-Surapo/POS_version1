<?php 
session_start();
    include('../config/connect.php');
    if(isset($_POST['addCategory'])){
        if(!empty($_POST['id'])){
            echo 1;
            $conn->query("UPDATE tb_category SET category_name = '$_POST[category]' WHERE category_id = '$_POST[id]'");
        }else{
            echo 0;
            $conn->query("INSERT INTO tb_category(category_name) VALUE('$_POST[category]')");
        }
    }

    if(isset($_POST['deleteCategory'])){
        $conn->query("DELETE FROM tb_category WHERE category_id = '$_POST[id]'");
    }

    if(isset($_POST['editCategory'])){
        $query = $conn->query("SELECT * FROM tb_category WHERE category_id = '$_POST[id]'");
        $row = $query->fetch_array();
        echo json_encode($row);
    }

    if(isset($_POST['addProduct'])){
        $filename = isset($_FILES['file']) ? $_FILES['file']['name'] : '';
        if(!empty($_POST['id'])){
            echo 1;
            if($filename != ''){
                /* Location */
                $location = "../admin/assets/upload/" . $filename;
                $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
                $imageFileType = strtolower($imageFileType);
            
                /* Valid extensions */
                $valid_extensions = array("jpg", "jpeg", "png", "webp", "gif");
        
                if (in_array(strtolower($imageFileType), $valid_extensions)) {
                    /* Upload file */
                    $file = rand(1000, 100000) . "-" . $filename;
                    $new_file_name = strtolower($file);
                    $fainal = str_replace(' ', '-', $new_file_name);
                    $newname = 'upload/' . $fainal;
                    /* Location */
                    $location = "../assets/upload/" . $fainal;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                        $sql = "UPDATE `tb_product` SET 
                        `product_code` = '$_POST[product_code]',
                        `product_name` = '$_POST[product_name]',
                        `product_price` = '$_POST[product_price]',
                        `product_qty` = '$_POST[product_qty]',
                        `product_img` = '$newname'
                        WHERE `product_id` = '$_POST[id]'";
                    }
                }
            }else{
                $sql = "UPDATE `tb_product` SET 
                `product_code` = '$_POST[product_code]',
                `product_name` = '$_POST[product_name]',
                `product_price` = '$_POST[product_price]',
                `product_qty` = '$_POST[product_qty]'
                WHERE `product_id` = '$_POST[id]'";
            }
                $query = $conn->query($sql);
        }else{
            echo 0;
            if($filename != ''){
                /* Location */
                $location = "../admin/assets/upload/" . $filename;
                $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
                $imageFileType = strtolower($imageFileType);
            
                /* Valid extensions */
                $valid_extensions = array("jpg", "jpeg", "png", "webp", "gif");
        
                if (in_array(strtolower($imageFileType), $valid_extensions)) {
                    /* Upload file */
                    $file = rand(1000, 100000) . "-" . $filename;
                    $new_file_name = strtolower($file);
                    $fainal = str_replace(' ', '-', $new_file_name);
                    $newname = 'upload/' . $fainal;
                    /* Location */
                    $location = "../assets/upload/" . $fainal;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                        $sql = "INSERT INTO `tb_product`(`product_code`, `product_name`, `product_price`, `product_qty`, `product_img`, `category_id`) 
                                VALUES ('$_POST[product_code]','$_POST[product_name]','$_POST[product_price]','$_POST[product_qty]','$newname','$_POST[category]')";
                    }
                }
            }else{
                $sql = "INSERT INTO `tb_product`(`product_code`, `product_name`, `product_price`, `product_qty`, `category_id`) 
                VALUES ('$_POST[product_code]','$_POST[product_name]','$_POST[product_price]','$_POST[product_qty]','$_POST[category]')";
            }
                $query = $conn->query($sql);
        }

    }

    if(isset($_POST['DeleteProduct'])){
        $conn->query("DELETE FROM tb_product WHERE product_id = '$_POST[id]'");
    }

    if(isset($_POST['editProduct'])){
        $query = $conn->query("SELECT * FROM tb_product WHERE product_id = '$_POST[id]'");
        $row = $query->fetch_array();
        echo json_encode($row);
    }

    if (isset($_POST['showDetail'])) {
        $order_sale = $conn->query("SELECT * FROM tb_sale WHERE sale_id = '$_POST[id]'");
        $row_order_sale = $order_sale->fetch_array();
    
        $customer = $conn->query("SELECT customer_fname,customer_lname,customer_phone,customer_address FROM tb_customer WHERE customer_id = '$row_order_sale[customer_id]'");
        if ($customer->num_rows >= 1) {
            $row_customer = $customer->fetch_array();
            $customer_fname = $row_customer['customer_fname'].' ' .$row_customer['customer_lname'];
            $customer_address = $row_customer['customer_address'];
            $customer_phone = $row_customer['customer_phone'];
        } else {
            $customer_fname = 'ไม่มีข้อมูล';
            $customer_address = 'ไม่มีข้อมูล';
            $customer_phone = 'ไม่มีข้อมูล';
        }
    
        $tax_rate = 0.07;
        $discount = 0;
        $order_product = $conn->query("SELECT * FROM tb_order WHERE sale_id = '$_POST[id]'");
        $outp = '
        <style>
        table{
            width:100%;
            font-size: 14px;
        }
        th.show, td.show {
            color:black;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
          }
          span.show{
            color:black;
            border-bottom: 1px dotted black;
          }
    
        </style>';
        $outp .= '<table style="margin-bottom:3px;">
        <tr>
        <td style="text-align:center;">วันที่ซื้อ &nbsp;<span class="show">' . date_format(date_create($row_order_sale['by_date']), "d/m/Y H:i") . '</span></td>
        <td style="text-align:center;">รหัสการขาย &nbsp;<span class="show">' . $row_order_sale['sale_code'] . '</span></td>
        </tr>
        </table>';
        $outp .= '<p>ชื่อผู้ซื้อ <span class="show">&nbsp;' . $customer_fname  . '</span></p>';
        $outp .= '<p>ที่อยู่ <span class="show">&nbsp;' . $customer_address . ' </span>&nbsp;&nbsp; เบอร์โทร <span class="show">&nbsp;' . $customer_phone . '</span></p>';
        $outp .= '<div class="box"></div>';
        $outp .= '<table>
        <thead>
            <tr>
                <th class="show" style="text-align:center;">ลำดับ</th>
                <th class="show">รายการ</th>
                <th class="show" style="text-align:center;">จำนวน</th>
                <th class="show" style="text-align:right;">ราคา/หน่วย</th>
                <th class="show" style="text-align:right;">จำนวนเงิน/บาท</th>
            </tr>
        </thead>
        <tbody>';
        $i = 1;
        foreach ($order_product as $row) {
            $product = $conn->query("SELECT * FROM tb_product WHERE product_id = $row[product_id]");
            $row_product = $product->fetch_array();
            $outp .= '<tr>
            <td class="show" style="text-align:center;">' . $i++ . '</td>
            <td class="show" style="text-align:left;">' . $row_product['product_name'] . '</td>
            <td class="show" style="text-align:center;"> ' . $row['product_qty'] . '</td>
            <td class="show" style="text-align:right;">' . number_format($row['product_price'], 2) . '</td>
            <td class="show" style="text-align:right;">' . number_format($row['product_total_price'], 2) . '</td>
        </tr>';
        }
        $outp .= '<tr>
            <td class="show" colspan="4" style="text-align:right;" >มูลค่ารวมทั้งหมด</td>
            <td class="show" style="text-align:right;">' . number_format($row_order_sale['product_total_price'] ,2) . '</td>
        </tr>';
        $outp .= '<tr>
            <td class="show" colspan="4" rowspan="2" style="text-align:right;">ยอดรวม</td>
            <td class="show" style="text-align:right;">' . number_format($row_order_sale['product_total_price'], 2) . '</td>
        </tr>';
        $outp .= '</tbody></table>';
        echo $outp;
    }


if (isset($_POST['deleteStory'])) {
    $query = $conn->query("DELETE FROM tb_sale WHERE sale_id = '$_POST[id]'");
}

if(isset($_POST['updateShop'])){
    if (!empty($_FILES['file']['name'])) {
        $file_img = rand(10000000, 99999999) . '-' . $_FILES['file']['name'];
        $location = "../assets/upload/";
        $nameFile =  array('png', 'jpg', 'pdf', 'webp', 'jpeg','JPEG','gif');
        $nameFileImg = pathinfo($file_img, PATHINFO_EXTENSION);
        if (!in_array($nameFileImg, $nameFile)) {
            echo "ภาพไม่ถูก";
        } else {
            move_uploaded_file($_FILES['file']["tmp_name"], $location . $file_img);
            $query = $conn->query("UPDATE tb_shop SET 
            shop_name = '$_POST[shop_name]',
            shop_address = '$_POST[shop_address]',
            shop_phone = '$_POST[shop_phone]',
            shop_img = '$file_img',
            line_notify = '$_POST[shop_notify]'
            ");
        }
    } else {
        $query = $conn->query("UPDATE tb_shop SET 
        shop_name = '$_POST[shop_name]',
        shop_address = '$_POST[shop_address]',
        shop_phone = '$_POST[shop_phone]',
        line_notify = '$_POST[shop_notify]'
        ");
    }

}

if (isset($_POST['DeleteEmployee'])) {
    $conn->query("DELETE FROM tb_employee WHERE employee_id = '$_POST[id]'");
}

if (isset($_POST['showEmployee'])) {
    $query = $conn->query("SELECT * FROM tb_employee WHERE employee_id = '$_POST[id]'");
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['EditEmployee'])) {
    $query = $conn->query("SELECT * FROM tb_employee WHERE employee_id = '$_POST[id]'");
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['addEmployee'])) {
    $pass = md5($_POST['password']);
    $date = date('d/m/Y H:i:s');
    if (!empty($_POST['id'])) {
        $data = array('status'=>1);
        if (!empty($_FILES['file']['name'])) {
            $file_img = rand(10000000, 99999999) . '-' . $_FILES['file']['name'];
            $location = "../assets/upload/";
            $nameFile =  array('png', 'jpg', 'pdf', 'webp', 'jpeg','gif','JPG');
            $nameFileImg = pathinfo($file_img, PATHINFO_EXTENSION);
            if (!in_array($nameFileImg, $nameFile)) {
                echo "ภาพไม่ถูก";
            } else {
                move_uploaded_file($_FILES['file']["tmp_name"], $location . $file_img);
                $sql = "UPDATE `tb_employee` SET
                `username`='$_POST[username]',
                `password`='$pass',
                `fname`='$_POST[fname]',
                `lname`='$_POST[lname]',
                `address`='$_POST[address]',
                `phone`='$_POST[phone]',
                `line`='$_POST[line]',
                `user_img`='$file_img'
                 WHERE employee_id = '$_POST[id]'";
                $conn->query($sql);

            }
        } else {
            $sql = "UPDATE `tb_employee` SET
                `username`='$_POST[username]',
                `password`='$pass',
                `fname`='$_POST[fname]',
                `lname`='$_POST[lname]',
                `address`='$_POST[address]',
                `phone`='$_POST[phone]',
                `line`='$_POST[line]'
                 WHERE employee_id = '$_POST[id]'";
            $conn->query($sql);

        }
    } else {
        $data = array('status'=>0);
        if (!empty($_FILES['file']['name'])) {
            $file_img = rand(10000000, 99999999) . '-' . $_FILES['file']['name'];
            $location = "../assets/upload/";
            $nameFile =  array('png', 'jpg', 'pdf', 'webp', 'jpeg','gif','JPG');
            $nameFileImg = pathinfo($file_img, PATHINFO_EXTENSION);
            if (!in_array($nameFileImg, $nameFile)) {
                echo "ภาพไม่ถูก";
            } else {
                move_uploaded_file($_FILES['file']["tmp_name"], $location . $file_img);
                $sql = "INSERT INTO `tb_employee`(`username`, `password`, `fname`, `lname`, `address`, `phone`, `line`, `user_img`,  `type`, `created_at`) 
                VALUES ('$_POST[username]','$pass','$_POST[fname]','$_POST[lname]','$_POST[address]','$_POST[phone]','$_POST[line]','$file_img',1,'$date')";
                $new_employee = $conn->query($sql);
            }
        } else {
            $sql = "INSERT INTO `tb_employee`(`username`, `password`, `fname`, `lname`, `address`, `phone`, `line`, `type`, `created_at`) 
            VALUES ('$_POST[username]','$pass','$_POST[fname]','$_POST[lname]','$_POST[address]','$_POST[phone]','$_POST[line]',1,'$date')";
            $new_employee = $conn->query($sql);
        }
    }
    echo json_encode($data);
}

if(isset($_POST['login'])){
    $pass = md5($_POST['password']);
    $check_user = $conn->query("SELECT * FROM tb_employee WHERE username = '$_POST[username]'");
    if($check_user->num_rows >= 1){
        $check_password = $conn->query("SELECT * FROM tb_employee WHERE username = '$_POST[username]' AND password = '$pass'");
        if($check_password->num_rows >= 1){
            $emp = $check_password->fetch_array();
            if($emp['type'] == 999){
                $_SESSION['login'] = true;
                $_SESSION['employee_id'] = $emp['employee_id'];
                $_SESSION['type'] = 999;
            }else{
                $_SESSION['login'] = true;
                $_SESSION['employee_id'] = $emp['employee_id'];
                $_SESSION['type'] = 1;
            }
            echo 2;
        }else{
            echo 1;
        }
    }else{
        echo 0;
    }
}

if (isset($_POST['DeleteCustomer'])) {
    $delteCustomer = $conn->query("DELETE FROM tb_customer WHERE customer_id = '$_POST[id]'");
}

if (isset($_POST['editCustomer'])) {
    $query = $conn->query("SELECT * FROM tb_customer WHERE customer_id = '$_POST[id]'");
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['addcustomer'])) {
    if (!empty($_POST['id'])) {
        $update = $conn->query("UPDATE tb_customer SET customer_fname = '$_POST[fname]' , customer_lname = '$_POST[lname]', customer_phone = '$_POST[phone]', customer_line = '$_POST[line]', customer_address = '$_POST[address]' WHERE customer_id = '$_POST[id]'");
        $check_row = $conn->query("SELECT * FROM tb_customer");
        $data = array(
            'status' => 1
        );
    } else {
        $date = date('d-m-y H:i');
        $query = $conn->query("INSERT INTO tb_customer(customer_fname,customer_lname,customer_phone,customer_line,customer_address,created_at) 
                               VALUES('$_POST[fname]','$_POST[lname]','$_POST[phone]','$_POST[line]','$_POST[address]','$date')");
        $data = array(
            'status' => 0
        );
    }
    echo json_encode($data);
}

if (isset($_POST['updateProfile'])) {
    if (!empty($_FILES['file']['name'])) {
        $file_img = rand(10000000, 99999999) . '-' . $_FILES['file']['name'];
        $location = '../assets/upload/';
        $nameFile =  array('png', 'jpg', 'pdf', 'webp', 'jpeg','gif','JPEG');
        $nameFileImg = pathinfo($file_img, PATHINFO_EXTENSION);
        if (!in_array($nameFileImg, $nameFile)) {
            echo "ภาพไม่ถูก";
        } else {
            move_uploaded_file($_FILES['file']["tmp_name"], $location . $file_img);
            $sql = "UPDATE `tb_employee` SET
                `username`='$_POST[username]',
                `fname`='$_POST[fname]',
                `lname`='$_POST[lname]',
                `address`='$_POST[address]',
                `phone`='$_POST[phone]',
                `line`='$_POST[line]',
                `user_img`='$file_img'
                 WHERE employee_id = '$_POST[id]'";
            $conn->query($sql);
        }
    } else {
        $sql = "UPDATE `tb_employee` SET
                `username`='$_POST[username]',
                `fname`='$_POST[fname]',
                `lname`='$_POST[lname]',
                `address`='$_POST[address]',
                `phone`='$_POST[phone]',
                `line`='$_POST[line]'
                WHERE employee_id = '$_POST[id]'";
        if($conn->query($sql)){
            echo 'success';
        }else{
            echo $sql;
        }
    }
}

if(isset($_POST['checkPass'])){
    $pass = (string)md5($_POST['password']);
    $sql = "SELECT * FROM tb_employee WHERE employee_id = '$_SESSION[employee_id]'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    if($pass == $row['password']){
        echo 1;
    }else{
        echo $pass;
    }
}

if(isset($_POST['updatePass'])){
    $pass = md5($_POST['new_pass']);
    $query = $conn->query("UPDATE tb_employee SET password = '$pass' WHERE employee_id = '$_SESSION[employee_id]'");
    if($query){
        echo 'success';
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
}