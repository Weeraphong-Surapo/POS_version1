<?php
include('function/head.php');
include('function/navbar.php');
include('function/chat.php');
include('function/header.php');
include('function/sidebar.php');
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">หมวดหมู่ทั้งหมด</h4>
        <button class="btn btn-info" onclick="openModal()">เพิ่มหมวดหมู่</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>หมวดหมู่</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $all_category = $conn->query("SELECT * FROM tb_category");
                    foreach ($all_category as $row) :
                    ?>
                        <tr>
                            <td width="10%"><?= $i++ ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td width="15%">
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" onclick="editCategory(<?= $row['category_id'] ?>)"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="DeleteCategory(<?= $row['category_id'] ?>,'<?= $row['category_name'] ?>')"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="ModalCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มหมวดหมู่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formCategory">
                    <input type="hidden" name="" id="id">
                    <div class="mb-2">
                        <label for="">หมวดหมู่</label>
                        <input type="text" name="" id="category" class="form-control" placeholder="ระบุชื่อหมวดหมู่">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="addCategory()">บันทึก</button>
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

    function editCategory(id){
        let option = {
            url: 'controller/action.php',
            type: 'post',
            dataType:'json',
            data:{
                id:id,
                editCategory:1
            },
            success:function(res){
                $('#id').val(res.category_id)
                $('#category').val(res.category_name)
                $('#ModalCategory').modal('show');
            }
        }
        $.ajax(option)
    }

    function addCategory() {
        let fd = new FormData();
        let id = $('#id').val();
        let category = $('#category').val();
        fd.append('id', id)
        fd.append('category', category)
        fd.append('addCategory', 1)
        let option = {
            url: 'controller/action.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                if(res == 1){
                    AlertSwal('อัพเดตประเภทสำเร็จ', 'success')
                }else if(res== 0){
                    AlertSwal('เพิ่มประเภทสำเร็จ', 'success')
                }else{
                    AlertSwal('เกิดข้อผิดพลาด', 'error')
                }
            }
        }
        $.ajax(option)
    }

    function DeleteCategory(id, name) {
        let option = {
            url: 'controller/action.php',
            type: 'post',
            data: {
                id: id,
                deleteCategory: 1
            },
            success: function(res) {
                AlertSwal('ลบประเภทสำเร็จ', 'success')
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
        $('#ModalCategory').modal('show')
    }
</script>