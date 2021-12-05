<?php

function emptyField($nume, $prenume, $cnp, $dob, $gen)
{
  if (empty($nume) || empty($prenume) || empty($cnp) || empty($dob) || empty($gen))
    return true;
  return false;
}

function emptyFieldD($nume, $prenume, $cnp, $dob, $tel, $dom)
{
  if (empty($nume) || empty($prenume) || empty($cnp) || empty($dob) || empty($dom) || empty($tel))
    return true;
  return false;
}

function getUserid($conn, $username)
{
  $sql = "select id_user from users where username = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../createprofile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $username);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
    return $row['id_user'];
  return false;

  mysqli_stmt_close($stmt);
}

function profileExists($conn, $cnp)
{
  $sql = "select id_pacient from pacienti where cnp = ?;";
  // asume user profile exists but isnt asocc to a user
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../createprofile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $cnp);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
    return $row['id_pacient'];
  return false;

  mysqli_stmt_close($stmt);
}

function profileDExists($conn, $cnp)
{
  $sql = "select id_angajat from angajati where cnp = ?;";
  // asume user profile exists but isnt asocc to a user
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../doctorprofile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $cnp);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
    return $row['id_angajat'];
  return false;

  mysqli_stmt_close($stmt);
}

function assocProfile($conn, $id_user, $id_pacient)
{
  $sql = "update pacienti set id_user = ? where id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../createprofile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_pacient);

  mysqli_stmt_execute($stmt);
  // add check transaction and rollback/commit

  if (mysqli_stmt_affected_rows($stmt) == 1)
    return true;
  return false;

  mysqli_stmt_close($stmt);
}

function aw_assocProfile($conn, $id_user, $id)
{
  $sql = "insert into await_admin_validation(type, id_angajat, id_user) values ('assoc', ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../doctorprofile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id, $id_angajat);

  mysqli_stmt_execute($stmt);
  // add check transaction and rollback/commit

  if (mysqli_stmt_affected_rows($stmt) == 1)
    return true;
  return false;

  mysqli_stmt_close($stmt);
}

function createProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $gen)
{
  $sql = "insert into pacienti(id_user, nume, prenume, cnp, data_nasterii, gen) values (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ississ", $id_user, $nume, $prenume, $cnp, $dob, $gen);

  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) == 1)
    return true;
  return false;

  mysqli_stmt_close($stmt);
}

function createDProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $tel, $dom, $mail)
{
  $sql = "insert into temp_ang(id_user, nume, prenume, cnp, data_nasterii, nr_telefon, domeniu, email, angajat_type) values (?, ?, ?, ?, ?, ?, ?, ?, 'Personal_medical');";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "issisiss", $id_user, $nume, $prenume, $cnp, $dob, $tel, $dom, $mail);

  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) != 1)
    return false;
  mysqli_stmt_close($stmt);

  $sql = "insert into await_admin_validation(type, id_user) values ('create', ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../doctorprofile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_user);

  mysqli_stmt_execute($stmt);
  // add check transaction and rollback/commit

  if (mysqli_stmt_affected_rows($stmt) == 1)
    return true;
  return false;

  mysqli_stmt_close($stmt);
}

function updateProfile($conn, $id_pacient, $nume, $prenume, $cnp, $dob, $gen)
{
  $sql = "update pacienti set nume = ?, prenume = ?, cnp = ?, data_nasterii = ?, gen = ? where id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssissi", $nume, $prenume, $cnp, $dob, $gen, $id_pacient);

  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) == 1)
    return true;
  return false;

  mysqli_stmt_close($stmt);
}
