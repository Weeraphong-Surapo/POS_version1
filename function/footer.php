		</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->
		j




		</div>
		<!--**********************************
        Main wrapper end
    ***********************************-->

		<!--**********************************
        Scripts
    ***********************************-->
		<!-- Required vendors -->
		<script src="./vendor/global/global.min.js"></script>
		<script src="./vendor/chart.js/Chart.bundle.min.js"></script>
		<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

		<!-- Apex Chart -->
		<script src="./vendor/apexchart/apexchart.js"></script>
		<script src="./vendor/nouislider/nouislider.min.js"></script>
		<script src="./vendor/wnumb/wNumb.js"></script>

		<!-- Datatable -->
		<script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
		<script src="./js/plugins-init/datatables.init.js"></script>

		<!-- Dashboard 1 -->
		<!-- <script src="./js/dashboard/dashboard-1.js"></script> -->

		<script src="./js/custom.min.js"></script>
		<script src="./js/dlabnav-init.js"></script>



		</body>

		</html>
		<script>
function AlertSwal(title, type) {
    Swal.fire(
        title,
        '',
        type
    )
    setTimeout(() => {
        location.reload()
    }, 700)
}

function logout() {
    let option = {
        url: 'controller/action.php',
        type: 'post',
        data: {
            logout: 1
        },
        success: (res) => {
            Swal.fire(
                'ออกจากระบบสำเร็จ!',
                '',
                'success'
            )
            setTimeout(() => {
                window.location = "login.php";
            }, 800)
        }
    }
    Swal.fire({
        title: 'ออกจากระบบ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax(option)
        }
    })
}
		</script>