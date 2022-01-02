<?php
if (session_status() != 2) session_start();

/**
Class Cnp author: Niku Alcea <nicu(dotta)alcea(atta)gmail(dotta)com>
https://github.com/alceanicu/cnp
**/
class Cnp
{
    private $_isValid = false;
    private $cnp = '';
    private $_cnp = [];
    private $_year = '';
    private $_month = '';
    private $_day = '';
    private $_cc = '';

    private static $controlKey = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
    private static $countyCode = [
        '01' => 'Alba',
        '02' => 'Arad',
        '03' => 'Arges',
        '04' => 'Bacau',
        '05' => 'Bihor',
        '06' => 'Bistrita-Nasaud',
        '07' => 'Botosani',
        '08' => 'Brasov',
        '09' => 'Braila',
        '10' => 'Buzau',
        '11' => 'Caras-Severin',
        '12' => 'Cluj',
        '13' => 'Constanta',
        '14' => 'Covasna',
        '15' => 'Dambovita',
        '16' => 'Dolj',
        '17' => 'Galati',
        '18' => 'Gorj',
        '19' => 'Harghita',
        '20' => 'Hunedoara',
        '21' => 'Ialomita',
        '22' => 'Iasi',
        '23' => 'Ilfov',
        '24' => 'Maramures',
        '25' => 'Mehedinti',
        '26' => 'Mures',
        '27' => 'Neamt',
        '28' => 'Olt',
        '29' => 'Prahova',
        '30' => 'Satu Mare',
        '31' => 'Salaj',
        '32' => 'Sibiu',
        '33' => 'Suceava',
        '34' => 'Teleorman',
        '35' => 'Timis',
        '36' => 'Tulcea',
        '37' => 'Vaslui',
        '38' => 'Valcea',
        '39' => 'Vrancea',
        '40' => 'Bucuresti',
        '41' => 'Bucuresti S.1',
        '42' => 'Bucuresti S.2',
        '43' => 'Bucuresti S.3',
        '44' => 'Bucuresti S.4',
        '45' => 'Bucuresti S.5',
        '46' => 'Bucuresti S.6',
        '51' => 'Calarasi',
        '52' => 'Giurgiu'
    ];

    /**
     * CNP constructor.
     * @param string|int $cnp
     */
    public function __construct($cnp)
    {
        try {
            $this->cnp = trim($cnp);
            $this->_cnp = str_split($this->cnp);
            $this->_isValid = $this->validateCnp();
        } catch (\Throwable $e) {
            $this->_isValid = false;
        }
    }

    /**
     * @param string|int $cnp
     * @return bool
     */
    public static function validate($cnp)
    {
        return (new static($cnp))->isValid();
    }

    /**
     * Validation for Romanian Social Security Number (CNP)
     * @return bool
     */
    private function validateCnp()
    {
        if (count($this->_cnp) != 13) {
            return false;
        }

        if (!ctype_digit($this->cnp)) {
            return false;
        }

        $this->setYear();
        $this->setMonth();
        $this->setDay();
        $this->setCounty();

        if ($this->checkYear() && $this->checkMonth() && $this->checkDay() && $this->checkCounty()) {
            return ($this->_cnp[12] == $this->calculateHash());
        }

        return false;
    }

    private function setYear()
    {
        $year = ($this->_cnp[1] * 10) + $this->_cnp[2];

        switch ($this->_cnp[0]) {
            // romanian citizen born between 1900.01.01 and 1999.12.31
            case 1 :
            case 2 :
                $this->_year = $year + 1900;
                break;
            // romanian citizen born between 1800.01.01 and 1899.12.31
            case 3 :
            case 4 :
                $this->_year = $year + 1800;
                break;
            // romanian citizen born between 2000.01.01 and 2099.12.31
            case 5 :
            case 6 :
                $this->_year = $year + 2000;
                break;
            // residents && people with foreign citizenship
            case 7 :
            case 8 :
            case 9 :
                $this->_year = $year + 2000;
                if ($this->_year > (int)date('Y') - 14) {
                    $this->_year -= 100;
                }
                break;
            default :
                $this->_year = 0;
        }
    }

