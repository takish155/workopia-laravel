<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Listings</title>
</head>

<body>
  <h2><?= $title ?></h2>
  <ul>
    <?php foreach ($jobs as $job): ?>
      <li><?= $job ?></li>
    <?php endforeach; ?>
  </ul>
</body>

</html>