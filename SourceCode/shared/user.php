<!-- <li><a href="#"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></a></li>
<li><a href="<?php echo 'logout.php'; ?>">Logout</a></li> -->


<li class="nav-item"><a href="#" class="nav-link"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></a></li>
                        <!-- <i class="fas fa-sign-out-alt"></i>&nbsp; -->
<li class="nav-item"><a href="<?php echo 'logout.php'; ?>" class="nav-link">Logout</a></li>
                        <!-- <i class="fas fa-sign-out-alt"></i>&nbsp; -->
                        