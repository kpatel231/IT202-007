<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");

$results = [];
//update the item
if (isset($_POST["submit"])) {
    if (update_data("Products", $_GET["id"], $_POST)) {
        flash("Updated item", "success");
    }
}

//get the table definition
$result = [];
$columns = get_columns("Products");
//echo "<pre>" . var_export($columns, true) . "</pre>";
$ignore = ["id", "modified", "created"];
$db = getDB();
//get the item
$id = se($_GET, "id", -1, false);
$stmt = $db->prepare("SELECT name, description, cost FROM Products where id =:id");
try {
    $stmt->execute([":id" => $id]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $result = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}
function mapColumn($col)
{
    global $columns;
    foreach ($columns as $c) {
        if ($c["Field"] === $col) {
            return inputMap($c["Type"]);
        }
    }
    return "text";
}

  
 
  // (G) NEW STARS OBJECT
?>
<div class="row row-cols-1 row-cols-md-5 g-4">
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-dark">
                    <div class="card-header">
                        Placeholder
                    </div>
                    <?php if (se($item, "image", "", false)) : ?>
                        <img src="<?php se($item, "image"); ?>" class="card-img-top" alt="...">
                    <?php endif; ?>
             <?php endforeach; ?>
<div class="container-fluid">
    <h1>Product</h1>
    <form method="POST">

    <div class="col">
            <div class="input-group">
                <!-- make sure these match the in_array filter above-->
        <?php foreach ($result as $column => $value) : ?>
            <?php /* Lazily ignoring fields via hardcoded array*/ ?>
            <?php if (!in_array($column, $ignore)) : ?>
                <div class="mb-4">
                <label class="form-label" for="<?php se($column); ?>"><?php se($column); ?></label>
                    <input class="form-control" id="<?php se($column); ?>" type="<?php echo mapColumn($column); ?>" value="<?php se($value); ?>" name="<?php se($column); ?>"readonly />
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
       
    </form>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../partials/footer.php");
?>