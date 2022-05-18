<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">New Expense</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard/Add Expense</li>
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Add your expense
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['exp_edit_id'])) {
                                    $exp_edit_id=$_GET['exp_edit_id'];
                                    $sql="SELECT * FROM expenses WHERE id='$exp_edit_id'";
                                    $result=$conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $ids=$row['id'];
                                    $exp_cat_ids =$row['exp_cat_id'];
                                    $exp_amounts =$row['exp_amount'];
                                    $exp_dates=$row['exp_date'];
                                }
                                ?>
                                <form action="process.php" method="post">
                                    <input type="hidden" name="exp_update_id" value="<?=$ids?>">
                                    <select class="form-select mb-3" name="exp_cat_id" aria-label="Default select example" required>
                                        <option selected disabled>Open this select menu</option>
                                        <?php
                                        $sql="SELECT * FROM `exp_cat`";
                                        $result=$conn->query($sql);
                                        while ($row = $result->fetch_assoc()) :
                                            $id=$row['id'];
                                            $name=$row['name'];
                                        ?>
                                            <option value='<?=$id?>' <?= !empty($exp_cat_ids) && $exp_cat_ids==$id ? 'selected': ''?>><?=$name?></option>";
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">৳</span>
                                        <span class="input-group-text">0.00</span>
                                        <input type="number" name="exp_amount" class="form-control" pattern="/^(\d+(\.\d+)?)$/" aria-label="Dollar amount (with dot and two decimal places)" value="<?= !empty($exp_amounts) ? $exp_amounts : ''?>" required>
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <input type="date" name="exp_date" value="<?= !empty($exp_dates) ? date("Y-m-d",strtotime($exp_dates)) : ''?>" class="form-control" max="<?=date('Y-m-d')?>" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <?php if(!empty($ids))
                                        {
                                            echo "<input type='submit' class='btn btn-primary' name='update_expense' value='Save Change'>";
                                        }else {
                                            echo "<input type='submit' class='btn btn-primary' name='add_expense' value='Save'>";
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php include('footer.php'); ?>     