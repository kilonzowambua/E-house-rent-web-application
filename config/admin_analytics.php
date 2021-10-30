<?php


/* User*/
$query = "SELECT COUNT(*)  FROM `user` WHERE  user_access = 'user' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($user);
$stmt->fetch();
$stmt->close();
/*staff */
$query = "SELECT COUNT(*)  FROM `user` WHERE  user_access = 'staff' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($staff);
$stmt->fetch();
$stmt->close();

/* Total house */
$query = "SELECT COUNT(*)  FROM `house`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($house);
$stmt->fetch();
$stmt->close();

/* Total revenue*/
$query = "SELECT SUM(house_cost) FROM billing b  INNER JOIN  
house h ON h.house_id = b.house_id";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($total_revenue);
$stmt->fetch();
$stmt->close();

