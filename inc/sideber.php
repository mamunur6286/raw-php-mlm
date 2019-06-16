<!-- Sidebar user panel -->

<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image"><img src=" <?php echo $result['image'] ?>" class="img-circle" alt="User Image" /></div>
            <div class="pull-left info"><p><?php if(isset($_SESSION['userName'])){ echo $_SESSION['userName']; } ?></p><a href="#"><i class="fa fa-circle text-success"></i> Online</a></div></div>

        <!-- sidebar menu: -->
        <ul class="sidebar-menu">
            <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li><a href="profile.php"><i class="fa fa-th"></i>My Profile</a></li>

            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>Team View</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="referral.php"><i class="fa fa-circle-o"></i> Direct Referral </a></li>
                    <li><a href="generation.php"><i class="fa fa-circle-o"></i> Generation Referral</a></li>
                </ul></li>

            <li class="treeview"><a href="#"><i class="fa fa-edit"></i> <span> Transaction </span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="withdraw_admin.php"><i class="fa fa-circle-o"></i> Withdraw to Admin</a></li>
                    <li><a href="send_to_user.php"><i class="fa fa-circle-o"></i> Send to User </a></li>
                </ul></li>

            <li class="treeview"><a href="#"><i class="fa fa-table"></i> <span>Payment History</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="history_admin_withdraw.php"><i class="fa fa-circle-o"></i>Withdraw to Admin</a></li>
                    <li><a href="history_send_user.php"><i class="fa fa-circle-o"></i> Send to User</a></li>
                    <li><a href="history_receive_user.php"><i class="fa fa-circle-o"></i>Receive from User</a></li>
                </ul></li>
            <li class="treeview"><a href="income_history.php"><i class="fa fa-table"></i> <span>Income History</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-table"></i> <span>Blood Manage</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="blood_donate.php"><i class="fa fa-circle-o"></i> Blood Donate</a></li>
                    <li><a href="donate_list.php"><i class="fa fa-circle-o"></i> Donate List</a></li>
                </ul></li>
            <li>
                <?php
                if (isset($_GET['action'])&& $_GET['action']=='logout'){
                    Session::destroy();
                }
                ?>
               <a href="?action=logout" class=""><i class="fa fa-book"></i>Logout</a>

            </li>
        </ul></section></aside>

<!--sidebar End  -->