    private function setMonth()
    {
        $this->_month = $this->_cnp[3] . $this->_cnp[4];
    }

    private function setDay()
    {
        $this->_day = $this->_cnp[5] . $this->_cnp[6];
    }

    private function setCounty()
    {
        $this->_cc = $this->_cnp[7] . $this->_cnp[8];
    }

    /**
     * @return bool
     */
    private function checkYear()
    {
        return ($this->_year >= 1800) && ($this->_year <= 2099);
    }

    /**
     * @return bool
     */
    private function checkMonth()
    {
        $month = (int)$this->_month;
        return ($month >= 1) && ($month <= 12);
    }

    /**
     * @return boolean
     */
    private function checkDay()
    {
        $day = (int)$this->_day;
        if (($day < 1) || ($day > 31)) {
            return false;
        }

        if ($day > 28) {
            // validate date for day of month - 28, 29, 30 si 31
            if (checkdate((int)$this->_month, $day, (int)$this->_year) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return boolean
     */
    private function checkCounty()
    {
        return array_key_exists($this->_cc, self::$countyCode);
    }

    /**
     * @return int
     */
    private function calculateHash()
    {
        $hashSum = 0;

        for ($i = 0; $i < 12; $i++) {
            $hashSum += $this->_cnp[$i] * self::$controlKey[$i];
        }

        $hashSum = $hashSum % 11;
        if ($hashSum == 10) {
            $hashSum = 1;
        }

        return $hashSum;
    }

    /**
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->_isValid;
    }

    /**
     * Get Birth Place from Romanian Social Security Number (CNP)
     * @param mixed|string $invalidReturn
     * @return mixed|string
     */
    public function getBirthCountyFromCNP($invalidReturn = '')
    {
        return ($this->_isValid) ? self::$countyCode[$this->_cc] : $invalidReturn;
    }

    /**
     * Get Birth Date from Romanian Social Security Number (CNP)
     * @param string $format
     * @param mixed|string $invalidReturn
     * @return string
     */
    public function getBirthDateFromCNP($format = 'Y-m-d', $invalidReturn = '')
    {
        if ($this->_isValid) {
            return \DateTime::createFromFormat('Y-m-d', "{$this->_year}-{$this->_month}-{$this->_day}")
                ->format($format);
        }

        return $invalidReturn;
    }

    /**
     * Get gender from Romanian Social Security Number (CNP)
     * @param string $m
     * @param string $f
     * @param string $invalidReturn
     * @return string
     */
    public function getGenderFromCNP($m = 'M', $f = 'F', $invalidReturn = '')
    {
        if ($this->_isValid) {
            if (in_array($this->_cnp[0], [1, 3, 5, 7])) {
                return $m;
            } elseif (in_array($this->_cnp[0], [2, 4, 6, 8])) {
                return $f;
            }
        }

        return $invalidReturn;
    }

    /**
     * @return string
     */
    public function getSerialNumberFromCNP()
    {
        return ($this->_isValid) ? $this->_cnp[9] . $this->_cnp[10] . $this->_cnp[11] : '';
    }

    /**
     * Verifica daca titularul CNP este major (>=18 years)
     * @return boolean
     */
    public function isPersonMajor()
    {
        return ($this->_isValid) ? ($this->getAgeInYears() >= 18) : false;
    }

    /**
     * Are carte de identitate emisa de politie (emiterea se face la implinirea varstei de 14 ani)
     * @return boolean
     */
    public function hasIdentityCard()
    {
        return ($this->_isValid) ? ($this->getAgeInYears() >= 14) : false;
    }

    /**
     * @return int
     */
    private function getAgeInYears()
    {
        try {
            $time = "{$this->_year}-{$this->_month}-{$this->_day}";
            $birthDate = \DateTime::createFromFormat('Y-m-d', $time);
            $now = (new \DateTime())->setTime(0, 0, 0);
            return (int)($birthDate->diff($now)->format('%y'));
        } catch (\Throwable $e) {
            return 0;
        }

    }

}

function validateCNP($cnp)
{
  return Cnp::validate($cnp);
}

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
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $username);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
    mysqli_stmt_close($stmt);
    return $row['id_user'];
  }

