<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Expense Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard/Add & View Expense Category</li>
                        </ol>
                        <?php
                            if(isset($_SESSION['flash_message'])) {
                                $message = $_SESSION['flash_message'];
                                $color= $_SESSION['color'];
                                unset($_SESSION['flash_message']);
                                unset($_SESSION['color']);
                                echo "<div class='alert alert-$color alert-dismissible fade show' role='alert'>
                                        <strong>$message</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                              
                            }
                        ?>
                        <h3>Choose date to view expense report</h3>
                        <form action="" method="post" class="row gx-3 gy-2 align-items-center my-5">
                            <div class="col-sm-5 d-inline-flex">
                                <label for="">Start Date</label>
                            <input type="date" name="sdate" id="" class="form-control"> 
                            </div>
                            <div class="col-sm-5 d-inline-flex">
                                <label for="">End Date</label>
                            <input type="date" name="edate" id="" class="form-control"> 
                            </div>
                            <input type="submit" class="col-sm-1 btn btn-primary ms-2" value="Search" name="search">
                        </form>

                        <?php if (isset($_POST['search'])) :
                            extract($_POST);
                            $sql="SELECT expenses.*,exp_cat.id AS cat_id, exp_cat.name FROM `expenses`,`exp_cat` WHERE  (exp_date BETWEEN '$sdate' AND '$edate') AND exp_cat.id=expenses.exp_cat_id ";
                            $result=$conn->query($sql);
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Expense Report
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Expense Name</th>
                                            <th>Expense Amount</th>
                                            <th>Expense Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Expense Name</th>
                                            <th>Expense Amount</th>
                                            <th>Expense Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $total=0;
                                        $i=1;
                                        while ($row = $result->fetch_assoc()) :
                                            $total=$total+$row['exp_amount'];
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['exp_amount'] ?></td>
                                            <td><?= date("Y-m-d",strtotime($row['exp_date'])); ?></td>
                                            <td>
                                                <a href="process.php?exp_id=<?=$row['id']?>" class="btn btn-danger">Delete</a>
                                                <a href="expense.php?exp_edit_id=<?=$row['id']?>" class="btn btn-danger">Edit</a>
                                            </td>
                                        </tr>
                                        <?php  
                                        endwhile; 
                                        ?>
                                    </tbody>
                                <label for="total" class="me-3">Total: </label>
                                <input type="text" id="total" value="<?=$total?>" readonly>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </main>
<?php include('footer.php'); ?>     