<?php
require_once 'config/conifg.php';

$user_ID = $_SESSION['user_id'] ?? null;
$user_email = $_SESION['user_email'] ?? null;


    $buttons = [
        'login',
        'logout',
        'Create Record',
        'Update Record',
        'Delete Record',
        'View Record',
        'Upload file',
        'Donwload',
        'Serch',
        'Generate report'
 
       ]
?>

<table border="1 cellpadding="10"> 
    <tr> 
        <td><?= htmlspecialchars($button): ?></td>
        <td>
            <from method="POST">
                <input type="hidden" name="action" value="<?= htmlspecialchars($button) ?>">
                    value="<?= htmlspecialchars($button) ?>"
                >
                <button type="submit">log Avtivity</button>
            </from> 
        </td> 
    </tr> 
    <?php endforeach; ?> 
     
</table>    
 

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? "test_activity";

    $status = random_int(0, 1) === 1? 'success':'failure';
        
         $succes = logactivity(
            $pdo,
            $user_ID,
            $user_email,
            $action,
            $status

         );

         if($succes) {
            echo "<p>Activity: " . htmlspecialchar($action) . 
            " Status: " . htmlspecialchar($status) . 
         } else {
            echo "<p>Failed to log activity.</p>";
         }
}