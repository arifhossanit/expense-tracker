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
                        <div class="row">
                            
                                    <?php 
                                    if (isset($_GET['cat_edit_id'])) {
                                        extract($_GET);
                                        $sql="SELECT * FROM `exp_cat` WHERE id='$cat_edit_id' LIMIT 1";
                                        $result=$conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $id=$row['id'];
                                        $name=$row['name'];
                                        ?>
                                        <form action="process.php" method="post">
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="edit_exp_id" value="<?= $id ?>">
                                                <input type="text" name="exp_cat_edit_name" value="<?= $name ?>" class="form-control" type="submit">
                                                <button class="btn btn-outline-secondary" name="edit_exp_cat" value="edit_exp"  id="button-addon2">Save Change</button>
                                            </div>
                                        </form>
                                    <?php }else { ?>
                                        <form action="process.php" method="post">
                                            <div class="input-group mb-3">
                                                <input type="text" name="exp_cat_name" class="form-control" placeholder="Write New Expense Category Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" name="save_exp_cat" value="save_exp" type="submit" id="button-addon2">Save</button> 
                                            </div>
                                        </form>  
                                    <?php } ?>
                                    
                                
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Expense Category DataTable
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Expense Category Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Expense Category Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $sql="SELECT * FROM `exp_cat`";
                                        $result=$conn->query($sql);
                                        if (!empty($result)) {
                                            $i=1;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td>
                                                <a href="process.php?cat_id=<?=$row['id']?>" class="btn btn-danger">Delete</a>
                                                <a href="expense_cat.php?cat_edit_id=<?=$row['id']?>" class="btn btn-danger">Edit</a>
                                            </td>
                                        </tr>
                                        <?php  $i++; }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
<?php include('footer.php'); ?>     