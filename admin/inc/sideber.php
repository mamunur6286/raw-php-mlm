<!-- Sidebar user panel -->

<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image"><img src="<?php echo $admin_result['image']; ?>" class="img-circle" alt="User Image" /></div>
            <div class="pull-left info"><p><?php if(isset($_SESSION['adminName'])){ echo $_SESSION['adminName']; } ?></p><a href="#"><i class="fa fa-circle text-success"></i> Online</a></div></div>

        <!-- sidebar menu: -->
        <ul class="sidebar-menu">
            <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li><a href="profile.php"><i class="fa fa-th"></i>My Profile</a></li>

            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>Total User</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="active_user.php"><i class="fa fa-circle-o"></i> Active User </a></li>
                    <li><a href="inactive_user.php"><i class="fa fa-circle-o"></i> Inactive User</a></li>
                    <li><a href="special_user.php"><i class="fa fa-circle-o"></i> Special User</a></li>
                </ul></li>

            <li class="treeview"><a href="#"><i class="fa fa-edit"></i> <span> Transaction Request</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <?php
                        $query="SELECT * FROM tbl_transaction_admin WHERE confirm='0' ORDER BY id DESC ";
                        $total_pending=database::connect()->query($query);
                    ?>
                    <li><a href="pending_transaction.php"><i class="fa fa-circle-o"></i> Pending Request ( <?php echo $total_pending->num_rows; ?> )</a></li>
                    <li><a href="success_transactions.php"><i class="fa fa-circle-o"></i> Success Transactions </a></li>
                </ul></li>
            <li><a href="total_transactiion_commission.php"><i class="fa fa-th"></i>Commission History</a></li>
            <li><a href="blood_donate.php"><i class="fa fa-th"></i>Blood Donor</a></li>
            <li><a href="setting.php"><i class="fa fa-th"></i>Setting</a></li>

            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>PIN Manage</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href=""  ><i class="fa fa-circle-o"></i> General Pin </a>
                        <ul class="treeview-menu">
                            <li><a href="" data-toggle="modal" data-target="#general_pin"><i class="fa fa-circle-o"></i>Create General Pin </a>
                            <li><a href="general_pin_list.php" ><i class="fa fa-circle-o"></i> General Pin List</a>
                        </ul>
                    </li>
                    <li><a href=""  ><i class="fa fa-circle-o"></i> Special Pin </a>
                        <ul class="treeview-menu">
                            <li><a href="" data-toggle="modal" data-target="#special_pin"><i class="fa fa-circle-o"></i>Create Special Pin</a></li>
                            <li><a href="special_pin_list.php" ><i class="fa fa-circle-o"></i> Special Pin List</a>
                        </ul>
                    </li>
                </ul></li>
            <?php
                if (isset($_GET['action'])&& $_GET['action']=='logout'){
                    Session::destroy();
                }
            ?>
            <li><a href="?action=logout"><i class="fa fa-book"></i> LogOut </a></li>
        </ul></section></aside>

<!--sidebar End  -->