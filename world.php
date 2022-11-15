

<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$cit=0;
//$resultsCities;
//$resultsCountry;

if(isset($_GET['country'])){
  $srchInput= $_GET['country'];
  $country= filter_var($srchInput,FILTER_SANITIZE_STRING);
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  
  if(isset($_GET['lookup'])){
    $srchInput= $_GET['lookup'];
    $city= filter_var($srchInput,FILTER_SANITIZE_STRING);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rcities = $results[0]['code'];
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON countries.code = cities.country_code WHERE countries.code LIKE '%$rcities%'");
    $resultsCities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cit=0;

  }else{
    $resultsCountry = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cit=1;
  }
}



?>

<?php if ($cit==0):?>
  <table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
    <?php foreach ($resultsCities as $row): ?>
      <tr>
        <td><?=$row['name'];?></td>
        <td><?=$row['district'];?></td>
        <td><?=$row['population'];?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>

<?php if ($cit==1):?>
  <table>
    <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>
  <?php foreach ($resultsCountry as $row): ?>
    <tr>
      <td><?=$row['name'];?></td>
      <td><?=$row['continent'];?></td>
      <td><?=$row['independence_year'];?></td>
      <td><?=$row['head_of_state'];?></td>
    </tr>
  <?php endforeach; ?>
  </table>
  <?php endif; ?>

  