  mysqli_stmt_close($stmt);
  return false;
}

function profileExists($conn, $cnp)
{
  $sql = "select id_pacient from pacienti where cnp = ?;";
  // asume user profile exists but isnt asocc to a user
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $cnp);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
    mysqli_stmt_close($stmt);
    return $row['id_pacient'];
  }

  mysqli_stmt_close($stmt);
  return false;
}

function profileDExists($conn, $cnp)
{
  $sql = "select id_angajat from angajati where cnp = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../doctorprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $cnp);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
    mysqli_stmt_close($stmt);
    return $row['id_angajat'];
  }

  mysqli_stmt_close($stmt);
  return false;
}

function assocProfile($conn, $id_user, $id_pacient)
{
  $sql = "update pacienti set id_user = ? where id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_pacient);

  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) == 1)
  {
    mysqli_stmt_close($stmt);
    return true;
  }

  mysqli_stmt_close($stmt);
  return false;
}

function createProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $gen)
{
  $sql = "insert into pacienti(id_user, nume, prenume, cnp, data_nasterii, gen) values (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ississ", $id_user, $nume, $prenume, $cnp, $dob, $gen);

  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) == 1)
  {
      mysqli_stmt_close($stmt);
      return true;
  }
  mysqli_stmt_close($stmt);
  return false;
}

function updateProfile($conn, $id_pacient, $nume, $prenume, $cnp, $dob, $gen)
{
  $sql = "update pacienti set nume = ?, prenume = ?, cnp = ?, data_nasterii = ?, gen = ? where id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssissi", $nume, $prenume, $cnp, $dob, $gen, $id_pacient);

  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) == 1)
  {
    mysqli_stmt_close($stmt);
    return true;
  }
  mysqli_stmt_close($stmt);
  return false;
}


if (isset($_POST["submit"]))
{
  require_once 'cdb.inc.php';

  $username = $_SESSION['username'];
  $nume = mysqli_real_escape_string($conn, $_POST["nume"]);
  $prenume = mysqli_real_escape_string($conn, $_POST["prenume"]);
  $cnp = mysqli_real_escape_string($conn, $_POST["cnp"]);
  $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
  $gen = mysqli_real_escape_string($conn, $_POST["gen"]);


  if (emptyField($nume, $prenume, $cnp, $dob, $gen) !== false)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=emptyfield';
    </script>
    <?php
    exit();
  }

  if (validateCNP($cnp) != true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=cnptnotvalid';
    </script>
    <?php
    exit();
  }

  $id_user = getUserid($conn, $username);

  if ($id_pac = profileExists($conn, $cnp) !== false)
  {
    assocProfile($conn, $id_user, $id_pac);
    if (updateProfile($conn, $id_pac, $nume, $prenume, $cnp, $dob, $gen) !== true)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../createprofile.php?error=wrong';
      </script>
      <?php
      exit();
    }
    unset($_SESSION['signup']);
    ?>
    <script type="text/javascript">
    window.location.href = '../profile.php';
    </script>
    <?php
    exit();
  }

  if (createProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $gen) !== true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }
  else
  {
    unset($_SESSION['signup']);
    ?>
    <script type="text/javascript">
    window.location.href = '../profile.php';
    </script>
    <?php
    exit();
  }

}
else
{
  ?>
  <script type="text/javascript">
  window.location.href = '../createprofile.php';
  </script>
  <?php
  exit();
}
