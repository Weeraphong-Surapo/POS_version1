<?php
include('function/head.php');
include('function/navbar.php');
include('function/chat.php');
include('function/header.php');
include('function/sidebar.php');
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">สินค้าทั้งหมด</h4>
        <button class="btn btn-info" onclick="openModal()">เพิ่มสินค้า</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รูปภาพ</th>
                        <th>สินค้า</th>
                        <th>ราคาขาย/บาท</th>
                        <th>หมวดหมู่</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $all_product = $conn->query("SELECT * FROM tb_product");
                    foreach ($all_product as $row) :
                        $category = $conn->query("SELECT * FROM tb_category WHERE category_id = '$row[category_id]'");
                        $row_category = $category->fetch_array();
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><img src="assets/<?= $row['product_img'] ?>" alt="" style="width: 60px; height:60px; object-fit:cover;" class="rounded-1"></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['product_price'] ?></td>
                            <td><?= $row_category['category_name'] ?></td>
                            <td><?php 
                            if($row['product_qty'] > 5){
                                echo '<span class="badge light text-white bg-success">ปกติ</span>';
                            }else if($row['product_qty'] <= 5 && $row['product_qty'] <=1){
                                echo '<span class="badge light text-white bg-info">ไกล้หมด</span>';
                            }else{
                                echo '<span class="badge light text-white bg-danger">หมด</span>';
                            }
                             ?></td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" onclick="editProduct(<?= $row['product_id']?>)"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="DeleteProduct(<?= $row['product_id']?>,'<?= $row['product_name']?>')"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalProduct">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" id="id">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">รหัสสินค้า</label>
                            <input type="text" name="" id="product_code" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">ชื่อสินค้า</label>
                            <input type="text" name="" id="product_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">ราคาสินค้า</label>
                            <input type="text" name="" id="product_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">จำนวน</label>
                            <input type="text" name="" id="product_qty" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">หมวดหมู่</label>
                            <select name="" id="category" class="form-control">
                                <option value="" selected disabled>เลือกหมวดหมู่</option>
                                <?php 
                                    $all_category = $conn->query("SELECT * FROM tb_category");
                                    foreach($all_category as $row):
                                ?>
                                <option value="<?= $row['category_id']?>"><?= $row['category_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">รูปภาพ</label>
                            <input accept="image/*" type='file' id="imgInp" class="form-control" />
                        </div>
                    </div>
                </div>
                <img id="blah" src="#" alt="รูปภาพคุณ" class="img-fluid d-none" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="addProduct()">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<?php include('function/footer.php'); ?>
<script>
        var table = $('#myTable').DataTable({
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง_MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เิริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });
        
    function editProduct(id) {
        let option = {
            url: 'controller/action.php',
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                editProduct: 1
            },
            success: function(res) {
                $('#id').val(res.product_id);
                $('#category').val(res.category_id);
                $('#product_qty').val(res.product_qty);
                $('#product_price').val(res.product_price);
                $('#product_name').val(res.product_name);
                $('#product_code').val(res.product_code);
                $('#blah').attr('src','assets/'+res.product_img);
                $('#blah').removeClass('d-none');
                $('#ModalProduct').modal('show');
            }
        }
        $.ajax(option)
    }

    function addProduct() {
        let fd = new FormData();
        let id = $('#id').val();
        let category = $('#category').val();
        let product_qty = $('#product_qty').val();
        let product_price = $('#product_price').val();
        let product_name = $('#product_name').val();
        let product_code = $('#product_code').val();
        var files = $('#imgInp')[0].files;
        fd.append('id', id)
        fd.append('category', category)
        fd.append('product_qty', product_qty)
        fd.append('product_price', product_price)
        fd.append('product_name', product_name)
        fd.append('file', files[0]);
        fd.append('product_code', product_code)
        fd.append('addProduct', 1)
        let option = {
            url: 'controller/action.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res == 1) {
                    AlertSwal('อัพเดตสินค้าสำเร็จ', 'success')
                } else if (res == 0) {
                    AlertSwal('เพิ่มสินค้าสำเร็จ', 'success')
                } else {
                    AlertSwal('เกิดข้อผิดพลาด', 'error')
                }
            }
        }
        $.ajax(option)
    }

    function DeleteProduct(id, name) {
        let option = {
            url: 'controller/action.php',
            type: 'post',
            data: {
                id: id,
                DeleteProduct: 1
            },
            success: function(res) {
                AlertSwal('ลบสินค้าสำเร็จ', 'success')
            }
        }
        Swal.fire({
            title: 'ต้องการลบ ' + name + ' ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax(option)
            }
        })

    }

    function openModal() {
        $('#ModalProduct').modal('show')
    }


    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
            $('#blah').removeClass('d-none')
        }
    }
</script>