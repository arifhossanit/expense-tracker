<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Expenses</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
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

                        <?php 
                            extract($_POST);
                            $sql="SELECT expenses.*,exp_cat.id AS cat_id, exp_cat.name FROM `expenses`,`exp_cat` WHERE exp_cat.id=expenses.exp_cat_id ";
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
                    </div>
                </main>
<?php include('footer.php'); ?>     